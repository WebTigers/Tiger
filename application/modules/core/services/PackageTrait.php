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

trait Core_Service_PackageTrait
{
    ### Admin Service Functions ###

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

        $form = new Core_Form_Package();
        $form->getElement('name')->removeValidator('Db_NoRecordExists');
        if ( ! $form->isValidPartial( $params ) ) {
            $this->_setFormErrors( $form );
            return;
        }

        try {

            $composerService = new Core_Service_Composer([]);
            $packageRow = $this->_packageModel->getPackageByName( $params['name'] );

            if ( ! empty( $packageRow ) ) {

                if ( $composerService->isActive( $packageRow->name ) ){
                    $this->removeAssetsLink( $packageRow->name );
                    $this->removeModule( $packageRow->name );
                }

                $composerService->removePackage( $packageRow->name );
                $composerService->removeRepository( $packageRow->repo_url );
                $composerService->setComposerJSON();
                $composerService->updatePackage( $packageRow->name );
                $packageRow->delete();

            } else {

                $this->_response->result = 0;
                $this->_response->setTextMessage( 'MESSAGE.UPDATE_FAILED', 'alert' );

            }

        }
        catch( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'alert' );

        }

    }

    public function removeAssetsLink ( $name ) {

        $dir = PUBLIC_PATH . '/assets/' . explode('/', $name)[1];
        if ( file_exists( $dir ) && is_link( $dir ) ) {
            unlink( $dir );
        }

    }

    public function removeModule ( $name ) {

        $dir = MODULES_PATH . '/' . explode('/', $name)[1];
        if ( file_exists( $dir ) && is_dir( $dir ) ) {
            unlink( $dir );
        }

    }

    /**
     * Save Package
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function savePackage ( $params ) {

        $form = new Core_Form_Package();

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

            $composerService = new Core_Service_Composer([]);
            $composerService->addPackage( $data['name'], $data['target_version'], $data['repo_type'], $data['repo_url'] );

            $this->_response->result = 1;
            $this->_response->setTextMessage( 'MESSAGE.PACKAGE_ADDED', 'success' );

        }
        catch( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'error' );

        }

    }

    public function setActivePackage ( $params ) {

        $composerService = new Core_Service_Composer([]);

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
                if ( $composerService->isActive( $packageRow ) ) {
                    $this->removePackage( $packageRow );
                }

                $message = 'MESSAGE.PACKAGE_REMOVED';

            }
            else {

                if ( ! $composerService->isActive( $packageRow ) ) {
                    $this->copyPackage( $packageRow );
                }

                $message = 'MESSAGE.PACKAGE_ACTIVE';

            }

            $this->_response->result = 1;
            $this->_response->setTextMessage( $message, 'success' );

        }
        catch( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'error' );

        }

    }

    /**
     * Copy Package
     * Copies the package from the vendor dir to the module dir. Also adds a symlink for the assets if necessary.
     *
     * @param $packageRow
     */
    public function copyPackage ( $packageRow ) {

        $source = VENDOR_PATH  . '/' . explode('/', $packageRow->name)[0] . '/' . explode('/', $packageRow->name)[1];
        $target = MODULES_PATH . '/' . explode('/', $packageRow->name)[1];
        shell_exec( "cp -rf $source $target" );

        if ( file_exists( $target . '/assets' ) ) {
            $module = MODULES_PATH  . '/' . explode('/', $packageRow->name)[1] . '/assets';
            $link = PUBLIC_PATH . '/assets/' . explode('/', $packageRow->name)[1];
            shell_exec( "ln -s $module $link" );
        }

    }

    public function removePackage ( $packageRow ) {

        /** First we need to remove any assets symlink ... */
        $dir = PUBLIC_PATH . '/assets/' . explode('/', $packageRow->name)[1];
        if ( file_exists( $dir ) && is_link( $dir ) ) {
            shell_exec( 'unlink ' . $dir );
        };

        $dir = MODULES_PATH . '/' . explode('/', $packageRow->name)[1];
        shell_exec( 'rm -rf ' . $dir );

    }

    public function updatePlatform ( ) {

        $source = VENDOR_PATH  . '/webtigers/platform';
        $target = '/var/www/tiger-www/';
        shell_exec( "cp -rf $source $target" );

    }

    public function updatePackage ( $params ) {

        $composerService = new Core_Service_Composer([]);

        try {

            if ( ! Tiger_Utility_Uuid::is_valid( $params['package_id'] ) ) {
                throw new Exception( $this->_translate->translate('ERROR.INVALID_ID') );
            }

            $packageRow = $this->_packageModel->getPackageById( $params['package_id'] );

            if ( empty( $packageRow ) ) {
                throw new Exception( $this->_translate->translate('ERROR.PACKAGE_NOT_FOUND') );
            }

            $response = $composerService->updatePackage( $packageRow->name );

            /** Writes the response to the application.log */
            Tiger_Log::file( $response );

            /** If this is the Tiger platform, we need to do updates a bit differently. Copy the new files immediately. */
            if ( $packageRow->type === 'tiger-platform' ) {
                $this->updatePlatform();
            }

            $composerService->savePackage($packageRow);

            $this->_response->result = 1;
            $this->_response->setTextMessage('MESSAGE.PACKAGE_UPDATED', 'success');

        }
        catch( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage( $e->getMessage(), 'error' );

        }

    }

}