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

trait Core_Service_ConfigTrait
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
    public function getAdminConfigsDataTable ( $post ) {

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
            $recordsTotalRowset = $this->getAdminConfigSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminConfigSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->config_id;
                $record->controls = $this->_getConfigActions( $record );
                $recordsOut[] = $record;

            }

            /** Set the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => count( $recordsTotalRowset ),
                'recordsFiltered'   => count( $recordsTotalRowset ),
                'data'              => $recordsOut,
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
     * getAdminConfigSearchList returns a rowset of configs.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminConfigSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {

        return $this->_configModel->getAdminConfigSearchList( $search, $offset, $limit, $orderby );

    }

    public function getConfig ( $params )
    {
        if ( Tiger_Utility_Uuid::is_valid( $params['config_id'] ) ) {

            $configRow = $this->_configModel->getConfigById( $params['config_id'] );

            if ( ! empty( $configRow ) ) {

                $this->_response->result = 1;
                $this->_response->data = $configRow->toArray();


            }
            else {

                $this->_response->result = 0;
                $this->_response->setTextMessage('ERROR.NOT_FOUND', 'alert');

            }

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage('ERROR.INVALID', 'alert');

        }

    }

    protected function _getConfigActions ( $config ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $config->config_id,                          // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_ORG'),         // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $config->config_id,
            'value'     => $config->active,
            'class'     => ( intval($config->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => $this->_translate->_('DT.ACTIVE_INACTIVE_ORG'),
            'label'     => $this->_translate->_('DT.ACTIVE_INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $config->config_id,
            'value'     => $config->deleted,
            'class'     => ( intval($config->deleted) !== 0 )
                                ? 'fa fas fa-trash-restore deleted'
                                : 'fa fas fa-trash deleted',
            'title'     => $this->_translate->_('DT.DELETE_UNDELETE_ORG'),
            'label'     => $this->_translate->_('DT.DELETE_UNDELETE'),
        ];

        return $actions;

    }

    ### Persistence Methods ###

    /**
     * Service "update" methods essentially are the gateway to persisting small
     * pieces of form data. Update is responsible for validating and then forwarding
     * the tiny bits of clean data to the "persist" method for any grooming which
     * is then sent to the data model.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function updateConfig ( $params ) {

        $this->_form = new Core_Form_Config();

        /**
         * One of the first things to check for is the existence of unique fields
         * within the saveConfig payload. Tiger will complain if we try to re-insert
         * or update the config record with the same email or configname. This function
         * simply removes certain form validators. Note that this function only works
         * if passed a config_id as part of the params payload.
         */
        $this->_removeUniqueConfigValidation( $params );

        /**
         * Note that in Tiger, isValid() is subclassed to remove any request routing
         * params that are not part of the form. If you wish to preserve the entire
         * $params array, call the $form->isValidPreserve() method instead.
         */
        if ( ! $this->_form->isValidPartial( $params ) ) {

            /**
             * We use a convenience method to set the form errors into
             * the responseObject and we're done here.
             */
            $this->_setFormErrors();
            return;

        }

        /** Gets the filtered and validated values from the form. We've got clean data. */
        $data = $this->_form->getValidValues( $params );

        try {

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();

            /**
             * Since we're not really doing anything with the config being persisted
             * we don't need the $configRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $configRow = $this->_persistConfig( $data, true );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $config = (object) $configRow->toArray();
            $config->action = $this->_getConfigActions( $config );

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $config;
            $this->_response->setTextMessage( 'MESSAGE.ORG_SAVED', 'success' );

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.UPDATE_FAILED', 'alert' );

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );

        }

    }

    /**
     * Service "save" methods essentially are the gateway to persisting whole forms
     * of data. Save is responsible for validating and then forwarding clean data to
     * the "persist" method for any grooming which is then sent to the data model.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function saveConfig ( $params ) {

        try {

            $this->_form = new Core_Form_Config();

            /**
             * One of the first things to check for is the existence of unique fields
             * within the saveConfig payload. Tiger will complain if we try to re-insert
             * or update the config record with the same email or configname. This function
             * simply removes certain form validators. Note that this function only works
             * if passed a config_id as part of the params payload.
             */
            $this->_removeUniqueConfigValidation( $params );

            /**
             * Note that in Tiger, isValid() is subclassed to remove any request routing
             * params that are not part of the form. If you wish to preserve the entire
             * $params array, call the $form->isValidPreserve() method instead.
             */
            if ( ! $this->_form->isValid( $params ) ) {

                /**
                 * We use a convenience method to set the form errors into
                 * the responseObject and we're done here.
                 */
                $this->_setFormErrors();
                return;

            }

            /** Gets the filtered and validated values from the form. We've got clean data. */
            $data = $this->_form->getValues();

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();

            /**
             * Since we're not really doing anything with the config being persisted
             * we don't need the $configRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $configRow = $this->_persistConfig( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $configRow;
            $this->_response->setTextMessage( 'MESSAGE.CONFIG_SAVED', 'success' );

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'alert' );

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );

        }
        catch ( Error $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'alert' );

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );

        }

    }

    /**
     * PersistConfig is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the config table. If you
     * pass in a populated config_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @return mixed
     * @throws Exception
     */
    protected function _persistConfig( $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a config_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['config_id'] ) ) {

            $configRow = $this->_configModel->getConfigById( $data['config_id'] );

            if ( empty($configRow) ) {
                throw new Exception('ERROR.ORG_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $configRow->setFromArray( $data );

            }
            else {

                unset( $data['config_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $configRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $configRow = $this->_configModel->createRow( $data );

            /**
             * Update the relevant pieces with new config system data. As a rule of thumb,
             * system data is added here while user added data is massaged in the update
             * or save methods.
             */
            $configRow->config_id = Tiger_Utility_Uuid::v1();

        }

        /**
         * Now we can save the new config to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this config. In our use case
         * we simply return the entire row object.
         */
        $configRow->saveRow();

        /** Because configs are a cached resource, we need to clear the cache to see the change ... */
        Zend_Registry::get('Zend_Cache')->clean( Zend_Cache::CLEANING_MODE_ALL );

        return $configRow;

    }

    /**
     * @param $params array
     */
    protected function _removeUniqueConfigValidation ( $params )
    {
        /** If the config_id is empty, this is an insert and we don't need to be here. */
        if ( empty( $params['config_id'] ) ) { return; }

        /** If the config_id is not a valid UUID, we're outta here. */
        if ( ! Tiger_Utility_Uuid::is_valid( $params['config_id'] ) ) { return; }

        $configRow = $this->_configModel->getConfigById( $params['config_id'] );

        /** If there is no record for the config_id, then we're outta here as well. */
        if ( empty( $configRow ) ){ return; }

        /** If the configname is the same as the config's existing record, removed the validator. */
        if ( ! empty( $params['key'] ) && $params['key'] === $configRow->key ) {
            $this->_form->getElement('key')->removeValidator('Db_NoRecordExists');
        }

    }

}