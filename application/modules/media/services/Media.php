<?php

class Media_Service_Media extends Core_Service_Webservice
{
    use Media_Service_MediaTrait;

    const MIME_IMAGE = "image";

    protected $_auth;
    protected $_acl;
    protected $_translate;
    protected $_utility;
    protected $_searchErrors;

    protected $_configModel;
    protected $_mediaModel;

    public function __construct( $input ) {

        $this->_auth        = Zend_Auth::getInstance();
        $this->_acl         = Zend_Registry::get('Zend_Acl');
        $this->_locale      = Zend_Registry::get('Zend_Locale');
        $this->_translate   = Zend_Registry::get('Zend_Translate');
        $this->_config      = Zend_Registry::get('Zend_Config');
        $this->_response    = new Core_Model_ResponseObject();
        $this->_utility     = new Core_Service_Utility();

        $this->_configModel = new Core_Model_Config();
        $this->_mediaModel  = new Media_Model_Media();

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

}
