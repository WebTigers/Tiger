<?php

/**
 * 
 */
class User_Service_Account
{
    protected $_auth;
    protected $_acl;
    protected $_locale;
    protected $_translate;
    protected $_config;
    protected $_response;
    protected $_request;
    protected $_form;
    protected $_reflection;

    const ROLE_NEWUSER = "newuser";
    const ROLE_USER = "user";
    const ROLE_NEWCLIENT = "newclient";
    const ROLE_CLIENT = "client";

    public function __construct( $input ) {

        $this->_auth        = Zend_Auth::getInstance();
        $this->_acl         = Zend_Registry::get('Zend_Acl');
        $this->_locale      = Zend_Registry::get('Zend_Locale');
        $this->_translate   = Zend_Registry::get('Zend_Translate');
        $this->_config      = Zend_Registry::get('Zend_Config');
        $this->_response    = new Core_Model_ResponseObject();

        if ( $input instanceof Zend_Controller_Request_Http ) {
            $this->_request = $input;
            $params = $this->_request->getParams();
        } 
        elseif ( is_array($input) ) {
            $params = $input;
        }
        
        if ( ! isset( $this->_reflection ) ) {
            $this->_reflection = new ReflectionClass( $this );
        }

        if ( isset( $params['form'] ) && class_exists( $params['form'], true ) ) {
            $this->_form = new $params['form'];
        }
        
        $this->_dispatch( $params );
        
    }


    ### Boilerplate Internal Class Functions ###
    
    /**
     * If this service is called via the API, the dispatch
     * method will route the $params to the proper function.
     * @param type $params
     */
    private function _dispatch ( $params ) {

        try {
            
            if ( isset( $params['method'] ) ) {

                // filter the method to just camelCase alphaNumeric for security
                $method = Zend_Filter::filterStatic( $params['method'], 
                        'PregReplace', array('match' => '/[^A-Za-z0-9]/', 'replace' => '') );

                // make sure the method exists and that it's public
                if ( method_exists( $this, $method ) &&
                        $this->_reflection->getMethod( $method )->isPublic() ) {
                            $this->{$method}( $params );
                }
            }
        }
        
        catch ( Exception $e ) {

            // @TODO Need to log this

        }
        
    }

    /**
     * Gets the Core ResponseObject
     * @return object of ResponseObject
     */
    public function getResponse() {
        return $this->_response;
    }

    /**
     * Convenience function used to set form errors. Call the function
     * without passing in a form to use the set form for the service,
     * or pass in a different form to set the responseObject from it.
     * @param null $frm
     */
    protected function _setFormErrors ( $frm = null ) {

        $form = ( ! is_null( $frm ) ) ? $frm : $this->_form;

        $this->_response->result    = 0;
        $this->_response->form = $form->getName();
        $this->_response->messages  = $form->getMessages();

    }


    ### Public Account Service Functions ###

    /**
     * The largest of our account methods, signup does a lot under the
     * hood in persisting a new user. Note that this method should not
     * be used to setup new users from within the admin panel.
     *
     * @param $params
     * @throws Zend_Form_Exception
     */
    public function signup ( $params ) {

        $this->_form = new User_Form_Signup();

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

            $data['user_id']    = $this->persistUser( $data );
            $data['org_id']     = $this->persistOrg( $data );

            $this->persistOrgUser( $data );

            /** Persist email contact in the contacts table for both the user and org. */
            
            $contactData = [
                'type_contact'  => 'EMAIL', // <-- from the type table
                'contact_value' => $data['email'],
                'primary'       => 1,
            ];
            $data['contact_id'] = $this->persistContact( $contactData );

            $this->persistUserContact( $data );
            $this->persistOrgContact( $data );

            /** Commit the DB transaction. All done! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->commit();

            // All of these messages should probably triggered by an event.
            /** Send the new user and admins various messages that a new user signed up. */
            // Core_Service_Mail::sendUserWelcome( $userRow );
            // Core_Service_Mail::sendUserVerifyEmail( $userRow );
            // Core_Service_Mail::sendAdminWelcome( $userRow );
            // Core_Service_Text::sendAdminText( $userRow );
            // Core_Service_Note::alertAdminNewUser( $userRow );

            /**
             * Populate the responseObject with our success. There probably shouldn't
             * be a whole lot of messaging here, as you should just send the new user
             * to a signup success page with further instructions.
             */

            $this->_response->result = 1;
            $this->_response->setTextMessage( 'MESSAGE.NEWUSER_SUCCESS' );

        }
        catch ( Exception $e ) {

            /** Uh oh, something went wrong, rollback all database activity! */
            Zend_Db_Table_Abstract::getDefaultAdapter()->rollBack();

            /**
             * Populate the responseObject with the bad news.
             */

            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.NEWUSER_FAILED' );

            pr( $e->getMessage() );

            /** We also log what happened ... */
            // Tiger_Log::logger( $e->getMessage() );

        }

    }

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
        $userModel = new User_Model_User();

        /** If we have a user_id, then we know this is an update. */
        if ( isset($data['user_id']) ) {

            $userRow = $userModel->getUserById( $data['user_id'] );

            if ( empty($userRow) ) {
                throw new Exception('ERROR.USER_NOT_FOUND');
            }

            /** We need a little data massaging before inserting into the database. */
            if ( isset( $data['password']) ) {
                $data['password'] = Tiger_Utility_Cryption::hash( $data['password'] );
            }

            $userRow->setFromArray( $data );

        }
        else {

            /** Create the row with our relevant data. */
            $userRow = $userModel->createRow( $data );

            /** Update the relevant pieces with user data. */
            $userRow->user_id = GUEST_USER_ID;
            $userRow->role = self::ROLE_NEWUSER;
            $userRow->password = Tiger_Utility_Cryption::hash( $userRow->password );
            $userRow->email_verify_key = Tiger_Utility_Uuid::v1();
            $userRow->locale_preference = LOCALE;
            $userRow->create_ip = $_SERVER['REMOTE_ADDR'];

            /**
             * The idea of the GUEST_USER_ID is an attempt to track a user at the very
             * first time they visit your site and then use that Id within your analytics.
             * But in the event this user_id is already in the DB, we need to make one final
             * check and then re-assign a new user_id if they are.
             */
            if ( $userModel->getUserById( GUEST_USER_ID ) !== null ) {
                $userRow->user_id = Tiger_Utility_Uuid::v1();
            }

        }

        /**
         * Now we can save the new user to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user.
         */
        return $userRow->saveRow();

    }

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
        /** Persisting our clean data is easy with Zend DB Models. */
        $orgModel = new User_Model_Org();

        /** If we have a user_id, then we know this is an update. */
        if ( isset($data['org_id']) ) {

            $orgRow = $orgModel->getOrgById( $data['org_id'] );

            if ( empty($orgRow) ) {
                throw new Exception('ERROR.USER_NOT_FOUND');
            }

            $orgRow->setFromArray( $data );

        }
        else {

            /** Create the row with our relevant data. */
            $orgRow = $orgModel->createRow( $data );

            /** Update the relevant pieces with user data. */
            $orgRow->org_id = Tiger_Utility_Uuid::v1();;

        }

        /**
         * Now we can save the new user to the database! The function not only populates
         * our boilerplate fields, but returns the primary key of the record so it can
         * be used in populating other tables with data linked to this user.
         */
        return $orgRow->saveRow();

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
        /** Persisting our clean data is easy with Zend DB Models. */
        $orgUserModel = new User_Model_OrgUser();

        /** If we have a org_user_id, then we know this is an update. */
        if ( isset($data['org_user_id']) ) {

            $orgUserRow = $orgUserModel->getOrgUserById( $data['org_user_id'] );

            if ( empty($orgUserRow) ) {
                throw new Exception('ERROR.ORGUSER_NOT_FOUND');
            }

            $orgUserRow->setFromArray( $data );

        }
        else {

            /** Create the row with our relevant data. */
            $orgUserRow = $orgUserModel->createRow( $data );

            /** Update the relevant pieces with user data. In this case, we just need a new id. */
            $orgUserRow->org_user_id = Tiger_Utility_Uuid::v1();;

        }

        /**
         * Now we can save the new orgUser record to the database! The function populates
         * our boilerplate fields as well as returns an org_user_id for new records if we
         * need it.
         */
        return $orgUserRow->saveRow();

    }

    /**
     * PersistContact is unconcerned with data validation and only concerned with raw
     * field data that needs to be inserted or updated within the contact table. If you
     * pass in a contact_id, the persist will be treated as an update. Note that you should
     * manually set the type_contact.
     *
     * @param $data
     * @throws Exception
     * @return mixed
     */
    public function persistContact( $data )
    {
        /** Persisting our clean data is easy with Zend DB Models. */
        $contactModel = new User_Model_Contact();

        /** If we have a org_user_id, then we know this is an update. */
        if ( isset($data['contact_id']) ) {

            $contactRow = $contactModel->getContactById( $data['contact_id'] );

            if ( empty($contactRow) ) {
                throw new Exception('ERROR.CONTACT_NOT_FOUND');
            }

            $contactRow->setFromArray( $data );

        }
        else {

            /** Create the row with our relevant data. */
            $contactRow = $contactModel->createRow( $data );

            /** Update the relevant pieces with user data. In this case, we just need a new id. */
            $contactRow->contact_id = Tiger_Utility_Uuid::v1();;

        }

        /**
         * Now we can save the new orgUser record to the database! The function populates
         * our boilerplate fields as well as returns an org_user_id for new records if we
         * need it.
         */
        return $contactRow->saveRow();

    }

    /**
     * PersistOrgContact creates the link between the Org and the Contact that belongs to it.
     * Again, persistOrgContact is unconcerned with data validation and only concerned with
     * raw field data that needs to be inserted or updated within the org_contact table.
     * If you pass in an org_contact_id, the persist will be treated as an update.
     *
     * @param $data
     * @throws Exception
     * @return mixed
     */
    public function persistOrgContact( $data )
    {
        /** Persisting our clean data is easy with Zend DB Models. */
        $orgContactModel = new User_Model_OrgContact();

        /** If we have a org_contact_id, then we know this is an update. */
        if ( isset($data['org_contact_id']) ) {

            $orgContactRow = $orgContactModel->getOrgContactById( $data['org_contact_id'] );

            if ( empty($orgContactRow) ) {
                throw new Exception('ERROR.ORGCONTACT_NOT_FOUND');
            }

            /** We should already have all of the pertinent data we need to hydrate the object. */
            $orgContactRow->setFromArray( $data );

        }
        else {

            /** Create the row with our relevant data. */
            $orgContactRow = $orgContactModel->createRow( $data );

            /** Update the relevant pieces with user data. In this case, we just need a new id. */
            $orgContactRow->org_contact_id = Tiger_Utility_Uuid::v1();;

        }

        /**
         * Now we can save the new orgUser record to the database! The function populates
         * our boilerplate fields as well as returns an org_user_id for new records if we
         * need it.
         */
        return $orgContactRow->saveRow();

    }

    /**
     * PersistUserContact creates the link between the User and the Contact that belongs to it.
     * Again, persistUserContact is unconcerned with data validation and only concerned with
     * raw field data that needs to be inserted or updated within the org_contact table.
     * If you pass in an user_contact_id, the persist will be treated as an update.
     *
     * @param $data
     * @throws Exception
     * @return mixed
     */
    public function persistUserContact( $data )
    {
        /** Persisting our clean data is easy with Zend DB Models. */
        $userContactModel = new User_Model_UserContact();

        /** If we have a user_contact_id, then we know this is an update. */
        if ( isset($data['user_contact_id']) ) {

            $userContactRow = $userContactModel->getUserContactById( $data['user_contact_id'] );

            if ( empty($userContactRow) ) {
                throw new Exception('ERROR.USERCONTACT_NOT_FOUND');
            }

            /** We should already have all of the pertinent data we need to hydrate the object. */
            $userContactRow->setFromArray( $data );

        }
        else {

            /** Create the row with our relevant data. */
            $userContactRow = $userContactModel->createRow( $data );

            /** Update the relevant pieces with user data. In this case, we just need a new id. */
            $userContactRow->user_contact_id = Tiger_Utility_Uuid::v1();

        }

        /**
         * Now we can save the new userUser record to the database! The function populates
         * our boilerplate fields as well as returns an user_user_id for new records if we
         * need it.
         */
        return $userContactRow->saveRow();

    }

}
