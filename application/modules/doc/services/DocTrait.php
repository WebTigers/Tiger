<?php

trait Doc_Service_DocTrait
{
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
    public function getAdminDocsDataTable($post)
    {
        $validationResponse = $this->_utility->validateDataTables($post);

        if ($validationResponse === true) {

            /** Are we ordering by some column(s)? */
            $orderby = '';
            if (count($post['order']) > 0) {
                foreach ($post['order'] as $order) {
                    $columnNumber = $order['column'];
                    $direction = $order['dir'];
                    $orderby .= $post['columns'][$columnNumber]['name'] . " " . $direction . ", ";
                }
                $orderby = substr($orderby, 0, -2);
            }

            /** DataTables needs a filtered count for pagination */
            $recordsTotalRowset = $this->getAdminDocSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminDocSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ($recordsFilteredRowset as $recordRow) {
                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->role_id;
                $record->controls = $this->_getDocActions($record);
                $recordsOut[] = $record;
            }

            $headers = $this->_utility->getTranslation([
                'DT.DOC_ID',
                'DT.PARENT_DOC_ID',
                'DT.TITLE',
                'DT.ACTIONS',
                'DT.ACTIVE',
                'DT.DELETED',
                
            ]);

            /** Set the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval($post['draw']),
                'recordsTotal'      => count($recordsTotalRowset),
                'recordsFiltered'   => count($recordsTotalRowset),
                'data'              => $recordsOut,
                'i18n'              => $headers,
            ]);
        } else {

            /** Set an empty the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval($post['draw']),
                'recordsTotal'      => 0,
                'recordsFiltered'   => 0,
                'data'              => [],
                'error'             => $validationResponse
            ]);
        }
    }
    
    /**
     * getAdminDocSearchList returns a rowset of roles.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminDocSearchList($search = '', $offset = 0, $limit = 0, $orderby = '')
    {
        return $this->_docModel->getAdminDocSearchList($search, $offset, $limit, $orderby);
    }
    
    public function getDoc($params)
    {
        if ( Tiger_Utility_Uuid::is_valid( $params['doc_id'] ) ) {

            $row = $this->_docModel->getDocById($params['doc_id'] );

            if (! empty($row)) {
                $this->_response->result = 1;
                $this->_response->data = $row->toArray();
            } else {
                $this->_response->result = 0;
                $this->_response->setTextMessage('ERROR.NOT_FOUND', 'alert');
            }
        } else {
            $this->_response->result = 0;
            $this->_response->setTextMessage('ERROR.INVALID', 'alert');
        }
    }
    
    protected function _getDocActions($doc)
    {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $doc->doc_id,                              // Gets built as a data-id attribute.
            'param'     => '',                                          // Used for some Datatables toggles
            'value'     => '',                                          // Used for some Datatables toggles
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_DOC'),        // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $doc->doc_id,
            'value'     => $doc->active,
            'class'     => ( intval($doc->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => $this->_translate->_('DT.INACTIVE_ACTIVE'),
            'label'     => $this->_translate->_('DT.ACTIVE'),
        ];
        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $doc->doc_id,
            'value'     => $doc->deleted,
            'class'     => ( intval($doc->deleted) !== 0 )
                                ? 'fa fas fa-trash-restore deleted'
                                : 'fa fas fa-trash deleted',
            'title'     => $this->_translate->_('DT.DELETE_UNDELETE_DOC'),
            'label'     => $this->_translate->_('DT.DELETE_UNDELETE'),
        ];

        return $actions;
    }
    
    /**
     * Service "save" methods essentially are the gateway to persisting whole forms
     * of data. Save is responsible for validating and then forwarding clean data to
     * the "persist" method for any grooming which is then sent to the data model.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function saveDoc($params)
    {

        try {
            $this->_form = new Doc_Form_Doc();

            /**
             * Note that in Tiger, isValid() is subclassed to remove any request routing
             * params that are not part of the form. If you wish to preserve the entire
             * $params array, call the $form->isValidPreserve() method instead.
             */
            if (! $this->_form->isValid($params)) {

                /**
                 * We use a convenience method to set the form errors into
                 * the responseObject and we're done here.
                 */
                $this->_setFormErrors();
                return;
            }

            /** Gets the filtered and validated values from the form. We've got clean data. */
            $data = $this->_form->getValidValues($params);

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();
            
            /**
             * Since we're not really doing anything with the role being persisted
             * we don't need the $roleRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $row = $this->_persistDoc($data, true);

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $row;
            $this->_response->setTextMessage('MESSAGE.DOC_SAVED', 'success');
        } catch (Exception $e) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage('MESSAGE.SAVE_FAILED', 'alert');

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );
        } catch (Error $e) {
            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            //$this->_response->setTextMessage('MESSAGE.SAVE_FAILED', 'alert');
            $this->_response->setTextMessage($e->getMessage(), 'alert');

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );
        }
    }
    
    /**
     * PersistDoc is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the user table. If you
     * pass in a populated doc_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @throws Exception
     * @return mixed
     */
    protected function _persistDoc(array $data, $partial = false)
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        if (! empty($data['doc_id'])) {
            $row = $this->_docModel->getDocById($data['doc_id']);

            if (empty($row)) {
                throw new Exception('ERROR.DOC_NOT_FOUND');
            }

            if ($partial === false) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $row->setFromArray($data);
            } else {
                unset($data['doc_id']);  // Security precaution
                foreach ($data as $prop => $value) {
                    $row->$prop = $value;
                }
            }
        } else {

            /** Create the row with our relevant data. */
            $row = $this->_docModel->createRow($data);

            /** Update the relevant pieces with new role data. */
            $row->doc_id = Tiger_Utility_Uuid::v1();
        }
        
        try{
            $row->saveRow();
        }catch(Exception $e){
            Tiger_Log::logger( __FILE__ . ': ' . __LINE__ . ' line, Error : ' . $e->getMessage() );
        }
        
        return $row;
    }
    
    public function updateDoc($params)
    {
        try {
            $this->_form = new Doc_Form_Doc();

            if (! $this->_form->isValidPartial($params)) {
                /**
                 * We use a convenience method to set the form errors into
                 * the responseObject and we're done here.
                 */
                $this->_setFormErrors();
                return;
            }

            /** Gets the filtered and validated values from the form. We've got clean data. */
            $data = $this->_form->getValidValues($params);

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();
            
            /**
             * Just changing the document status active or disabled
             */
            $row = $this->_persistDoc($data, true);

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $row->toArray();
            $this->_response->setTextMessage('MESSAGE.DOC_SAVED', 'success');
        } catch (Exception $e) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage('MESSAGE.SAVE_FAILED', 'alert');

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );
        } catch (Error $e) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            //$this->_response->setTextMessage('MESSAGE.SAVE_FAILED', 'alert');
            $this->_response->setTextMessage($e->getMessage(), 'alert');

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );
        }
    }
}
