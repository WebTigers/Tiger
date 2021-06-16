<?php

/**
 * Class Package_Service_Composer
 *
 * The purpose of this class is to run at least once each day to catalog and update any
 * WebTigers' Tiger packages (modules) and update the database with the new data. This is
 * all done via Composer which at the moment doesn't really have a great API we can call
 * to get this data so we need to parse Composer's output. Not great, but it's working.
 *
 * CUSTOM MODULES
 * This Composer class only manages modules managed by Composer. If you create a custom
 * module within Tiger, it will be totally ignored by this class and Composer.  :)
 *
 * This class is a utility class and designed to be called by the Package Service.
 */
final class Package_Service_Composer
{
    protected $_composerJSON;

    const COMPOSER_JSON_FILEPATH = "/var/www/tiger-vendor/composer.json";

    public function __construct ( ) {

        /** Automagically pull the contents of the composer.json file */
        $this->readComposerJSON();

    }

    public function getComposerJSON ( )
    {
        return $this->_composerJSON;
    }

    public function setComposerJSON ( $composerJSON )
    {
        $this->_composerJSON = $composerJSON;
    }

    public function readComposerJSON ( )
    {
        return $this->_composerJSON = json_decode( file_get_contents( self::COMPOSER_JSON_FILEPATH ) );
    }

    public function writeComposerJSON ( )
    {
        $json = json_encode( $this->_composerJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
        file_put_contents(self::COMPOSER_JSON_FILEPATH, $json );
    }

    /**
     * Status returns data from Composer regarding our direct root packages.
     *
     * @param string $package
     * @param false $outdated
     * @return mixed
     */
    public function status ( $package = '', $outdated = false ) {

        $outdated = ( $outdated === true ) ? '--outdated' : '';

        $command = "cd /var/www/tiger-vendor;
            export COMPOSER_HOME=/home/ec2-user/.config/composer;
            export COMPOSER_CACHE_DIR=/var/www/tiger-vendor/vendor/composer;
            php composer.phar show $package $outdated --format=json --direct 2>&1";

        $output = shell_exec( $command );

        /** If the output is not JSON, throw an exception and log it. */
        if ( ! is_json( $output ) ) {

            Tiger_Log::error( $output );

            $message = ( ! empty( $package ) )
                ? 'ERROR.RETRIEVING_PACKAGE : ' . $package
                : 'ERROR.RETRIEVING_PACKAGES';
            throw new Exception( $message );

        }

        /**
         * Example output for a single package:
         *
        {
            "name": "webtigers/cms",
            "description": "WebTiger's Tiger Platform CMS Module",
            "keywords": [
                "cms",
                "content management system",
                "tiger",
                "webtigers"
            ],
            "type": "library",
            "homepage": null,
            "names": [
                "webtigers/cms"
            ],
            "versions": [
                "v2.0.0"
            ],
            "licenses": [
                "proprietary"
            ],
            "source": {
                "type": "git",
                "url": "git@github.com:WebTigers/cms.git",
                "reference": "5ed3b796226d807597986dbf8abe25da0c38143b"
            },
            "dist": {
                "type": "zip",
                "url": "https://api.github.com/repos/WebTigers/cms/zipball/5ed3b796226d807597986dbf8abe25da0c38143b",
                "reference": "5ed3b796226d807597986dbf8abe25da0c38143b"
            },
            "path": "/var/www/tiger-vendor/vendor/webtigers/cms",
            "support": {
                "source": "https://github.com/WebTigers/cms/tree/v2.0.0",
                "issues": "https://github.com/WebTigers/cms/issues"
            }
        }
         *
         */

        /**
         * Example output for all packages:
         *
        {
            "installed": [
                {
                    "name": "aws/aws-sdk-php",
                    "version": "3.178.1",
                    "description": "AWS SDK for PHP - Use Amazon Web Services in your PHP project"
                },
                {
                    "name": "shardj/zf1-future",
                    "version": "1.19.1",
                    "description": "Zend Framework 1. The aim is to keep ZF1 working with the latest PHP versions"
                },
                {
                    "name": "webtigers/account",
                    "version": "v2.0.1",
                    "description": "WebTiger's Tiger Platform Account Module"
                },
                {
                    "name": "webtigers/acl",
                    "version": "v2.0.0",
                    "description": "WebTiger's Tiger Platform ACL Module"
                },
                ...
            ]
        }
         *
         */

        return json_decode( $output );

    }

    /**
     * Package Exists
     *
     * Checks to see of a package name exists in the class' composerJSON array. Note that this is not
     * checking the actual file. The file is loaded into the class on construction.
     *
     * @param $name
     * @return bool
     */
    public function packageExists ( $name ) {
        return property_exists( $this->_composerJSON->require, $name );
    }

    /**
     * Add Package
     *
     * @param $name
     * @param $target_version
     * @param null $repo_type
     * @param null $repo_url
     */
    public function addPackage ( $name, $target_version, $repo_type = null, $repo_url = null ) {

        /** Add the name and target_version to the composerJSON array already in the class. */
        $this->_composerJSON->require->{$name} = $target_version;

        /** Check to see if we have a custom repo and if it's already in the array. If not, add it. */
        if ( ! empty( $repo_type ) && ! empty( $repo_url ) ) {

            $this->_composerJSON->repositories[] = (object) [
                'type' => $repo_type,
                'url'  => $repo_url,
            ];

            /**
             * Remove any duplicates.
             * https://stackoverflow.com/questions/10505760/remove-duplicates-from-an-array-based-on-object-property
             */
            $this->_composerJSON->repositories = array_intersect_key( $this->_composerJSON->repositories, array_unique( array_column( $this->_composerJSON->repositories, 'url') ) );

            /** Keeps the array sequential so that json_encode doesn't think it's an object now. */
            $this->_composerJSON->repositories = array_values( $this->_composerJSON->repositories );

        }

        /** Write the update composer.json file. */
        $this->writeComposerJSON();

        /** Pull the package into Tiger via composer update call. */
        $this->updatePackage( $name );

    }

    /**
     * Remove Package
     *
     * Removes the package from the class' composerJSON array. Note that this does not alter the
     * composer.json file.
     *
     * @param $name
     */
    public function removePackage ( $name ) {

        if ( array_key_exists( $name, $this->_composerJSON->require ) ) {
            unset( $this->_composerJSON->require->{$name} );
        }

    }

    /**
     * Remove Repository
     *
     * Removes the repo from the class' composerJSON array. Note that this does not alter the
     * composer.json file.
     *
     * @param $repo_url
     */
    public function removeRepository ( $repo_url ) {

        foreach ( $this->_composerJSON->repositories as $i => $repository ) {
            if ( $repository->url === $repo_url ) {
                unset( $this->_composerJSON->repositories[$i] );
                /** Keeps the array sequential so that json_encode doesn't think it's an object now. */
                $this->_composerJSON->repositories = array_values( $this->_composerJSON->repositories );
            }
        }

    }

    /**
     * Update will add/remove a particular package.
     * @param $package
     * @return mixed
     */
    public function updatePackage ( $package ) {

        $command = "cd /var/www/tiger-vendor;
            export COMPOSER_HOME=/home/ec2-user/.config/composer;
            export COMPOSER_CACHE_DIR=/var/www/tiger-vendor/vendor/composer;
            php composer.phar update $package 2>&1";

        $response = shell_exec( $command );

        /** Writes the response to the application.log */
        Tiger_Log::file( $response );

    }

}