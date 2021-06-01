<?php

class Cms_Service_Admin extends Core_Service_Webservice
{
    use Cms_Service_PageTrait;

    protected $_auth;
    protected $_acl;
    protected $_translate;
    protected $_utility;
    protected $_searchErrors;

    protected $_pageModel;

    public function __construct( $input ) {

        $this->_auth        = Zend_Auth::getInstance();
        $this->_acl         = Zend_Registry::get('Zend_Acl');
        $this->_translate   = Zend_Registry::get('Zend_Translate');
        $this->_utility     = new Core_Service_Utility();

        $this->_pageModel   = new Cms_Model_Page;

        parent::__construct( $input );

    }

}
