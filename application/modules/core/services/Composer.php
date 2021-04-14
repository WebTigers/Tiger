<?php

/**
 * Class Core_Service_Composer
 *
 * The purpose of this class is to run at least once each day to catalog and update any
 * WebTigers' Tiger packages (modules) and update the database with the new data. This is
 * all done via Composer which at the moment doesn't really have a great API we can call
 * to get this data so we need to parse Composer's output. Not great, but it's working.
 *
 * CUSTOM MODULES
 * This Composer class only manages modules managed by Composer. If you create a custom
 * module within Tiger, it will be totally ignored by this class and Composer.  :)
 */
final class Core_Service_Composer extends Core_Service_Webservice
{
    protected $_composerJSON;
    protected $_packageModel;

    const COMPOSER_JSON_FILEPATH = "/var/www/tiger-vendor/composer.json";
    const TIGER_TYPES = ['tiger-module', 'tiger-theme'];

    public function __construct ( $input ) {

        $this->_packageModel = new Core_Model_Package;

        /** Automagically pull the contents of the composer.json file */
        $this->getComposerJSON();

        parent::__construct( $input );

    }

    public function getComposerJSON ( ) {

        return $this->_composerJSON = json_decode( file_get_contents( self::COMPOSER_JSON_FILEPATH ) );

    }

    public function setComposerJSON ( ) {

        $json = json_encode( $this->_composerJSON, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES );
        file_put_contents(self::COMPOSER_JSON_FILEPATH, $json );

    }

    /**
     * The composer.json file is the canonical source for any and all required modules in Tiger.
     * We really don't care about listing dependencies. The sync function just reads into the
     * database whatever is in the composer.json. The sync function should be run by cron at least
     * once each night and whenever composer is run from the command line.
     */
    public function sync ( $params ) {

        try {

            /** First, we remove any packages in the DB that have been removed from Composer. */
            $this->_removePackages();

            /** Next, we persist any packages that are in Composer but not in the DB. */
            $this->_persistPackages();

            $this->_response->result = 1;
            $this->_response->setTextMessage('MESSAGE.SYNC_PACKAGES_COMPLETED', 'success');

        }
        catch ( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'error');

        }

    }

    protected function _removePackages (  ) {

        $composerPackages   = array_keys( (array) $this->_composerJSON->require );
        $dbPackages         = $this->_getDbPackages();
        $removePackages     = array_diff( $dbPackages, $composerPackages );

        foreach ( $removePackages as $packageName ) {
            $packageRow = $this->_packageModel->getPackageByName( $packageName );
            $packageRow->delete();
        }

    }

    protected function _persistPackages ( ) {

        /** Gets the name, version, and description of all installed packages. */
        $response = $this->status();

        foreach ( $response->installed as $package ) {

            $this->savePackage( $package );

        }

    }

    public function savePackage ( $package ) {

        /**
         * $package example:
            [0] => stdClass Object
                (
                    [name] => aws/aws-sdk-php
                    [version] => 3.178.1
                    [description] => AWS SDK for PHP - Use Amazon Web Services in your PHP project
            )
         */

        $packageInfo = $this->status( $package->name, true );

        /** Attempt to get the record from the DB */
        $packageRow = $this->_packageModel->getPackageByName( $packageInfo->name );

        if ( ! empty( $packageRow ) ) {

            $packageRow->type = $packageInfo->type;
            $packageRow->description = $packageInfo->description;
            $packageRow->target_version = $this->_composerJSON->require->{$packageInfo->name};
            $packageRow->version = $packageInfo->versions[0];
            $packageRow->latest = $packageInfo->latest;
            $packageRow->repo_type = $this->checkCustomRepo( $packageInfo->name,'type' );
            $packageRow->repo_url = $this->checkCustomRepo( $packageInfo->name, 'url' );
            $packageRow->active = $this->isActive( $packageInfo );
            $packageRow->saveRow();

        }
        else {

            $packageRow = $this->_packageModel->createRow([
                'package_id' => Tiger_Utility_Uuid::v1(),
                'name' => $packageInfo->name,
                'type' => $packageInfo->type,
                'description' => $packageInfo->description,
                'target_version' => $this->_composerJSON->require->{$packageInfo->name},
                'version' => $packageInfo->versions[0],
                'latest' => $packageInfo->latest,
                'repo_type' => $this->checkCustomRepo( $packageInfo->name,'type'),
                'repo_url' => $this->checkCustomRepo( $packageInfo->name, 'url'),
            ]);

            $packageRow->saveRow();

            $packageRow->active = $this->isActive( $packageInfo );
            $packageRow->saveRow();

        }

        return $packageRow;

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

        // pr( $output );

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
     * Get DB Packages
     *
     * Returns an array of all of the package names in the DB.
     *
     * @return array
     */
    protected function _getDbPackages ( ) {

        $packageRowset = $this->_packageModel->getPackageNames();
        $out = [];
        foreach( $packageRowset as $packageRow ){
            $out[] = $packageRow->name;
        }
        return $out;

    }

    /**
     * Check for Custom Repository
     *
     * Not the most sexy way to do this, but essentially we just parse the composer.json
     * and look for any matches. The vendor/package name should be part of the repo url.
     *
     * @param string $name
     * @param string $type url | type
     * @return mixed string | null
     */
    public function checkCustomRepo ( $name, $type ) {

        $out = null;
        foreach ( $this->_composerJSON->repositories as $repository ) {
            if ( strstr( strtolower( $repository->url ), $name ) ) {
                $out = $repository->{$type};
            }
        }
        return $out;

    }

    /**
     * For certain types of packages, this function tells us whether or not
     * the theme or module is active within Tiger.
     *
     * @param $packageInfo
     * @return integer 1|0
     */
    public function isActive ( $packageInfo ) {

        $out = 0;
        if ( in_array( $packageInfo->type, self::TIGER_TYPES ) ) {
            $dir = MODULES_PATH . '/' . explode('/', $packageInfo->name)[1];
            $out = ( file_exists( $dir ) && is_dir( $dir ) ) ? 1 : 0;
        }
        return $out;

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

        }

        /** Write the update composer.json file. */
        $this->setComposerJSON();

        /** Pull the package into Tiger via composer update call. */
        $this->updatePackage( $name );

        /** Save the package into to the database. */
        $package = (object) [ 'name' => $name ];
        $this->savePackage( $package );

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

        $i = 0;
        foreach ( $this->_composerJSON->repositories as $repository ) {
            if ( $repository->url === $repo_url ) {
                unset( $this->_composerJSON->repositories[$i] );
            }
            $i++;
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

        return shell_exec( $command );

    }

}