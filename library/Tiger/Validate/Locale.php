<?php

class Tiger_Validate_Locale extends Zend_Validate_Abstract
{
    const MSG_LOCALE_NOT_FOUND = "badLocale";
    
    protected $_translate;
    
    public    $dictionary;

    protected $_messageTemplates = array(
        self::MSG_LOCALE_NOT_FOUND => "Invalid locale."
    );
    
    public function __construct() {
        
        $this->_translate = Zend_Registry::get( 'Zend_Translate' );
        
    }

    /**
     * Accepts a UUID/GUID string to validate. 
     * 
     * @param string $value
     * @return boolean 
     */
    public function isValid( $value, $context = null ) {

        // pr( array( $value, $context ) );
        
        $this->_setValue( $value );
        $isValid = true;
        
        
        if ( !in_array($value, $this->_translate->getList() ) ) {

            $this->_error( self::MSG_LOCALE_NOT_FOUND );
            $isValid = false;

        }

        return $isValid;

    }

}
