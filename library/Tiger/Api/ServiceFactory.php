<?php

class Tiger_Api_ServiceFactory {

    protected $_request;
    protected $_response;
    protected $_translate;
    protected $_acl;
    protected $_role;
    protected $_params;
    protected $_serviceClass;

    const MODULE_CORE = "core";
    const ROLE_GUEST = "guest";

    public function __construct( Zend_Controller_Request_Http $request ) {

        $this->_request     = $request;
        $this->_translate   = Zend_Registry::get( 'Zend_Translate' );
        $this->_response    = new Core_Model_ResponseObject();
        $this->_acl         = Zend_Registry::get( 'Zend_Acl' );
        $this->_role        = Zend_Auth::getInstance()->getIdentity()->role;
        $this->_params      = $request->getParams();

        pr('COOL!');

        $this->_processRequest();
        
    }

    /**
     * @return Core_Model_ResponseObject
     */
    public function getResponse ( ) {
        
        return $this->_response;
        
    }

    /**
     * Process the API Request.
     * Validates and instantiates the necessary service and method to call.
     * Use the getResponse() method to retrieve the service response.
     * @return null
     */
    protected function _processRequest ( ) {
        
        try {

            $this->_getValidModule();
            $this->_getValidService();
            $this->_getValidMethod();

            pr( 'YO!' );

            if ( ! $this->_acl->isAllowed( $this->_role, $this->_serviceClass, $this->_method ) ) {

                /**
                 * Often an ajax call is rejected because we're no longer logged in. Setting
                 * this login flag helps us see that we just need to login again.
                 */
                $this->_response->login = ( $this->_role === self::ROLE_GUEST );

                throw new Exception( $this->_translator->translate( 'ERROR.ACTION_NOT_ALLOWED' ));

            }

            if ( ! class_exists( $this->_serviceClass, true ) ) {

                throw new Exception( $this->_translator->translate( 'ERROR.INVALID_SERVICE' ) );

            }

            $service = new $this->_serviceClass( $this->_params );
            $this->_response = $service->getResponse();

        }
        catch ( Exception $e ) {

            $message = $e->getMessage();

            $this->_response->setTextMessage( $message, 'error' );
            $this->_response->result = false;

        }

    }

    /**
     * Sets a valid module.
     * @throws Zend_Validate_Exception
     * @throws Exception
     */
    protected function _getValidModule ()
    {
        /** $modules is an array of all of the active modules. */
        $modules = array_keys( Zend_Controller_Front::getInstance()->getDispatcher()->getControllerDirectory() );

        if ( ! isset( $this->_params['module'] ) ) {

            $this->_params['module'] = self::MODULE_CORE;

        }
        else {

            if ( ! Zend_Validate::is( $this->_params['module'], 'Alpha' ) || ! in_array( $this->_params['module'], $modules) ){
                throw new Exception( $this->_translator->translate( 'ERROR.INVALID_MODULE' ) );
            }

        }

    }

    /**
     * Sets a valid service name and class.
     * @throws Zend_Validate_Exception
     */
    protected function _getValidService ( )
    {

        $this->_params['service'] = ( isset( $this->_params['service'] ) && Zend_Validate::is( $this->_params['service'], 'Alpha' ) )
            ? $this->_params['service']
            : '';

        $this->_serviceClass = ucfirst( $this->_params['module'] ) . '_Service_' . ucfirst( $this->_params['service'] );

    }

    /**
     * Sets a valid service method.
     * @throws Zend_Validate_Exception
     * @throws Exception
     */
    protected function _getValidMethod ( )
    {
        if ( ! isset( $this->_params['method'] ) || ! Zend_Validate::is( $this->_params['method'], 'Alpha' ) ){
            throw new Exception( $this->_translator->translate( 'ERROR.INVALID_METHOD' ) );
        }
    }

}
