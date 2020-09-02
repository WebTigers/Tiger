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


    ### Common Class Functions ###
    
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


    ### Public Functions ###

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
             * the responseObject ans we're done here.
             */
            $this->_setFormErrors();
            return;

        }

        /** Gets the filtered and validated values from the form. We've got clean data. */
        $data = $this->_form->getValues();

        /** Naw persisting our clean data is easy with Zend DB Models. */
        $userModel = new User_Model_User();

        /**
         * This convenience method creates a new row with all of our boilerplate
         * data already added, like create_date, create_user, etc.
         */
        $userRow = $userModel->createNewRow( $data );

        /** Update the relevant pieces with system data. */
        $userRow->user_id = GUEST_USER_ID;
        $userRow->role = self::ROLE_NEWUSER;
        $userRow->password = Tiger_Utility_Cryption::hash( $userRow->password );
        $userRow->email_verify_key = Tiger_Utility_Uuid::v1();
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

        /**
         * Before saving any data, we wrap all of our saves in DB Transaction.
         * That way if anything fails, we can roll it all back. Very important!
         */
        $db_adapter = Zend_Db_Table_Abstract::getDefaultAdapter();
        $db_adapter->beginTransaction();

        try {

            /** Now we can save the new user to the database! */
            $userRow->save();

            /** Commit the DB transaction. All done! */
            $db_adapter->commit();

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

            /** Uh oh, something went wrong, rollback any database activity! */
            $db_adapter->rollBack();

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

}
