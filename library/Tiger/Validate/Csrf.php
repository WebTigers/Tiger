<?php

class Tiger_Validate_Csrf extends Zend_Validate_Abstract
{
    const MSG_INVALID_TOKEN      = "invalidToken";
    const MSG_EMPTY_TOKEN        = "emptyToken";
    const MSG_EXPIRED_TOKEN      = "expiredToken";
    const MSG_MISMATCHED_TOKENS  = "mismatchedTokens";

    public $allowEmpty          = false;

    protected $_messageVariables = array(
        'allowEmpty'            => 'allowEmpty',
    );
    
    protected $_messageTemplates = array(
        self::MSG_INVALID_TOKEN     => "Security token is invalid.",
        self::MSG_EMPTY_TOKEN       => "Missing security token.",
        self::MSG_EXPIRED_TOKEN     => "Security token has expired.",
        self::MSG_MISMATCHED_TOKENS => "Security tokens do not match.",
    );
    
    public function __construct( $options = array() ) {
        
        $this->allowEmpty = ( is_array($options) && isset( $options['allowEmpty'] ) ) 
                ? $options['allowEmpty']
                : false;
        
    }

        /**
     * Accepts a UUID/GUID string to validate. 
     * 
     * @param string $value
     * @return boolean 
     */
    public function isValid( $value = null, $context = null ) {

        // zd( array( $value, $context, $this->allowEmpty ) );
        
        $this->_setValue( $value );
        $sessionToken = Zend_Registry::get('session')->get('csrfToken');

        if ( $this->allowEmpty === false && empty( $value ) ) {
            $this->_error( self::MSG_EMPTY_TOKEN );
            return false;
        }

        if ( ! empty( $value ) && ! Tiger_Utility_Uuid::is_valid( $value ) ) {
            $this->_error( self::MSG_INVALID_TOKEN );
            return false;
        }

        /** Csrf tokens expire after X seconds. Default is 3600 seconds (1 hour). */
        if ( ! empty( $value ) && ( Tiger_Utility_Uuid::time( $value ) + Zend_Registry::get('Config')->CSRF_EXPIRE_SECONDS ) >= time() ) {
            $this->_error( self::MSG_EXPIRED_TOKEN );
            return false;
        }

        if ( ! empty( $value ) && !  $value !== $sessionToken ) {
            $this->_error( self::MSG_MISMATCHED_TOKENS );
            return false;
        }

        return true;

    }

}
