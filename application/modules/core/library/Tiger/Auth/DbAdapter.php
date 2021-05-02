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

class Tiger_Auth_DbAdapter implements Zend_Auth_Adapter_Interface {

    protected $_identity;
    protected $_credential;
    protected $_timestamp;
    protected $_userModel;
    protected $_config;
    protected $_dbRow = null;

    public function __construct( $identity = null, $credential = null, $timestamp = null ) {
        
        if ( ! empty( $identity   ) ) { $this->_identity   = $identity; }
        if ( ! empty( $credential ) ) { $this->_credential = $credential; }
        if ( ! empty( $timestamp  ) ) { $this->_timestamp  = $timestamp; }

        $this->_config      = Zend_Registry::get('Zend_Config');
        $this->_userModel   = new Account_Model_User;

    }

    # Some convenience setters #
    
    # An identity could be either a username, email, or user_id
    public function setIdentity ( $identity ) { 
        $this->_identity = $identity;
        return $this;
    }
    
    # A credential could be a password or sha1 hash
    public function setCredential ( $credential ) { 
        $this->_credential = $credential;
        return $this;
    }
    
    public function setTimestamp ( $timestamp ) {
        $this->_timestamp = $timestamp;
        return $this;
    }
    
    public function getUser ( ) {
        return $this->_dbRow;
    }
    
    public function setUser ( Zend_Db_Table_Row $userRow ) {
        $this->_dbRow = $userRow;
    }
    
    /**
     * Performs an authentication attempt
     *
     * @throws Zend_Auth_Adapter_Exception If authentication cannot be performed
     * @return Zend_Auth_Result
     */
    public function authenticate() {
        
        try {

            $user = $this->_dbRow;
            
            /** First let's check if we are passing in a valid UserRow */

            if ( $user instanceof Zend_Db_Table_Row || ( ! empty( $this->_identity ) && ! empty( $this->_credential ) ) ) {

                if ( ! empty( $this->_identity ) && ! empty( $this->_credential ) ) {
                    $user = $this->_userModel->getUserByIdentity( $this->_identity );
                }

                if ( $user instanceof Zend_Db_Table_Row ) {

                    /** Authenticate if user is using a password. */
                    if ( ! empty( $this->_credential ) && Tiger_Utility_Cryption::hash( $this->_credential ) === $user->password ) {

                        /** We log the user's last access within their account. */
                        $user->password_reset_key = null;
                        $this->_authenticateUser( $user );

                    }
                    /** Authenticate if user is using a password reset key. */
                    elseif ( ! empty( $user->password_reset_key ) && $this->_credential === $user->password_reset_key ) {

                        /** A password reset key has a limited lifespan. If we are outside of that lifespan, we don't authenticate. */
                        $lifetime = Zend_Registry::get('Zend_Config')->password->resetKeyLifetime;
                        $created  = Tiger_Utility_Uuid::time( $user->password_reset_key );

                        if ( ( $this->_timestamp - $created ) < $lifetime ) {

                            /** We log the user's last access within their account. */
                            $this->_authenticateUser( $user );

                        }
                        else {

                            /** Toast the user row if the password reset key is too old. */
                            $user = null;

                        }

                    }
                    else {

                        /** Toast the user row if the password fails to authenticate. */
                        $user = null;

                        $this->_logFailure();

                    }

                }
                else {

                    $this->_logFailure();

                }

            }
            else {

                $this->_logFailure();

            }
            
            /** By now we should have a valid user. If not, we were passed bad data. */

            if ( $user instanceof Zend_Db_Table_Row ) {
                
                $this->_dbRow = $user;
                return new Zend_Auth_Result( Zend_Auth_Result::SUCCESS, $user->username );
                
            } else {
                
                $this->_dbRow = null;
                return new Zend_Auth_Result( Zend_Auth_Result::FAILURE, 'guest' );
                
            }
            
        }
        catch ( Error | Exception $e ) {

            Tiger_Log::error( 'ERROR AUTHENTICATE: ' . $e->getMessage() );

        }

    }

    private function _logFailure ( ) {

        Tiger_Log::db(
            'Authentication Failed',
            json_encode([
                'identity' => $this->_identity,
                'credential' => $this->_credential,
                'remote_ip' => $_SERVER['REMOTE_ADDR'],
            ]),
            Zend_Log::ALERT,
            null
        );

    }

    private function _authenticateUser ( $user ) {

        $now = new DateTime();
        $timestamp = $now->format('Y-m-d H:i:s');

        $user->last_login_date = $timestamp;
        $user->last_login_ip = $_SERVER['REMOTE_ADDR'];

        $user->saveRow();

        $this->_dbRow = $user;

    }

    /**
     * A convenience method for returning certain pieces of data from the dbRow
     * Just pass in an array of the columns (keys) you want populated and the function
     * returns those key with values from the row. SWEET!
     * 
     * @param type $params
     * @return array
     */
    public function getResultRow( $params = array() ) {

        if (is_null($this->_dbRow)) {
            return null;
        }

        $user = $this->_dbRow->toArray();

        $out = array();
        if (!empty($params)) {
            foreach ($params as $param) {
                if (array_key_exists($param, $user)) {
                    $out[$param] = $user[$param];
                }
            }
            $out = (object) $out;
        } else {
            $out = $user;
        }

        return $out;
    }

}
