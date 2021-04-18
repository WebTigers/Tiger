<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Copyright Notice
 * ————————————————————————————————————————————————————————————————————————————————
 *
 *  Copyright © 2020 WebTigers
 *  All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains the property of WebTigers.
 * The intellectual and technical concepts contained herein are proprietary to
 * WebTigers and may be covered by U.S. and Foreign Patents, patents in process, and
 * are protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from WebTigers.
 *
 * See the LICENSE.txt for full licensing information governing the use of this
 * information and software.
 */

trait Package_Service_PackageTrait
{

    ### Datatables Functions ###

    /**
     * Perhaps one of the more complicated API calls is for DataTables. DataTables posts
     * a boatload of varied params based on the data within table. These DataTables functions
     * consume that set of params and organize it into something our models can deal with.
     *
     * This DataTable function is a pattern repeated over and over within Tiger and is easily
     * copy and paste for your unique DataTables use cases within the Tiger platform.
     *
     * @param $post
     * @return object DataTables response
     */
    public function getAdminPackagesDataTable ( $post ) {

        $validationResponse = $this->_utility->validateDataTables( $post );

        if ( $validationResponse === true ) {

            /** Are we ordering by some column(s)? */
            $orderby = '';
            if ( count($post['order']) > 0 ) {
                foreach ( $post['order'] as $order) {
                    $columnNumber = $order['column'];
                    $direction = $order['dir'];
                    $orderby .= $post['columns'][$columnNumber]['name'] . " " . $direction . ", ";
                }
                $orderby = substr($orderby, 0, -2);
            }

            /** DataTables needs a filtered count for pagination */
            $recordsTotalRowset = $this->getAdminPackageSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminPackageSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->package_id;
                $record->controls = $this->_getPackageActions( $record );
                $recordsOut[] = $record;

            }

            $headers = $this->_utility->getTranslation([
                'DT.PACKAGE_ID',
                'DT.PACKAGE_NAME',
                'DT.PACKAGE_TARGET_VERSION',
                'DT.PACKAGE_DESCRIPTION',
                'DT.PACKAGE_REQUIRED',
                'DT.PACKAGE_VERSION',
                'DT.PACKAGE_LATEST',
                'DT.PACKAGE_REPO_TYPE',
                'DT.PACKAGE_REPO_URL',
                'DT.ACTIVE',
                'DT.ACTIONS',
            ]);

            /** Set the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => count( $recordsTotalRowset ),
                'recordsFiltered'   => count( $recordsTotalRowset ),
                'data'              => $recordsOut,
                'i18n'              => $headers,
            ]);

        }
        else {

            /** Set an empty the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => 0,
                'recordsFiltered'   => 0,
                'data'              => [],
                'error'             => $validationResponse
            ]);

        }

    }

    /**
     * getAdminPackageSearchList returns a rowset of packages.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminPackageSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {
        return $this->_packageModel->getAdminPackageSearchList( $search, $offset, $limit, $orderby );
    }

    protected function _getPackageActions ( $package ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $package->package_id,                        // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fa fas fa-angle-double-up update',          // The class for the icon or button.
            'title'     => $this->_translate->_('DT.UPDATE_PACKAGE'),   // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.UPDATE'),           // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $package->package_id,                        // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_PACKAGE'),     // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $package->package_id,
            'value'     => $package->active,
            'class'     => ( intval($package->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => $this->_translate->_('DT.ACTIVE_INACTIVE_PACKAGE'),
            'label'     => $this->_translate->_('DT.ACTIVE_INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $package->package_id,
            'value'     => 0,
            'class'     => 'fa fas fa-trash delete',
            'title'     => $this->_translate->_('DT.DELETE_PACKAGE'),
            'label'     => $this->_translate->_('DT.DELETE'),
        ];

        return $actions;

    }


    #### Functions for Composer SYNC Operations ####

    /**
     * Package Service Sync
     *
     * Syncs Tiger packages with composer.json file.
     *
     * The Composer Service's composer.json file is the canonical source for any and all required modules in Tiger.
     * We really don't care about listing dependencies. The sync function just reads into the database whatever is
     * in the composer.json. The sync function should be run by cron at least once each night and whenever composer
     * is run from the command line.
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

    protected function _removePackages ( ) {

        $composerPackages   = array_keys( (array) $this->_composerService->getComposerJSON()->require );
        $dbPackages         = $this->_getDbPackages();
        $removePackages     = array_diff( $dbPackages, $composerPackages );

        foreach ( $removePackages as $packageName ) {
            $packageRow = $this->_packageModel->getPackageByName( $packageName );
            if ( $packageRow instanceof Zend_Db_Table_Row ) {
                $packageRow->delete();
            }
        }

    }

    protected function _persistPackages ( ) {

        /** Gets the name, version, and description of all installed packages. */
        $response = $this->_composerService->status();

        foreach ( $response->installed as $package ) {
            $this->_storePackage( $package );
        }

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

    protected function _storePackage ( $package ) {

        /**
         * $package example:
        [0] => stdClass Object
        (
        [name] => aws/aws-sdk-php
        [version] => 3.178.1
        [description] => AWS SDK for PHP - Use Amazon Web Services in your PHP project
        )
         */

        $packageInfo = $this->_composerService->status( $package->name, true );

        /** Attempt to get the record from the DB */
        $packageRow = $this->_packageModel->getPackageByName( $packageInfo->name );

        if ( ! empty( $packageRow ) ) {

            $packageRow->type = $packageInfo->type;
            $packageRow->description = $packageInfo->description;
            $packageRow->required = $this->isRequired( $packageInfo->name );
            $packageRow->target_version = $this->_composerService->getComposerJSON()->require->{$packageInfo->name};
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
                'required' => $this->isRequired( $packageInfo->name ),
                'target_version' => $this->_composerService->getComposerJSON()->require->{$packageInfo->name},
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

    public function isRequired ( $name ) {

        $packageConfigs = Zend_Registry::get('Zend_Config')->packages;

        $out = 0;
        foreach( $packageConfigs as $vendor => $package ) {
            foreach ( $package as $packageName => $packageData ) {
                if ( $packageData->require->name === $name ) {
                    $out = ( $packageData->meta->required ) ? 1 : 0;
                }
            }
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
        foreach ( $this->_composerService->getComposerJSON()->repositories as $repository ) {
            if ( strstr( strtolower( $repository->url ), $name ) ) {
                $out = $repository->{$type};
            }
        }
        return $out;

    }


    #### Functions for Add Package ####

    /**
     * Save Package
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function savePackage ( $params ) {

        $form = new Package_Form_Package();

        /** If this is an update, remove the unique name validator. */
        if ( Tiger_Utility_Uuid::is_valid( $params['package_id'] ) ) {
            $form->getElement('name')->removeValidator('Db_NoRecordExists');
        }

        if ( ! $form->isValid( $params ) ) {
            $this->_setFormErrors( $form );
            return;
        }

        $data = $form->getValues();

        try {

            $this->_composerService->addPackage( $data['name'], $data['target_version'], $data['repo_type'], $data['repo_url'] );

            /** Save the package into to the database. */
            $package = (object) $data;
            $this->_storePackage( $package );

            $this->_response->result = 1;
            $this->_response->setTextMessage( 'MESSAGE.PACKAGE_ADDED', 'success' );

        }
        catch( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'error' );

        }

    }

    public function updatePackage ( $params ) {

        try {

            if ( ! Tiger_Utility_Uuid::is_valid( $params['package_id'] ) ) {
                throw new Exception( $this->_translate->translate('ERROR.INVALID_ID') );
            }

            $packageRow = $this->_packageModel->getPackageById( $params['package_id'] );

            if ( empty( $packageRow ) ) {
                throw new Exception( $this->_translate->translate('ERROR.PACKAGE_NOT_FOUND') );
            }

            /** Just updates the package in the vendor folder. */
            $this->_composerService->updatePackage( $packageRow->name );

            /** If this is the Tiger platform, module or theme, we need to do updates a bit differently. Copy the new files immediately. */
            if ( $packageRow->type === 'tiger-platform' ) {
                $this->updatePlatformFiles();
            }
            elseif ( in_array( $packageRow->type, self::TIGER_TYPES ) ) {
                $this->copyPackageFiles( $packageRow );
            }

            /** Get the latest package info of the newly updated package. */
            $packageInfo = $this->_composerService->status( $packageRow->name, true );
            $packageRow->version = $packageInfo->versions[0];
            $packageRow->latest = $packageInfo->latest;
            $packageRow->saveRow();

            $this->_response->result = 1;
            $this->_response->setTextMessage('MESSAGE.PACKAGE_UPDATED', 'success');

        }
        catch( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'error' );

        }

    }

    /**
     * Delete Package
     * When removing a package from Tiger, there are several steps we need to take. First of all, Tiger
     * doesn't hold your hand and prevent you from removing a package that will break your application.
     * If you remove a "system" package that breaks Tiger, well, you're SOL. Restore it via the command line.
     * Again, Tiger isn't concerned about dependencies, on the direct root package.
     *
     * 1. Get the package from the DB by name.
     * 2. If the package is an active theme or module:
     *    a. Remove any symlink to the assets folder.
     *    b. Delete the module.
     * 3. Remove the package from composer.json require array.
     *    a. Remove any associated repository from composer.json repositories array.
     * 4. Re-save composer.json.
     * 5. Run composer service update.
     * 6. Delete the package record from the package table.
     *
     * @param $params
     */
    public function deletePackage ( $params ) {

        if ( ! Tiger_Utility_Uuid::is_valid( $params['package_id'] ) ) {
            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.DELETE_FAILED_PACKAGE_ID_INVALID', 'alert' );
            return;
        }

        try {

            $packageRow = $this->_packageModel->getPackageById( $params['package_id'] );

            if ( ! empty( $packageRow ) ) {

                if ( $this->isActive( $packageRow ) ) {
                    $this->removePackageFiles( $packageRow );
                }

                $this->_composerService->removePackage( $packageRow->name );
                $this->_composerService->removeRepository( $packageRow->repo_url );
                $this->_composerService->setComposerJSON();
                $this->_composerService->updatePackage( $packageRow->name );

                $packageRow->delete();

                $this->_response->result = 1;
                $this->_response->setTextMessage( 'MESSAGE.PACKAGE_REMOVED', 'success' );

            } else {

                $this->_response->result = 0;
                $this->_response->setTextMessage( 'MESSAGE.DELETE_FAILED_NO_DB_RECORD', 'alert' );

            }

        }
        catch( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'alert' );

        }

    }


    #### Check and Set Package Active or Inactive Functions ####

    /**
     * For certain types of packages, this function tells us whether or not
     * the theme or module is active within Tiger. An active modules is one
     * that exists within the module folder.
     *
     * @param $packageRow
     * @return integer 1|0
     */
    public function isActive ( $packageRow ) {

        $out = 0;
        if ( in_array( $packageRow->type, self::TIGER_TYPES ) ) {
            $dir = MODULES_PATH . '/' . explode('/', $packageRow->name)[1];
            $out = ( file_exists( $dir ) && is_dir( $dir ) ) ? 1 : 0;
        }
        return $out;

    }

    public function setActivePackage ( $params ) {

        try {

            if ( ! Tiger_Utility_Uuid::is_valid( $params['package_id'] ) ) {
                throw new Exception( $this->_translate->translate('ERROR.INVALID_ID') );
            }

            $packageRow = $this->_packageModel->getPackageById( $params['package_id'] );
            if ( empty( $packageRow ) ) {
                throw new Exception( $this->_translate->translate('ERROR.PACKAGE_NOT_FOUND') );
            }

            /** VERY IMPORTANT! You cannot add/remove the Tiger platform. That's a really bad thing! */
            if ( $packageRow->type === 'tiger-platform' ) {
                throw new Exception( $this->_translate->translate('ALERT.CANNOT_ACTIVATE_DEACTIVATE_PLATFORM') );
            }

            /** A quick form of data validation. If it's not a bit, it's automagically 0. */
            $packageRow->active = ( intval( $params['active'] ) === 1 ) ? 1 : 0;
            $packageRow->saveRow();

            if ( intval( $packageRow->active ) === 0 ) {

                /** If the package exists within the /modules folder, remove it. Done. */
                if ( $this->isActive( $packageRow ) ) {
                    $this->removePackageFiles( $packageRow );
                }

                $message = 'MESSAGE.PACKAGE_DEACTIVATED';

            }
            else {

                if ( ! $this->isActive( $packageRow ) ) {
                    $this->copyPackageFiles( $packageRow );
                }

                $message = 'MESSAGE.PACKAGE_ACTIVATED';

            }

            $this->_response->result = 1;
            $this->_response->data = $packageRow->toArray();
            $this->_response->setTextMessage( $message, 'success' );

        }
        catch( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'error' );

        }

    }


    #### File Management Operations ####

    /**
     * Update Platform Files
     * Copies the new platform files from the composer vendor package.
     */
    public function updatePlatformFiles ( ) {

        $source     = VENDOR_PATH . '/webtigers/platform/*';
        $target     = '/var/www/tiger-www';

        $command    = "cp -rf $source $target";
        $response = shell_exec( $command );

        if ( ! empty( $response ) ) {
            Tiger_Log::error( $response );
        }

    }

    /**
     * Copy Package Files
     * Copies the package from the vendor dir to the module dir. Also adds a symlink for the assets if necessary.
     *
     * @param $packageRow
     */
    public function copyPackageFiles ( $packageRow ) {

        $vendor     = explode('/', $packageRow->name)[0];
        $package    = explode('/', $packageRow->name)[1];

        $source     = VENDOR_PATH  . '/' . $vendor . '/' . $package;
        $target     = MODULES_PATH;

        $command    = "cp -rf $source $target";
        $response   = shell_exec( $command );

        if ( ! empty( $response ) ) {
            Tiger_Log::error( $response );
        }

        $assets = MODULES_PATH  . '/' . $package . '/assets';
        $link   = PUBLIC_PATH . '/assets/' . $package;

        if ( file_exists( $assets ) && ! file_exists( $link )) {

            // ln -s /var/www/tiger-www/application/modules/modulename/assets /var/www/tiger-www/public/assets/modulename

            $command = "ln -sf $assets $link";
            $response = shell_exec( $command );

            if ( ! empty( $response ) ) {
                Tiger_Log::error( $response );
            }

        }

    }

    /**
     * Remove Package Files
     * Removes the module and associated symlink if present.
     *
     * @param $packageRow
     */
    public function removePackageFiles ( $packageRow ) {

        $package = explode('/', $packageRow->name)[1];

        /** First we need to remove any assets symlink ... */
        $link = PUBLIC_PATH . '/assets/' . $package;
        if ( file_exists( $link ) && is_link( $link ) ) {
            shell_exec( 'unlink ' . $link );
        };

        $module = MODULES_PATH . '/' . $package;
        shell_exec( 'rm -rf ' . $module );

    }

}