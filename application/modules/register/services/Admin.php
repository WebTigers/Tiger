<?php

class Register_Service_Admin extends Core_Service_Webservice
{
    use Register_Service_RegisterTrait;

    protected $_registerModel;
    protected $_utility;
    protected $_translate;

    public function __construct( $input ) {

        $this->_registerModel   = new Register_Model_Register;
        $this->_utility         = new Core_Service_Utility();
        $this->_translate       = Zend_Registry::get('Zend_Translate');

        parent::__construct( $input );

    }

}
