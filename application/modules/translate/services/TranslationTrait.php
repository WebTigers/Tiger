<?php

trait Translate_Service_TranslationTrait
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
    public function getAdminTranslationsDataTable ( $post ) {

        if ( $this->_validateDataTables( $post ) ) {

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
            $recordsTotalRowset = $this->getAdminTranslationSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminTranslationSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->translation_id;
                $record->controls = $this->_getTranslationActions( $record );
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
                'error'             => $this->_searchErrors
            ]);

        }

    }

    /**
     * getAdminTranslationSearchList returns a rowset of translations.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminTranslationSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {

        return $this->_translationModel->getAdminTranslationSearchList( $search, $offset, $limit, $orderby );

    }

    public function getTranslation ( $params )
    {
        if ( Tiger_Utility_Uuid::is_valid( $params['translation_id'] ) ) {

            $translationRow = $this->_translationModel->getTranslationById( $params['translation_id'] );

            if ( ! empty( $translationRow ) ) {

                $this->_response->result = 1;
                $this->_response->data = $translationRow->toArray();


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

    public function getAdminStaticTranslationsDataTable ( )
    {
        $records = $this->getTranslationConfigsList();

        /** Groom the Config for Datatables response ... */

        $recordsOut = [];
        foreach( $records as $key => $rec ) {

            $record = (object) $rec->toArray();

            $record->translation_id = $key;
            $record->module = explode( '_', $record->translation )[0];

            $recordsOut[] = $record;

        }

        /** Set the pre-formatted array for datatables */
        $this->_response = new Core_Model_ResponseObjectDT([
            'data' => $recordsOut,
        ]);

    }

    public function getTranslationConfigsList () {

        return Zend_Registry::get('Zend_Config')->acl->translations;

    }

    protected function _getTranslationActions ( $translation ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $translation->translation_id,                      // Gets built as a data-id attribute.
            'param'     => '',                                          // Used for some Datatables toggles
            'value'     => '',                                          // Used for some Datatables toggles
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_RESOURCE'),    // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $translation->translation_id,
            'value'     => $translation->active,
            'class'     => ( intval($translation->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => $this->_translate->_('DT.ACTIVE_INACTIVE_RESOURCE'),
            'label'     => $this->_translate->_('DT.ACTIVE_INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $translation->translation_id,
            'value'     => $translation->deleted,
            'class'     => ( intval($translation->deleted) !== 0 )
                                ? 'fa fas fa-trash-restore deleted'
                                : 'fa fas fa-trash deleted',
            'title'     => $this->_translate->_('DT.DELETE_UNDELETE_RESOURCE'),
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
    public function updateTranslation ( $params ) {

        $this->_form = new Acl_Form_Translation();

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
             * Since we're not really doing anything with the translation being persisted
             * we don't need the $translationRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $translationRow = $this->_persistTranslation( $data, true );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $translation = (object) $translationRow->toArray();
            $translation->action = $this->_getTranslationActions( $translation );

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $translation;
            $this->_response->setTextMessage( 'MESSAGE.RESOURCE_SAVED', 'success' );

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.NEW_RESOURCE_FAILED', 'alert' );

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
    public function saveTranslation ( $params ) {

        try {

            $this->_form = new Acl_Form_Translation();

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
             * Since we're not really doing anything with the translation being persisted
             * we don't need the $translationRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $translationRow = $this->_persistTranslation( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $translationRow;
            $this->_response->setTextMessage( 'MESSAGE.RESOURCE_SAVED', 'success' );

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
     * PersistTranslation is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the user table. If you
     * pass in a populated translation_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @throws Exception
     * @return mixed
     */
    protected function _persistTranslation( array $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a translation_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['translation_id'] ) ) {

            $translationRow = $this->_translationModel->getTranslationById( $data['translation_id'] );

            if ( empty($translationRow) ) {
                throw new Exception('ERROR.RESOURCE_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $translationRow->setFromArray( $data );

            }
            else {

                unset( $data['translation_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $translationRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $translationRow = $this->_translationModel->createRow( $data );

            /** Update the relevant pieces with new translation data. */
            $translationRow->translation_id = Tiger_Utility_Uuid::v1();

        }

        /**
         * Now we can save the new translation to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user. In our use case
         * we simply return the entire row object.
         */
        $translationRow->saveRow();
        return $translationRow;

    }

}