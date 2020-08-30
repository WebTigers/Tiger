<?php

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
        $this->_userModel   = new User_Model_User;

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
            
            // First let's check if we are passing in a valid UUID, if so this will be
            // considered an AutoAuth call and authenticated accordingly.
            
            if ( ! $user instanceof Zend_Db_Table_Row && ! Tiger_Utility_Uuid::is_valid( $this->_identity ) ) {
            
                // Standard Login //
                
                if ( ! empty( $this->_identity ) && ! empty( $this->_credential ) ) {

                    $user = $this->_userModel->getUserByIdentity( $this->_identity );

                    if ( ! is_null( $user ) ) {

                        // Password hashes must match to authenticate.

                        if ( $this->_cryption->hash( $this->_credential ) === $user->password ) {

                            // Since this is a normal login, we log the user's last 
                            // access within their account.

                            $now = new DateTime();
                            $timestamp = $now->format('Y-m-d H:i:s');
                            $user->last_login_date = $timestamp;
                            $user->last_login_ip = $_SERVER['REMOTE_ADDR'];
                            $user->save();

                        } else {

                            // Toast the user row if the password fails to 
                            // authenticate.

                            $user = null;

                        }
                        
                    }

                }
                
            }
            
            // By now we should have a valid user. If not, we were passed bogus data.

            if ( $user instanceof Zend_Db_Table_Row ) {
                
                $this->_dbRow = $user;
                return new Zend_Auth_Result( Zend_Auth_Result::SUCCESS, $user->username );
                
            } else {
                
                $this->_dbRow = null;
                return new Zend_Auth_Result( Zend_Auth_Result::FAILURE, 'guest' );
                
            }
            
        }
        catch ( Exception $e ) {
            
            throw new Zend_Auth_Adapter_Exception();
            
        }
        
    }
    
    /**
     * A convenience method for returning certain pieces of data from the dbRow
     * Just pass in an array of the columns (keys) you want populated and the function
     * returns those key with values from the row. SWEET!
     * 
     * @param type $params
     * @return null
     */
    public function getResultRowObject($params = array()) {

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
