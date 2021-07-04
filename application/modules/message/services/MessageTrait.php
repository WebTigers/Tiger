<?php

trait Message_Service_MessageTrait
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
                $recordsOut[] = $record;

            }

            $headers = $this->_utility->getTranslation([
                'DT.TITLE',
                'DT.MESSAGE',
                'DT.TYPE_MESSAGE_STATUS',
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

    public function getAdminStaticMessagesDataTable ( )
    {
        $records = []; //$this->getMessageConfigsList();

        /** Groom the Config for Datatables response ... */

        $recordsOut = [];
        foreach( $records as $key => $rec ) {

            $record = (object) $rec->toArray();

            $record->message_id = $key;
            $record->module = explode( '_', $record->message )[0];

            $recordsOut[] = $record;

        }

        $headers = $this->_utility->getTranslation([
            'DT.MODULE',
            'DT.MESSAGE_NAME',
            'DT.MESSAGE_DESCRIPTION',
            'DT.MESSAGE',
            'DT.PRIVILEGE',
        ]);

        /** Set the pre-formatted array for datatables */
        $this->_response = new Core_Model_ResponseObjectDT([
            'data' => $recordsOut,
            'i18n' => $headers,
        ]);

    }

    public function getMessageConfigsList () {

        // return Zend_Registry::get('Zend_Config')->dev->messages;

    }

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

}