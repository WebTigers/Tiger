<?php

class Tiger_Validate_Uuid extends Zend_Validate_Abstract
{
    const MSG_INVALID_UUID      = "invalidUuid";
    const MSG_EMPTY_UUID        = "emptyUuid";

    public $allowEmpty          = false;

    protected $_messageVariables = array(
        'allowEmpty'            => 'allowEmpty',
    );
    
    protected $_messageTemplates = array(
        self::MSG_INVALID_UUID  => "Id is not a valid ID.",
        self::MSG_EMPTY_UUID    => "Value cannot be blank.",
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
        $isValid = true;

        if ( $this->allowEmpty === false && empty( $value ) ) {
            $this->_error( self::MSG_EMPTY_UUID );
            $isValid = false;
        }

        if ( ! empty( $value ) && ! Tiger_Utility_Uuid::is_valid( $value ) ) {
            $this->_error( self::MSG_INVALID_UUID );
            $isValid = false;
        }

        return $isValid;

    }

}
