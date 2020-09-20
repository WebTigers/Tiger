<?php

trait Acl_Service_RoleTrait
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
    public function getAdminRolesDataTable ( $post ) {

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
            $recordsTotalRowset = $this->getAdminRoleSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminRoleSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                $record = (object) $recordRow->toArray();
                $record->DT_RowId = $record->role_id;
                $record->controls = $this->_getRoleActions( $record );
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
     * getAdminRoleSearchList returns a rowset of roles.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminRoleSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {

        return $this->_roleModel->getAdminRoleSearchList( $search, $offset, $limit, $orderby );

    }

    public function getRole ( $params )
    {
        if ( Tiger_Utility_Uuid::is_valid( $params['role_id'] ) ) {

            $roleRow = $this->_roleModel->getRoleById( $params['role_id'] );

            if ( ! empty( $roleRow ) ) {

                $this->_response->result = 1;
                $this->_response->data = $roleRow->toArray();


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

    public function getAdminStaticRolesDataTable ( )
    {
        $records = $this->getRoleConfigsList();

        /** Groom the Config for Datatables response ... */

        $recordsOut = [];
        foreach( $records as $key => $rec ) {

            $record = (object) $rec->toArray();
            $record->role_id = $key;
            $recordsOut[] = $record;

        }

        /** Set the pre-formatted array for datatables */
        $this->_response = new Core_Model_ResponseObjectDT([
            'data' => $recordsOut,
        ]);

    }

    public function getRoleConfigsList ( )
    {

        $roles = Zend_Registry::get('Zend_Config')->acl->roles;
        return ( empty( $roles ) ) ? [] : $roles;

    }

    protected function _getRoleActions ( $role ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $role->role_id,                              // Gets built as a data-id attribute.
            'param'     => '',                                          // Used for some Datatables toggles
            'value'     => '',                                          // Used for some Datatables toggles
            'class'     => 'fa fas fa-pencil-alt edit',                 // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_ROLE'),        // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $role->role_id,
            'class'     => ( intval($role->active) !== 1 )
                                ? 'fa fas fa-play active'
                                : 'fa fas fa-pause active',
            'title'     => ( intval($role->active) !== 1 )
                                ? $this->_translate->_('DT.ACTIVE_ROLE')
                                : $this->_translate->_('DT.INACTIVE_ROLE'),
            'label'     => ( intval($role->active) !== 1 )
                                ? $this->_translate->_('DT.ACTIVE')
                                : $this->_translate->_('DT.INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $role->role_id,
            'class'     => ( intval($role->deleted) !== 0 )
                                ? 'fa fas fa-trash-restore deleted'
                                : 'fa fas fa-trash deleted',
            'title'     => ( intval($role->deleted) !== 0 )
                                ? $this->_translate->_('DT.UNDELETE_ROLE')
                                :  $this->_translate->_('DT.DELETE_ROLE'),
            'label'     => ( intval($role->deleted) !== 0 )
                                ? $this->_translate->_('DT.UNDELETE')
                                : $this->_translate->_('DT.DELETE'),
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
    public function updateRole ( $params ) {

        $this->_form = new Acl_Form_Role();

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
        $data = $this->_form->getValues();

        try {

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
            $roleRow = $this->_persistRole( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $role = (object) $roleRow->toArray();
            $role->action = $this->_getRoleActions( $role );

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $role;
            $this->_response->setTextMessage( 'MESSAGE.ROLE_SAVED', 'success' );

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.NEWUSER_FAILED', 'alert' );

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
    public function saveRole ( $params ) {

        try {

            $this->_form = new Acl_Form_Role();

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
             * Since we're not really doing anything with the role being persisted
             * we don't need the $roleRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $roleRow = $this->_persistRole( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $roleRow;
            $this->_response->setTextMessage( 'MESSAGE.ROLE_SAVED', 'success' );

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
     * PersistRole is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the user table. If you
     * pass in a populated role_id, the persist will be treated as an update.
     *
     * @param $data
     * @throws Exception
     * @return mixed
     */
    protected function _persistRole( $data )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a role_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['role_id'] ) ) {

            $roleRow = $this->_roleModel->getRoleById( $data['role_id'] );

            if ( empty($roleRow) ) {
                throw new Exception('ERROR.ROLE_NOT_FOUND');
            }

            $roleRow->setFromArray( $data );

        }
        else {

            /** Create the row with our relevant data. */
            $roleRow = $this->_roleModel->createRow( $data );

            /** Update the relevant pieces with new role data. */
            $roleRow->role_id = Tiger_Utility_Uuid::v1();

        }

        /**
         * Now we can save the new role to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user. In our use case
         * we simply return the entire row object.
         */
        $roleRow->saveRow();
        return $roleRow;

    }

}