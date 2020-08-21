<?php

class Tiger_Validate_MaxContacts extends Zend_Validate_Abstract {
    
    const MAX_ORG_CONTACTS  = "maxOrgContacts";
    const MAX_USER_CONTACTS = "maxUserContacts";
    
    protected $_org_id;
    protected $_user_id;
    protected $_contactModel;
    
    public $maxOrgContacts;
    public $maxUserContacts;

    protected $_messageVariables = array(
        'maxOrgContacts'    => 'maxOrgContacts',
        'maxUserContacts'   => 'maxUserContacts',
    );
    
    protected $_messageTemplates = array(
        self::MAX_ORG_CONTACTS  => "Maximum of '%maxOrgContacts%' contacts allowed.",
        self::MAX_USER_CONTACTS => "Maximum of '%maxUserContacts%' contacts allowed.",
    );
    
    public function __construct() {
        
        $this->_org_id          = Zend_Auth::getInstance()->getIdentity()->org_id;
        $this->_user_id         = Zend_Auth::getInstance()->getIdentity()->user_id;
        $this->_contactModel    = new Application_Model_Contact;
        
        $this->maxOrgContacts   = Zend_Registry::get( 'Zend_Config' )->profile->org->maxContacts;
        $this->maxUserContacts  = Zend_Registry::get( 'Zend_Config' )->profile->user->maxContacts;
                
    }

    /**
     * 
     * @param type $value
     * @param string $context 'user' | 'org' 
     * @return boolean
     */
    public function isValid( $value, $context = null ) {

        $this->_setValue( $value );
        $isValid = true;
        
        if ( ! empty( $value ) ) {
            
            if ( $context['context'] === 'org' ) {
                
                $result = $this->_contactModel->getContactsByOrgId( $this->_org_id );
                
                if ( count( $result ) > $this->maxOrgContacts ) {
                    $this->_error( self::MAX_ORG_CONTACTS );
                    $isValid = false;
                }
                
            }
            
            if ( $context['context'] === 'user' ) {
                
                $result = $this->_contactModel->getContactsByUserId( $this->_user_id );

                if ( count( $result ) > $this->maxUserContacts ) {
                    $this->_error( self::MAX_USER_CONTACTS );
                    $isValid = false;
                }
                
            }
            
        }
        
        return $isValid;

    }

}
