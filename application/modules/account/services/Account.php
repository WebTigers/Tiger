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

class Account_Service_Account extends Core_Service_Webservice
{
    use Account_Service_OrgTrait;
    use Account_Service_AddressTrait;
    use Account_Service_ContactTrait;

    protected $_auth;
    protected $_acl;
    protected $_translate;
    protected $_utility;

    protected $_userModel;
    protected $_orgModel;
    protected $_contactModel;
    protected $_addressModel;
    protected $_orgUserModel;
    protected $_orgContactModel;
    protected $_orgAddressModel;
    protected $_userContactModel;
    protected $_userAddressModel;

    protected $_countryModel;

    const ROLE_NEWUSER = "newuser";
    const ROLE_USER = "user";
    const ROLE_NEWCLIENT = "newclient";
    const ROLE_CLIENT = "client";

    public function __construct( $input ) {

        $this->_auth        = Zend_Auth::getInstance();
        $this->_acl         = Zend_Registry::get('Zend_Acl');
        $this->_locale      = Zend_Registry::get('Zend_Locale');
        $this->_translate   = Zend_Registry::get('Zend_Translate');
        $this->_utility     = new Core_Service_Utility();

        $this->_userModel           = new Account_Model_User();
        $this->_orgModel            = new Account_Model_Org();
        $this->_addressModel        = new Account_Model_Address();
        $this->_contactModel        = new Account_Model_Contact();
        $this->_orgUserModel        = new Account_Model_OrgUser();
        $this->_orgAddressModel     = new Account_Model_OrgAddress();
        $this->_orgContactModel     = new Account_Model_OrgContact();
        $this->_userAddressModel    = new Account_Model_UserAddress();
        $this->_userContactModel    = new Account_Model_UserContact();

        $this->_countryModel        = new Core_Model_Country();

        parent::__construct( $input );

    }

    ### User Authentication Functions ###

    /**
     * The largest of our account methods, signup does a lot under the
     * hood in persisting a new user. Note that this method should not
     * be used to setup new users from within the admin panel.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function signup ( $params ) {

        $this->_form = new Account_Form_Signup();

        /**
         * Note that in Tiger, isValid() is subclassed to remove
         * any request routing params that are not part of the form. If
         * you wish to preserve the entire $params array, call the
         * $form->isValidPreserve() method instead.
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

        try {

            /**
             * Before saving any data, we wrap all of our saves in DB Transaction.
             * That way if anything fails, we can roll it all back. Very important!
             */
            Zend_Db_Table_Abstract::getDefaultAdapter()->beginTransaction();

            /**
             * To keep things clean, we divide up the data persistence by the various
             * tables and persist each one separately.
             */

            /** Encrypt our password if it has been set ... */
            if ( ! empty( $data['password'] ) ) {
                $data['password'] = Tiger_Utility_Cryption::hash($data['password']);
            }
            /** Otherwise unset it so that it doesn't update the existing record. */
            else {
                unset( $data['password'] );
            }

            $userRow = $this->persistUser( $data );
            $data['user_id'] = $userRow->user_id;

            /** Persist email contact in the contacts table for both the user. */

            $contactData = [
                'type_contact'  => 'EMAIL', // <-- from the type table
                'contact_value' => $data['email'],
                'primary'       => 1,
            ];
            $contactRow = $this->_persistContact( $contactData );

            $entityData['contact_id'] = $contactRow->contact_id;
            $entityData['entity'] = 'user';
            $entityData['entity_id'] = $userRow->user_id;
            $this->_persistEntityContact( $entityData, $userRow );

            /**
             * Only if we have a company_name should we attempt to persist the new org.
             * $orgRow should be set to the default org if there is no company_name at signup.
             */

            $orgRow = null;

            if ( ! empty( $data['company_name'] ) ) {

                $orgRow = $this->persistOrg( $data );
                $data['org_id'] = $orgRow->org_id;

                $this->persistOrgUser( $data );

                $entityData['contact_id'] = $contactRow->contact_id;    // <-- Yes, it's already been set, but left in for reference and consistency.
                $entityData['entity'] = 'org';
                $entityData['entity_id'] = $orgRow->org_id;
                $this->_persistEntityContact( $entityData, $contactRow );

            }
            else {

                $orgRow = $this->_orgModel->getOrgDefault();
                $data['org_id'] = $orgRow->org_id;

                $this->persistOrgUser( $data );

            }

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Now that we have a new user, we'll update their identity in the Auth module.
             */
            $identity = $this->_setIdentity( $userRow, $orgRow );

            /** Send the new user and admins various messages that a new user signed up. */
            Core_Service_Message::sendUserWelcomeEmail( $userRow );
            Core_Service_Message::sendUserVerifyEmail( $userRow );

            /**
             * Populate the responseObject with our success. There probably shouldn't
             * be a whole lot of messaging here, as you should just send the new user
             * to a signup success page with further instructions to verify their email.
             */
            $this->_response->result = 1;

        }
        catch ( Error | Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'ERROR.NEW_USER_FAILED' );

            /** We also log what happened ... */
            Tiger_Log::error( $e->getMessage() );

        }

    }

    /**
     * Resends the user a verify emil address email.
     *
     * @param $user_id UUID
     * @throws Zend_Validate_Exception
     */
    public function resend( $params )
    {

        if ( isset( $params['user_id'] ) && Zend_Validate::is( $params['user_id'], 'Uuid', [], ['Tiger_Validate'] ) ) {

            $userRow = $this->_userModel->getUserById( $params['user_id'] );

            if ( ! empty( $userRow ) ) {

                try {

                    Core_Service_Message::sendUserVerifyEmail( $userRow );

                }
                catch ( Exception $e ) {

                    $this->_response->result = 0;
                    $this->_response->setTextMessage( $e->getMessage(), 'error' );

                }

                $this->_response->result = 1;
                $this->_response->setTextMessage( 'SUCCESS.EMAIL_RESENT', 'success' );

            }
            else {

                $this->_response->result = 0;
                $this->_response->setTextMessage( 'ERROR.USER_NOT_FOUND', 'error' );

            }

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'ERROR.INVALID_ID', 'error' );

        }

    }

    /**
     * @param $params
     * @throws Zend_Validate_Exception
     */
    public function verify( $params )
    {

        if ( isset( $params['key'] ) && Zend_Validate::is( $params['key'], 'Uuid', [], ['Tiger_Validate'] ) ) {

            $userRow = $this->_userModel->getUserByEmailVerifyKey( $params['key'] );

            if ( ! empty( $userRow ) ) {

                /** If you allow multiple active orgs per user, this might not return the exact org you are looking for. $orgRow could be null. */
                $orgRow = $this->_orgUserModel->getOrgByUserId( $userRow->user_id  );

                try {

                    $userRow->role = self::ROLE_USER;
                    $userRow->email_verify_key = null;
                    $userRow->saveRow();    // <-- saveRow() adds boilerplate values.
                    $this->_setIdentity( $userRow, $orgRow );

                }
                catch ( Exception $e ) {

                    $this->_response->result = 0;
                    $this->_response->setTextMessage( 'ERROR.UNKNOWN', 'error' );
                    Tiger_Log::error( $e->getMessage() );

                }

                $this->_response->result = 1;
                $this->_response->setTextMessage( 'SUCCESS.EMAIL_VERIFIED', 'success' );

            }
            else {

                $this->_response->result = 0;
                $this->_response->setTextMessage( 'ERROR.USER_NOT_FOUND', 'error' );

            }

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'ERROR.INVALID_KEY', 'error' );

        }

    }

    /**
     * @param $params
     * @throws Zend_Auth_Adapter_Exception
     * @throws Zend_Auth_Storage_Exception
     * @throws Zend_Exception
     * @throws Zend_Form_Exception
     */
    public function login ( $params )
    {
        $this->_form = new Account_Form_Login();

        /**
         * First sanity check the login credentials. Note the generic failed message. We don't
         * want to give hackers clues about which part of the credentials might be bad.
         */
        if ( ! $this->_form->isValid( $params ) ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage('LOGIN.FAILED');
            return;

        }

        $data = $this->_form->getValues();

        $tigerAuth = new Tiger_Auth_DbAdapter( $data['username'], $data['password'], time() );

        $authResult = $tigerAuth->authenticate();   // <-- This is where the magic happens ...

        if ( $authResult->isValid() ) {

            $userRow = $tigerAuth->getUser();
            $orgRow  = $this->_orgUserModel->getOrgByUserId( $userRow->user_id );
            $this->_setIdentity( $userRow, $orgRow );

            if ( intval( $data['remember_me'] ) === 1 ) {
                setcookie( 'username', $userRow->username, time()+60*60*24*30,'/' ); // Expire in 30 days
            }
            else {
                setcookie( 'username', '', time()-60*60*24*30, '/' ); // Expired 30 days ago
            }

            // If we tried to get to a page but had to login first, remember where we were going ...
            if ( ! empty( Zend_Registry::get('Zend_Session')->aclRequest ) ) {
                $this->_response->redirect = Zend_Registry::get('Zend_Session')->aclRequest->getRequestUri();
            }

            $this->_response->result = 1;
            $this->_response->setTextMessage('LOGIN.SUCCESS');

        }
        else {

            $this->_response->result = 0;
            $this->_response->setTextMessage('LOGIN.FAILED');

        }

    }

    /**
     * @param $params
     */
    public function recover ( $params ) {

        $this->_form = new Account_Form_Login();

        if ( ! $this->_form->isValidPartial( $params ) ) {

            $this->_response->result = 1;
            $this->_response->setTextMessage( 'SUCCESS.EMAIL_SENT', 'success' );
            return;

        }

        $data = $this->_form->getValues();

        if ( isset( $data['username'] ) ) {

            $userRow = $this->_userModel->getUserByIdentity( $params['username'] );

            if ( ! empty( $userRow ) ) {

                try {

                    $userRow->password_reset_key = Tiger_Utility_Uuid::v1();
                    $userRow->update_ip = $_SERVER['REMOTE_ADDR'];

                    $userRow->saveRow();

                    Core_Service_Message::sendUserRecoverEmail( $userRow );

                    $this->_response->result = 1;
                    $this->_response->setTextMessage( 'SUCCESS.EMAIL_SENT', 'success' );
                    return;

                }
                catch ( Exception $e ) {

                    $this->_response->result = 0;
                    $this->_response->setTextMessage( 'ERROR.EMAIL_NOT_SENT', 'error' );
                    Tiger_Log::error( 'ERROR: Password Recover: ' . $e->getMessage() );
                    return;

                }

            }

        }

        /**
         * The default error condition is still happy-happy-joy-joy to the end user so that we don't
         * have bad actors attempting to use password reset as a way to learn user credentials.
         */

        $this->_response->result = 1;
        $this->_response->setTextMessage( 'SUCCESS.EMAIL_SENT', 'success' );

        $this->_logRecoverFailure( $data );

    }

    public function password ( $params ) {

        $this->_form = new Account_Form_Password();

        if ( ! $this->_form->isValid( $params ) ) {

            $this->_setFormErrors();
            return;

        }

        $data = $this->_form->getValues();

        if ( isset( $data['password'] ) ) {

            $userRow = $this->_userModel->getUserById( $this->_auth->getIdentity()->user_id );

            if ( ! empty( $userRow ) ) {

                try {

                    $userRow->password = Tiger_Utility_Cryption::hash( $data['password'] );
                    $userRow->password_reset_key = null;
                    $userRow->update_ip = $_SERVER['REMOTE_ADDR'];

                    $userRow->saveRow();

                    $this->_auth->getIdentity()->password_reset_key = '';
                    $this->_auth->getStorage()->write( $this->_auth->getIdentity() );

                    $this->_response->result = 1;
                    $this->_response->setTextMessage( 'SUCCESS.PASSWORD_RESET', 'success' );
                    return;

                }
                catch ( Exception $e ) {

                    $this->_response->result = 0;
                    $this->_response->setTextMessage( 'ERROR.INVALID', 'error' );
                    Tiger_Log::error( 'ERROR: Password Reset: ' . $e->getMessage() );
                    return;

                }

            }

        }

        $this->_response->result = 0;
        $this->_response->setTextMessage( 'ERROR.INVALID', 'error' );

    }

    private function _logRecoverFailure ( $data ) {

        Tiger_Log::db(
            'Password Recover Failed',
            json_encode([
                'identity' => $data['username'],
                'remote_ip' => $_SERVER['REMOTE_ADDR'],
            ]),
            Zend_Log::ALERT,
            null
        );

    }

    ### Profile Functions ###

    public function getUserProfile ( $params )
    {
        $user_id = Zend_Auth::getInstance()->getIdentity()->user_id;
        $userRow = $this->_userModel->getUserProfileById( $user_id );

        $this->_response->data = $userRow->toArray();
        $this->_response->result = 1;

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
    public function saveUser ( $params ) {

        try {

            $this->_form = new Account_Form_User();

            /** We don't validate the user role from profile updates. In fact, we remove it if it exists. */
            $this->_form->getElement('role')->setRequired(false);

            /**
             * One of the first things to check for is the existence of unique fields
             * within the saveUser payload. Tiger will complain if we try to re-insert
             * or update the user record with the same email or username. This function
             * simply removes certain form validators. Note that this function only works
             * if passed a user_id as part of the params payload.
             */
            $this->_removeUniqueUserValidation( $params );

            /** The password field isn't required. */
            $this->_form->password->setRequired(false);

            /** Is this just a password update? If so, then we have a current_password field. Remove other required fields. */
            if ( isset( $params['current_password'] ) ) {
                $this->_form->email->setRequired(false);
                $this->_form->username->setRequired(false);
            }
            else {
                $this->_form->current_password->setRequired(false);
            }

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
            $data = $this->_form->getValidValues(  $params );

            /** These are fields that cannot be updated by a user. */
            unset(
                $data['user_id'],
                $data['role'],
                $data['email_verify_key'],
                $data['referral_user_id'],
                $data['referral_org_id'],
                $data['type_hearabout'],
                $data['password_reset_key'],
                $data['active'],
                $data['deleted']
            );

            /** Make sure the user cannot pass in just any user_id but their own for updates. */
            $data['user_id'] = Zend_Auth::getInstance()->getIdentity()->user_id;

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
            $userRow = $this->persistUser( $data );
            $orgRow  = $this->_orgUserModel->getOrgByUserId( $userRow->user_id );
            $this->_setIdentity( $userRow, $orgRow );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->data = $userRow;
            $this->_response->setTextMessage( 'MESSAGE.PROFILE_SAVED', 'success' );

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

    ### Persist User Functions ###

    /**
     * PersistUser is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the user table. If you
     * pass in a user_id, the persist will be treated as an update. Note that this
     * method will throw an exception if you are trying to insert a record into the
     * database that should be unique, like email or username.
     *
     * @param $data
     * @throws Exception
     * @return mixed
     */
    public function persistUser( $data )
    {
        /** Persisting our clean data is easy with Zend DB Models. */

        /** If we have a user_id, then we know this is an update. */
        if ( isset($data['user_id']) ) {

            $userRow = $this->_userModel->getUserById( $data['user_id'] );

            if ( empty($userRow) ) {
                throw new Exception('ERROR.USER_NOT_FOUND');
            }

            /** We have a special case to handle if this is a password update. */
            if ( isset( $data['current_password'] ) && Tiger_Utility_Cryption::hash( $data['current_password'] ) !== $userRow->password ) {
                throw new Exception('ERROR.PASSWORDS_NOT_MATCH');
            }

            $userRow->setFromArray( $data );
            $userRow->update_ip = $_SERVER['REMOTE_ADDR'];

        }
        else {

            /** Create the row with our relevant data. */
            $userRow = $this->_userModel->createRow( $data );

            /** Update the relevant pieces with user data. */
            $userRow->user_id = GUEST_USER_ID;
            $userRow->role = self::ROLE_NEWUSER;
            $userRow->password = Tiger_Utility_Cryption::hash( $userRow->password );
            $userRow->email_verify_key = Tiger_Utility_Uuid::v1();
            $userRow->locale_preference = LOCALE;
            $userRow->create_ip = $_SERVER['REMOTE_ADDR'];
            $userRow->update_ip = $_SERVER['REMOTE_ADDR'];

            /**
             * The idea of the GUEST_USER_ID is an attempt to track a user at the very
             * first time they visit your site and then use that Id within your analytics.
             * But in the event this user_id is already in the DB, we need to make one final
             * check and then re-assign a new user_id if they are.
             */
            if ( $this->_userModel->getUserById( GUEST_USER_ID ) !== null ) {
                $userRow->user_id = Tiger_Utility_Uuid::v1();
            }

        }

        /**
         * Now we can save the new user to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user.
         */
        $userRow->saveRow();
        return $userRow;

    }

    /**
     * Sets the identity of a user using the user_id and org_id within an array. This function cannot
     * be called by the Tiger API since it is both protected and requires both $userRow and $orgRow data.
     *
     * @param $data
     * @throws Zend_Auth_Storage_Exception
     */
    protected function _setIdentity( $userRow, $orgRow )
    {
        $identityObject = new Account_Model_IdentityObject( $userRow, $orgRow );
        Zend_Auth::getInstance()->getStorage()->write( (object) $identityObject->toArray() );
    }

    ### Persist Org Functions ###

    /**
     * Like persistUser(), persistOrg is unconcerned with data validation and only
     * concerned with raw field data that needs to be inserted or updated within the
     * org table. If you pass in an org_id, the persist will be treated as an update.
     * Note that this method will throw an exception if you are trying to insert a
     * record into the database that should be unique, like orgname.
     *
     * @param $data
     * @throws Exception
     * @return mixed
     */
    public function persistOrg( $data )
    {
        /** If we have a org_id, then we know this is an update. */
        if ( isset($data['org_id']) ) {

            $orgRow = $this->_orgModel->getOrgById( $data['org_id'] );

            if ( empty($orgRow) ) {
                throw new Exception('ERROR.USER_NOT_FOUND');
            }

            $orgRow->setFromArray( $data );

        }
        else {

            /** Create the row with our relevant data. */
            $orgRow = $this->_orgModel->createRow( $data );

            /** Update the relevant pieces with user data. */
            $orgRow->org_id = Tiger_Utility_Uuid::v1();
            $orgRow->orgname = str_replace('-', '', $orgRow->org_id );
            $orgRow->type_org = 'COMPANY';
            $orgRow->primary = 1;
            $orgRow->create_ip = $_SERVER['REMOTE_ADDR'];
            $orgRow->update_ip = $_SERVER['REMOTE_ADDR'];

        }

        /**
         * Now we can save the new user to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user.
         */
        $orgRow->saveRow();
        return $orgRow;

    }

    /**
     * PersistOrgUser creates the link between the Org and the User that belongs to it.
     * Again, persistOrgUser is unconcerned with data validation and only concerned with
     * raw field data that needs to be inserted or updated within the org_user table.
     * If you pass in an org_user_id, the persist will be treated as an update.
     *
     * @param $data
     * @throws Exception
     * @return mixed
     */
    public function persistOrgUser( $data )
    {
        /** If we have a org_user_id, then we know this is an update. */
        if ( isset($data['org_user_id']) ) {

            $orgUserRow = $this->_orgUserModel->getOrgUserById( $data['org_user_id'] );

            if ( empty($orgUserRow) ) {
                throw new Exception('ERROR.ORGUSER_NOT_FOUND');
            }

            $orgUserRow->setFromArray( $data );

        }
        else {

            /** Create the row with our relevant data. */
            $orgUserRow = $this->_orgUserModel->createRow( $data );

            /** Update the relevant pieces with user data. In this case, we just need a new id. */
            $orgUserRow->org_user_id = Tiger_Utility_Uuid::v1();
            $orgUserRow->type_user_role = 'ADMIN';

        }

        /**
         * Now we can save the new orgUser record to the database! The function populates
         * our boilerplate fields as well as returns an org_user_id for new records if we
         * need it.
         */
        $orgUserRow->saveRow();
        return $orgUserRow;

    }

    ### Utility Functions ###

    public function getTypeSelect2List ( $params )
    {
        $this->_response = $this->_utility->getTypeSelect2List( $params );
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
