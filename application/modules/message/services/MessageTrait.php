<?php

trait Message_Service_MessageTrait
{
    ### Admin Service Functions ###

    /**
     * Perhaps one of the more complicated API calls is for DataTables. DataTables posts
     * a boatload of varied params based on the data within table. These DataTables functions
     * consume that set of params and messageanize it into something our models can deal with.
     *
     * This DataTable function is a pattern repeated over and over within Tiger and is easily
     * copy and paste for your unique DataTables use cases within the Tiger platform.
     *
     * @param $post
     * @return object DataTables response
     */
    public function getAdminMessagesDataTable ( $post ) {

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
            $recordsTotalRowset = $this->getAdminMessageSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminMessageSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->message_id;
                $record->controls = $this->_getMessageActions( $record );
                $data = $recordRow->toArray();
                $data['wrapper'] = true;
                $this->getMessageTemplate( $data );             // <-- outputs to the response object
                $record->rendered = $this->_response->data;     // <-- that we pickup here
                $recordsOut[] = $record;

            }

            $headers = $this->_utility->getTranslation([
                'DT.TITLE',
                'DT.MESSAGE',
                'DT.TARGET',
                'DT.TYPE_STATUS',
                'DT.ROUTE',
                'DT.LOCALE',
                'DT.START_DATE',
                'DT.END_DATE',
                'DT.ACTIONS',
                'DT.MESSAGE_ID',
                'DT.ACTIVE',
                'DT.DELETED',
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
     * getAdminMessageSearchList returns a rowset of messages.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminMessageSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {
        return $this->_messageModel->getAdminMessageSearchList( $search, $offset, $limit, $orderby );
    }

    /**
     * @param $message
     * @return array
     */
    protected function _getMessageActions ( $message )
    {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $message->message_id,                      // Gets built as a data-id attribute.
            'param'     => '',                                          // Used for some Datatables toggles
            'value'     => '',                                          // Used for some Datatables toggles
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_MESSAGE'),    // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $message->message_id,
            'value'     => $message->active,
            'class'     => ( intval($message->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => $this->_translate->_('DT.ACTIVE_INACTIVE_MESSAGE'),
            'label'     => $this->_translate->_('DT.ACTIVE_INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $message->message_id,
            'value'     => $message->deleted,
            'class'     => ( intval($message->deleted) !== 0 )
                                ? 'fa fas fa-trash-restore deleted'
                                : 'fa fas fa-trash deleted',
            'title'     => $this->_translate->_('DT.DELETE_UNDELETE_MESSAGE'),
            'label'     => $this->_translate->_('DT.DELETE_UNDELETE'),
        ];

        return $actions;

    }

    /**
     * @param $params
     * @return null, Sets response object.
     */
    public function getMessageTemplate ( $params )
    {
        if ( $this->_form->isValidPartial( $params ) ) {

            $data = $this->_form->getValidValues( $params );

            try {

                $module = explode(':', $data['target'] ) [0];
                $method = explode(':', $data['target'] ) [1];

                $class = ucfirst( strtolower( $module ) ) . '_Service_Template';
                $templateService = new $class();

                if ( method_exists( $templateService, $method ) ) {

                    $template = $templateService->$method( $data );

                    $this->_response->result = 1;
                    $this->_response->data = $template;

                }
                else {

                    throw new Exception('Template does not exist.');

                }

            }
            catch ( Error | Exception $e ) {

                pr( $e->getMessage() );

                Tiger_Log::error( $e->getMessage() );

            }

        }
        else {

            $this->_setFormErrors();

        }

    }

    /**
     * @param $params
     * @return null, Sets the response model.
     */
    public function getMessage ( $params )
    {
        if ( ! empty( $params['message_id'] ) && Tiger_Utility_Uuid::is_valid( $params['message_id'] ) ) {

            $messageRow = $this->_messageModel->getMessageById( $params['message_id'] );

            $messageRow->send_users = json_decode( $messageRow->send_users );
            $messageRow->send_roles = json_decode( $messageRow->send_roles );
            $messageRow->send_orgs  = json_decode( $messageRow->send_orgs  );

            $data = $messageRow->toArray();
            $data['wrapper'] = true;
            $this->getMessageTemplate( $data );             // <-- outputs to this class' response object
            $data['rendered'] = $this->_response->data;     // <-- that we pickup here

            $this->_response->result = 1;
            $this->_response->data = $data;

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.MESSAGE_NOT_FOUND', 'alert' );

        }

    }

    public function getMessageLocaleSelect2List( $params ) {

        $search_text = ( ! empty( $params['search'] ) ) ? $params['search'] : '';

        $options = $this->_utility->getLocalSelect2List( $params );
        array_unshift($options, (object)['id' => 'translate', 'text' => $this->_translate->translate('OPTION.USE_TRANSLATION_KEY')]);

        $out = array_values( array_filter( $options, function( $el ) use ( $search_text ) {
            return ( ! empty($search_text) ) ? ( stripos( $el->id, $search_text ) !== false || stripos( $el->text, $search_text ) !== false) : true;
        }) );

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $out,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    /**
     * This is a convenience method designed to consume a message parameter array and auto publish a message,
     * for specific types of system events, like package updates for instance. It will only publish to users
     * with the superadmin role.
     *
     * Valid Message Types are by SYSTEM.MESSAGE.TYPE_NAME where the system message is a valid notification
     * config key.
     *
     * @param $params
     * @return void, Sets the class response object
     */
    public function publish ( Array $params )
    {

        try {

            $params['title']          = ( ! empty( $params['title'] ) ) ? $params['title'] : '';
            $params['message']        = ( ! empty( $params['message'] ) ) ? $params['message'] : '';;
            $params['format']         = ( ! empty( $params['format'] ) ) ? $params['format'] : 'text';
            $params['icon_class']     = ( ! empty( $params['icon_class'] ) ) ? $params['icon_class'] : $this->_config->message->formats->{$params['format']}->icon_class;
            $params['dismissible']    = ( ! empty( $params['dismissible'] ) ) ? $params['dismissible'] : 0;

            $params['send_users']     = ( ! empty( $params['send_users'] ) ) ? $params['send_users'] : [];
            $params['send_roles']     = ( ! empty( $params['send_roles'] ) ) ? $params['send_roles'] : ['SUPERADMIN'];
            $params['send_orgs']      = ( ! empty( $params['send_orgs'] )  ) ? $params['send_orgs']  : [];

            $params['link']           = ( ! empty( $params['link'] ) ) ? $params['link'] : 'javascript:void(0)';
            $params['link_new']       = ( ! empty( $params['link_new'] ) && intval( $params['link_new'] ) === 1 ) ? 'target="_blank"' : '';

            $params['type_status']    = 'PUBLISHED';

            $params['target']         = ( ! empty( $params['target'] ) ) ? $params['target'] : '';
            $params['locale']         = ( ! empty( $params['locale'] ) ) ? $params['locale'] : 'translate';

            $params['start_date']     = ( ! empty( $params['start_date'] ) ) ? $params['start_date'] : '';
            $params['end_date']       = ( ! empty( $params['end_date'] ) ) ? $params['end_date'] : '';

        }
        catch ( Error | Exception $e ) {

            // pr( $e->getMessage() );

            Tiger_Log::error( 'Message_Service_MessageTrait->publish(): ' . $e->getMessage() );

        }

        $this->saveMessage( $params );

    }

    /**
     * Publish Message — instantiates and calls the target service's publish() method.
     * @param $message
     * @return void, returns nothing buy may log errors.
     */
    protected function _publishMessage( $message )
    {

        try {

            /** The message['target'] will be in the form of: "module:service". If it's not, the class lookup will simply fail quietly. */

            $target = explode(':', $message['target'] );
            $class = ucfirst( strtolower( $target[0] ) ) . '_Service_' . ucfirst( strtolower( $target[1] ) );

            if ( class_exists( $class ) && method_exists( $class, 'publish' ) ) {

                $targetService = new $class([]);    // Since this is a service than can be called via the Tiger API, we pass in an empty array for construction.
                $targetService->publish( $message );

                $this->_response = $targetService->getResponse();

            }
            else {

                Tiger_Log::error( 'Message_Service_MessageTrait->publishMessage(): Class or publish method does not exist: ' . $class );

            }

        }
        catch ( Error | Exception $e ) {

            Tiger_Log::error( 'Message_Service_Trait->_publishMessage: ' . $e->getMessage() );
            throw $e;

        }

    }

    ##### Message Persistence Methods #####

    /**
     * Service "update" methods essentially are the gateway to persisting small
     * pieces of form data. Update is responsible for validating and then forwarding
     * the tiny bits of clean data to the "persist" method for any grooming which
     * is then sent to the data model.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function updateMessage ( $params ) {

        $this->_form = new Message_Form_Message();

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
             * Since we're not really doing anything with the message being persisted
             * we don't need the $messageRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $messageRow = $this->_persistMessage( $data, true );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $message = (object) $messageRow->toArray();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $message;
            $this->_response->setTextMessage( 'MESSAGE.MESSAGE_SAVED', 'success' );

        }
        catch ( Error | Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.UPDATE_FAILED', 'alert' );

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
    public function saveMessage ( $params ) {

        try {

            $params['send_users'] = ( ! empty( $params['send_users'] ) ) ? json_encode( $params['send_users'], 1 ) : '';
            $params['send_roles'] = ( ! empty( $params['send_roles'] ) ) ? json_encode( $params['send_roles'], 1 ) : '';
            $params['send_orgs']  = ( ! empty( $params['send_orgs']  ) ) ? json_encode( $params['send_orgs'],  1 ) : '';

            $this->_form = new Message_Form_Message();

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
             * Since we're not really doing anything with the message being persisted
             * we don't need the $messageRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $messageRow = $this->_persistMessage( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $message = $messageRow->toArray();

            /**
             * Once the message has been saved, the message is then sent to the target's
             * publish method. Usually this happens only once, but it can happen multiple
             * times if the message has updates. The target's publish method should account
             * for updates to an existing message without publishing the message twice.
             * NOTE that the data we send to the publish method is a simple data array. The
             * publish method should never have the ability to update the message table.
             */
            $this->_publishMessage( $message );

            /**
             * The target service will return a response that we populate this message service
             * with. If that response is good, then we're good to set our data and messages. If not,
             * then we just return the errors from the target service. Super easy.
             */
            if ( $this->_response->result === 1 ) {

                $message['wrapper'] = true;
                $this->getMessageTemplate( $message );          // <-- outputs to the response object
                $message['rendered'] = $this->_response->data;  // <-- that we pickup here

                $this->_response->clearMessages();
                $this->_response->data = (object) $message;
                $this->_response->setTextMessage( 'MESSAGE.MESSAGE_SAVED', 'success' );

            }

        }
        catch ( Error | Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'error' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getMessage() );

        }

    }

    /**
     * PersistMessage is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the message table. If you
     * pass in a populated message_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @return mixed
     * @throws Exception
     */
    protected function _persistMessage( $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a message_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['message_id'] ) ) {

            $messageRow = $this->_messageModel->getMessageById( $data['message_id'] );

            if ( empty($messageRow) ) {
                throw new Exception('ERROR.MESSAGE_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $messageRow->setFromArray( $data );

            }
            else {

                unset( $data['message_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $messageRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $messageRow = $this->_messageModel->createRow( $data );

            /**
             * Update the relevant pieces with new message system data. As a rule of thumb,
             * system data is added here while user added data is massaged in the update
             * or save methods.
             */
            $messageRow->message_id = Tiger_Utility_Uuid::v1();

        }

        /**
         * Now we can save the new message to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this message. In our use case
         * we simply return the entire row object.
         */
        $messageRow->saveRow();
        return $messageRow;

    }
    
}