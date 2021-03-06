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

trait Account_Service_UserTrait
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
    public function getAdminUsersDataTable ( $post ) {

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
            $recordsTotalRowset = $this->getAdminUserSearchList(
                $post['search']['value']
            );

            $recordsFilteredRowset = $this->getAdminUserSearchList(
                $post['search']['value'],
                $post['start'],
                $post['length'],
                $orderby
            );

            $recordsOut = [];
            foreach ( $recordsFilteredRowset as $recordRow ) {

                /** Some user data we never want to push into the UI ... */
                $userData = $recordRow->toArray();
                unset(
                    $userData['password'],
                    $userData['answer_1'],
                    $userData['answer_2'],
                    $userData['answer_3']
                );

                $record = (object) $userData;
                $record->DT_RowId = $record->user_id;
                $record->controls = $this->_getUserActions( $record );
                $recordsOut[] = $record;

            }

            $headers = $this->_utility->getTranslation([
                'DT.USERNAME',
                'DT.USER_DISPLAY_NAME',
                'DT.USER_DISPLAY_NAME',
                'DT.EMAIL',
                'DT.FIRST_NAME',
                'DT.LAST_NAME',
                'DT.ROLE',
                'DT.ACTIONS',
                'DT.USER_ID',
                'DT.MIDDLE_NAME',
                'DT.ACTIVE',
                'DT.DELETED',
            ]);

            /** Set the pre-formatted array for datatables */
            $this->_response = new Core_Model_ResponseObjectDT([
                'draw'              => intval( $post['draw'] ),
                'recordsTotal'      => count( $recordsTotalRowset ),
                'recordsFiltered'   => count( $recordsTotalRowset ),
                'data'              => $recordsOut,
                'i18n'              => $headers
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
     * getAdminUserSearchList returns a rowset of users.
     *
     * @param $search
     * @param int $offset
     * @param int $limit
     * @param string $orderby
     * @return array of Zend Db Table Rowset
     */
    public function getAdminUserSearchList ( $search = '', $offset = 0, $limit = 0, $orderby = '' )
    {

        return $this->_userModel->getAdminUserSearchList( $search, $offset, $limit, $orderby );

    }

    public function getUser ( $params )
    {
        /**
         * Since both admins and users will be getting users via this method,
         * we don't want users to be able to just insert any user_id, so we
         * check to see if we have admin or user profile. The user will be
         * accessing this method from the "Account_Service_Account" class.
         */
        if ( $this->_reflection->getShortName() === 'Account_Service_Account' ) {
            $params['user_id'] = Zend_Auth::getInstance()->getIdentity()->user_id;
        }

        if ( Tiger_Utility_Uuid::is_valid( $params['user_id'] ) ) {

            $userRow = $this->_userModel->getUserById( $params['user_id'] );

            if ( ! empty( $userRow ) ) {

                /** Some user information is just not needed ... */
                $userData = $userRow->toArray();
                unset(
                    $userData['password'],
                    $userData['answer_1'],
                    $userData['answer_2'],
                    $userData['answer_3']
                );

                $this->_response->result = 1;
                $this->_response->data = $userData;

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

    public function getUserCount ( $params )
    {

        $userIds    = ( ! empty( $params['send_users'] ) ) ? $params['send_users'] : '';
        $roleIds    = ( ! empty( $params['send_roles'] ) ) ? $params['send_roles'] : '';
        $orgIds     = ( ! empty( $params['send_orgs'] ) )  ? $params['send_orgs']  : '';

        $count = $this->_userModel->getUserCount( $userIds, $roleIds, $orgIds )->total;
        $message = sprintf( $this->_translate->translate('MESSAGE.TOTAL_USERS'), number_format( $count ) );

        $this->_response->status = 1;
        $this->_response->data = $count;
        $this->_response->setTextMessage( $message, 'info' );

    }

    public function getUserSelect2List ( $params )
    {
        try {

            $search     = ( isset( $params['search'] ) ) ? $params['search'] : '';
            $offset     = ( isset( $params['page']   ) ) ? $params['page']   : 0;
            $limit      = ( isset( $params['limit']  ) ) ? $params['limit']  : 1;
            $orderby    = ( isset( $params['order']  ) ) ? $params['order']  : '';

            $results = [];
            $userRowset = $this->_userModel->getUserSearchList( $search, $offset, $limit, $orderby );

            foreach ( $userRowset as $userRow ) {

                $displayNme = ( empty( $userRow->user_display_name ) )
                    ? $userRow->first_name . ' ' . $userRow->last_name
                    : $userRow->user_display_name;

                $results[] = (object) ['id' => $userRow->user_id, 'text' => $userRow->username . ' - ' . $displayNme ];
            }

            $this->_response = new Core_Model_ResponseObjectSelect2([
                'results' => $results,
                'pagination' => (object) ['more' => false ],
                'error' => null,
                'login' => false,
            ]);

        }
        catch ( Error | Exception $e ) {

            // pr( $e->getMessage() );

            Tiger_Log::error( $e->getMessage() );

        }

    }

    public function getRoleSelect2List ( $params )
    {
        $acl        = Zend_Registry::get('Zend_Acl');
        $aclRoles   = Zend_Registry::get('Zend_Config')->acl->roles->toArray();
        $userRole   = Zend_Auth::getInstance()->getIdentity()->role;
        $results    = [];

        foreach ( $aclRoles as $role => $roleData ) {

            // Only allow assigning of roles at or below the user's own role //
            if ( isset( $params['search'] ) ) {
                if ( trim( $params['search'] ) === $role ) {
                    $results[] = (object)['id' => $role, 'text' => $roleData['role_name'] . ' - ' . $roleData['role_description']];
                }
            }
            else {
                if ( $acl->inheritsRole($userRole, $role, false) || $role === $userRole ) {
                    $results[] = (object)['id' => $role, 'text' => $roleData['role_name'] . ' - ' . $roleData['role_description']];
                }
            }
        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $results,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);

    }

    protected function _getUserActions ( $user ) {

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $user->user_id,                              // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fas fa-pencil-alt edit',                    // The class for the icon or button.
            'title'     => $this->_translate->_('DT.EDIT_USER'),        // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.EDIT'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $user->user_id,                              // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fas fa-sitemap orguser',                    // The class for the icon or button.
            'title'     => $this->_translate->_('DT.ORGS'),             // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.ORGS'),             // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $user->user_id,                              // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fa fa-address-card address',                // The class for the icon or button.
            'title'     => $this->_translate->_('DT.ADDRESS'),          // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.ADDRESS'),          // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',                                      // Controls are either 'icon' or 'button'.
            'id'        => $user->user_id,                              // Gets built as a data-id attribute.
            'value'     => '',                                          // Gets built as a data-value attribute.
            'class'     => 'fa fa-mobile-alt contact',                  // The class for the icon or button.
            'title'     => $this->_translate->_('DT.CONTACT'),          // The title attribute, often used for tooltips.
            'label'     => $this->_translate->_('DT.CONTACT'),          // The title attribute.
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $user->user_id,
            'value'     => $user->active,
            'class'     => ( intval($user->active) !== 1 )
                                ? 'fas fa-play active'
                                : 'fas fa-pause active',
            'title'     => $this->_translate->_('DT.ACTIVE_INACTIVE_USER'),
            'label'     => $this->_translate->_('DT.ACTIVE_INACTIVE'),
        ];

        $actions[] = (object) [
            'type'      => 'icon',
            'id'        => $user->user_id,
            'value'     => $user->deleted,
            'class'     => ( intval($user->deleted) !== 0 )
                                ? 'fas fa-trash-restore deleted'
                                : 'fas fa-trash deleted',
            'title'     => $this->_translate->_('DT.DELETE_UNDELETE_USER'),
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
    public function updateUser ( $params )
    {
        /**
         * Since both admins and users will be getting users via this method,
         * we don't want users to be able to just insert any user_id, so we
         * check to see if we have admin or user profile. The user will be
         * accessing this method from the "Account_Service_Account" class.
         */
        if ( $this->_reflection->getShortName() === 'Account_Service_Account' ) {
            $params['user_id'] = Zend_Auth::getInstance()->getIdentity()->user_id;
        }

        $this->_form = new Account_Form_User();

        /**
         * One of the first things to check for is the existence of unique fields
         * within the saveUser payload. Tiger will complain if we try to re-insert
         * or update the user record with the same email or username. This function
         * simply removes certain form validators. Note that this function only works
         * if passed a user_id as part of the params payload.
         */
        $this->_removeUniqueUserValidation( $params );

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
             * Since we're not really doing anything with the user being persisted
             * we don't need the $userRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $userRow = $this->_persistUser( $data, true );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            $user = (object) $userRow->toArray();
            $user->action = $this->_getUserActions( $user );

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $user;
            $this->_response->setTextMessage( 'MESSAGE.USER_SAVED', 'success' );

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
            Tiger_Log::error( $e->getMessage() );

        }

    }

    /**
     * Service "save" methods essentially are the gateway to persisting whole forms
     * of data. Save is responsible for validating and then forwarding clean data to
     * the "persist" method for any grooming which is then sent to the data model.
     *
     * @param $params mixed
     * @param $partial bool
     * @throws Zend_Form_Exception
     */
    public function saveUser ( $params )
    {
        $this->_form = new Account_Form_User();

        /**
         * Since both admins and users will be getting users via this method,
         * we don't want users to be able to just insert any user_id, so we
         * check to see if we have admin or user profile. The user will be
         * accessing this method from the "Account_Service_Account" class.
         */
        if ( $this->_reflection->getShortName() === 'Account_Service_Account' ) {
            $params['user_id'] = Zend_Auth::getInstance()->getIdentity()->user_id;
        }
        else {
            $this->_form->removeElement('current_password');
        }

        try {

            /**
             * One of the first things to check for is the existence of unique fields
             * within the saveUser payload. Tiger will complain if we try to re-insert
             * or update the user record with the same email or username. This function
             * simply removes certain form validators. Note that this function only works
             * if passed a user_id as part of the params payload.
             */
            $this->_removeUniqueUserValidation( $params );

            /** The password field isn't required and we remove all validation because admins
             * need to be able to set any kind of temp passwrod. */
            $this->_form->password->setRequired( false )->setValidators([]);

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

            /** Encrypt our password if it has been set ... */
            if ( ! empty( $data['password'] ) ) {
                $data['password'] = Tiger_Utility_Cryption::hash($data['password']);
            }
            /** Otherwise unset it so that it doesn't update the existing record. */
            else {
                unset( $data['password'] );
            }

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();

            /**
             * Since we're not really doing anything with the user being persisted
             * we don't need the $userRow, but we left it in just to let devs know
             * it's available. We can send the data back to the UI with new or updated
             * data.
             */
            $userRow = $this->_persistUser( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $userRow;
            $this->_response->setTextMessage( 'MESSAGE.USER_SAVED', 'success' );

        }
        catch ( Error | Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.SAVE_FAILED', 'alert' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getMessage() );

        }

    }

    /**
     * PersistUser is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the user table. If you
     * pass in a populated user_id, the persist will be treated as an update.
     *
     * @param array $data
     * @param bool $partial
     * @throws Exception
     * @return mixed
     */
    protected function _persistUser( array $data, $partial = false )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a user_id WITH a UUID, then we know this is an update. */
        if ( ! empty( $data['user_id'] ) ) {

            $userRow = $this->_userModel->getUserById( $data['user_id'] );

            if ( empty($userRow) ) {
                throw new Exception('ERROR.USER_NOT_FOUND');
            }

            if ( $partial === false ) {

                /**
                 * The setFromArray method assumes a fully populated array of params.
                 * If you leave something out, it will be saved as null.
                 */
                $userRow->setFromArray( $data );

            }
            else {

                unset( $data['user_id'] );  // Security precaution
                foreach( $data as $prop => $value ) {
                    $userRow->$prop = $value;
                }

            }

        }
        else {

            /** Create the row with our relevant data. */
            $userRow = $this->_userModel->createRow( $data );

            /**
             * Update the relevant pieces with new user system data. As a rule of thumb,
             * system data is added here while user added data is massaged in the update
             * or save methods.
             */
            $userRow->user_id   = Tiger_Utility_Uuid::v1();
            $userRow->create_ip = $_SERVER['REMOTE_ADDR'];
            $userRow->update_ip = $_SERVER['REMOTE_ADDR'];

        }

        /**
         * Now we can save the new user to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user. In our use case
         * we simply return the entire row object.
         */
        $userRow->saveRow();
        return $userRow;

    }

    protected function _removeUniqueUserValidation ( $params )
    {
        /** If the user_id is empty, this is an insert and we don't need to be here. */
        if ( empty( $params['user_id'] ) ) { return; }

        /** If the user_id is not a valid UUID, we're outta here. */
        if ( ! Tiger_Utility_Uuid::is_valid( $params['user_id'] ) ) { return; }

        $userRow = $this->_userModel->getUserById( $params['user_id'] );

        /** If there is no record for the user_id, then we're outta here as well. */
        if ( empty( $userRow ) ){ return; }

        /** If the username is the same as the user's existing record, removed the validator. */
        if ( ! empty( $params['username'] ) && $params['username'] === $userRow->username ) {
            $this->_form->getElement('username')->removeValidator('Db_NoRecordExists');
        }

        /** If the email is the same as the user's existing record, removed the validator. */
        if ( ! empty( $params['email'] ) && $params['email'] === $userRow->email ) {
            $this->_form->getElement('email')->removeValidator('Db_NoRecordExists');
        }

    }

}