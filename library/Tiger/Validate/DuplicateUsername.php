<?php

class Tiger_Validate_DuplicateUsername extends Zend_Validate_Abstract {
    
    const MSG_DUPLICATE_USERNAME = "duplicateUsername";
    
    protected $_translate;
    protected $_user_id;
    protected $_userModel;
    protected $_messageTemplates;
    
    public function __construct() {
        
        $this->_translate           =   Zend_Registry::get( 'Zend_Translate' ); 
        $this->_user_id             =   Zend_Auth::getInstance()->getIdentity()->user_id;
        $this->_userModel           =   new Application_Model_User;
        $this->_messageTemplates    =   array( self::MSG_DUPLICATE_USERNAME => 
                                            $this->_translate->_( 'validate.duplicateUsername.duplicateUsername' ) );
        
    }

    /**
     * Accepts a UUID/GUID string to validate. 
     * 
     * @param string $value
     * @return boolean 
     */
    public function isValid( $value, $context = null ) {

        $this->_setValue( $value );
        $isValid = true;
        
        if ( ! empty( $value ) && $this->_userModel->isDuplicateUsername( $this->_user_id, $value ) ) {

              $this->_error( self::MSG_DUPLICATE_USERNAME );
              $isValid = false;

        }

        return $isValid;

    }

}
