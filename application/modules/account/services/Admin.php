<?php

/**
 * 
 */
class Account_Service_Admin
{

    /** Within Tiger, traits are more used for code organization. */

    use Account_Service_OrgTrait;
    use Account_Service_UserTrait;
    use Account_Service_AddressTrait;
    use Account_Service_ContactTrait;

    protected $_auth;
    protected $_acl;
    protected $_locale;
    protected $_translate;
    protected $_config;
    protected $_response;
    protected $_request;
    protected $_form;
    protected $_reflection;

    protected $_userModel;
    protected $_orgModel;
    protected $_contactModel;
    protected $_addressModel;
    protected $_orgUserModel;
    protected $_orgContactModel;
    protected $_orgAddressModel;
    protected $_userContactModel;
    protected $_userAddressModel;

    protected $_typeModel;
    protected $_roleModel;

    public function __construct( $input ) {

        $this->_auth        = Zend_Auth::getInstance();
        $this->_acl         = Zend_Registry::get('Zend_Acl');
        $this->_locale      = Zend_Registry::get('Zend_Locale');
        $this->_translate   = Zend_Registry::get('Zend_Translate');
        $this->_config      = Zend_Registry::get('Zend_Config');
        $this->_response    = new Core_Model_ResponseObject();

        $this->_userModel           = new Account_Model_User();
        $this->_orgModel            = new Account_Model_Org();
        $this->_addressModel        = new Account_Model_Address();
        $this->_contactModel        = new Account_Model_Contact();
        $this->_orgUserModel        = new Account_Model_OrgUser();
        $this->_orgAddressModel     = new Account_Model_OrgAddress();
        $this->_orgContactModel     = new Account_Model_OrgContact();
        $this->_userAddressModel    = new Account_Model_UserAddress();
        $this->_userContactModel    = new Account_Model_UserContact();

        $this->_typeModel           = new Core_Model_Type();
        $this->_roleModel           = new Acl_Model_AclRoles();

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

    ### Validation Methods ###

    protected function _validateDataTables ( Array $post ) {

        // pr($post);

        $regexValidator = new Zend_Validate_Regex( array('pattern' => '/^[A-Za-z0-9 \'\.\_\-,]+$/') );
        $intValidator   = new Zend_Validate_Int();

        $out = array();

        if ( ! empty($post['search']) && ! $regexValidator->isValid( $post['search'] ) ) {
            foreach ( $regexValidator->getMessages() as $messageId => $message ) {
                $out[$messageId] = $message;
            }
        }

        if ( ! $intValidator->isValid( $post['start'] ) ) {
            foreach ($intValidator->getMessages() as $messageId => $message) {
                $out[$messageId] = $message;
            }
        }

        if ( ! $intValidator->isValid( $post['length'] ) ) {
            foreach ($intValidator->getMessages() as $messageId => $message) {
                $out[$messageId] = $message;
            }
        }

        return ( empty($out) ) ? true : $this->_searchErrors = $out;

    }

    ### Protected Admin Service Functions ###

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

    ### Public Account Service Functions ###

    public function getTypeSelect2List ( $params )
    {
        $results = [];
        $typeRowset = $this->_typeModel->getTypeListByReference( $params['reference'], $params['key'] );

        foreach ( $typeRowset as $typeRow ) {
            $results[] = (object) ['id' => $typeRow->key, 'text' => $typeRow->type_name ];
        }

        $this->_response = new Core_Model_ResponseObjectSelect2([
            'results' => $results,
            'pagination' => (object) ['more' => false ],
            'error' => null,
            'login' => false,
        ]);


    }

}
