<?php

trait Register_Service_RegisterTrait
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
    public function getAdminRegistrationsDataTable ( $post ) {

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
            $recordsTotalRowset = $this->getAdminRegistrationsSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminRegistrationsSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->register_id;
                $record->controls = $this->_getRegisterActions( $record );
                $recordsOut[] = $record;

            }

            $headers = $this->_utility->getTranslation([
                'DT.NAME',
                'DT.COMPANY_NAME',
                'DT.EMAIL',
                'DT.COUNTRY',
                'DT.CREATE_DATE',
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
     * getAdminRegisterSearchList returns a rowset of registers.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminRegistrationsSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {

        return $this->_registerModel->getAdminRegistrationsSearchList( $search, $offset, $limit, $orderby );

    }

    protected function _getRegisterActions ( $register ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $register->register_id,                      // Gets built as a data-id attribute.
            'param'     => '',                                          // Used for some Datatables toggles
            'value'     => '',                                          // Used for some Datatables toggles
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_REGISTER'),    // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $register->register_id,
            'value'     => $register->subscribe,
            'class'     => ( intval($register->subscribe) !== 1 )
                                ? 'fa fas fa-envelope subscribe'
                                : 'fa fas fa-envelope-open-text subscribe',
            'title'     => $this->_translate->_('DT.SUBSCRIBE_UNSUBSCRIBE_REGISTER'),
            'label'     => $this->_translate->_('DT.SUBSCRIBE_UNSUBSCRIBE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $register->register_id,
            'value'     => $register->active,
            'class'     => ( intval($register->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => $this->_translate->_('DT.ACTIVE_INACTIVE_REGISTER'),
            'label'     => $this->_translate->_('DT.ACTIVE_INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $register->register_id,
            'value'     => $register->deleted,
            'class'     => ( intval($register->deleted) !== 0 )
                                ? 'fa fas fa-trash-restore deleted'
                                : 'fa fas fa-trash deleted',
            'title'     => $this->_translate->_('DT.DELETE_UNDELETE_REGISTER'),
            'label'     => $this->_translate->_('DT.DELETE_UNDELETE'),
        ];

        return $actions;

    }

    public function getRegistration ( $params )
    {
        if ( Tiger_Utility_Uuid::is_valid( $params['register_id'] ) ) {

            $registerRow = $this->_registerModel->getRegistrationById( $params['register_id'] );

            if ( ! empty( $registerRow ) ) {

                $this->_response->result = 1;
                $this->_response->data = $registerRow->toArray();


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

    ### Public Register Method ###

    public function register ( $params ) {

        $this->saveRegistration( $params );

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
    public function updateRegistration ( $params ) {

        $this->_form = new Register_Form_Register();

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
             * Since we're not really doing anything with the resource being persisted
             * we don't need the $registerRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $registerRow = $this->_persistRegistration( $data, true );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $register = (object) $registerRow->toArray();
            $register->action = $this->_getRegisterActions( $register );

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $register;
            $this->_response->setTextMessage( 'MESSAGE.REGISTER_SAVED', 'success' );

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.NEW_REGISTER_FAILED', 'alert' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getMessage() );

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
    public function saveRegistration ( $params ) {

        try {

            $this->_form = new Register_Form_Register();

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
             * Since we're not really doing anything with the resource being persisted
             * we don't need the $registerRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $registerRow = $this->_persistRegistration( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $registerRow;
            $this->_response->setTextMessage( 'MESSAGE.REGISTRATION_SAVED', 'success' );

        }
        catch ( Exception | Error $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'alert' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getMessage() );

        }

    }

    /**
     * PersistRegister is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the user table. If you
     * pass in a populated register_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @throws Exception
     * @return mixed
     */
    protected function _persistRegistration( array $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a register_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['register_id'] ) ) {

            $registerRow = $this->_registerModel->getRegistrationById( $data['register_id'] );

            if ( empty($registerRow) ) {
                throw new Exception('ERROR.REGISTER_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $registerRow->setFromArray( $data );

            }
            else {

                unset( $data['register_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $registerRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $registerRow = $this->_registerModel->createRow( $data );

            /** Update the relevant pieces with new resource data. */
            $registerRow->register_id = Tiger_Utility_Uuid::v1();
            $registerRow->create_ip = $_SERVER['REMOTE_ADDR'];

        }

        /**
         * Now we can save the new resource to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user. In our use case
         * we simply return the entire row object.
         */
        $registerRow->saveRow();
        return $registerRow;

    }

}