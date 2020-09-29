<?php

class Tiger_Api_ServiceFactory {

    protected $_request;
    protected $_response;
    protected $_translate;
    protected $_acl;
    protected $_role;
    protected $_params;
    protected $_module;
    protected $_service;
    protected $_serviceClass;
    protected $_method;

    const ROLE_GUEST = "guest";

    public function __construct( Zend_Controller_Request_Http $request ) {

        $this->_request     = $request;
        $this->_translate   = Zend_Registry::get( 'Zend_Translate' );
        $this->_response    = new Core_Model_ResponseObject();
        $this->_acl         = Zend_Registry::get( 'Zend_Acl' );
        $this->_role        = Zend_Auth::getInstance()->getIdentity()->role;
        $this->_params      = $request->getParams();

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

            if ( ! $this->_acl->isAllowed( $this->_role, $this->_serviceClass, $this->_method ) ) {

                /**
                 * Often an ajax call is rejected because we're no longer logged in. Setting
                 * this login flag helps us see that we just need to login again.
                 */
                $this->_response->login = ( $this->_role === self::ROLE_GUEST );
                throw new Exception( $this->_translate->translate( 'ERROR.ACTION_NOT_ALLOWED' ));

            }

            if (
                class_exists( $this->_serviceClass, true ) &&
                method_exists( $this->_serviceClass, $this->_method )
            )
            {

                /**
                 * HOW TIGER SERVICES WORK:
                 *
                 * This is where all the magic happens. The service class is called dynamically with
                 * all of the params it will need to forward the params payload to the proper method.
                 * The class method (function) will run automagically based on the method name passed into
                 * the class' constructor. The method will then perform all of its tasks and then set the
                 * standard responseObject within the class. All of this happens before the class is returned
                 * as the $service var!
                 *
                 * All that is necessary now is for us to gather the response from the $service instance.
                 *
                 * The API controller will then gather the responseObject from this service factory and return
                 * it to the view as a JSON response.
                 */

                /**
                 * In PHP 7.x, fatal errors are not caught by the exception handler. Wrapping this call in
                 * a try/catch for errors prevents the API from displaying the error page.
                 */

                $service = new $this->_serviceClass( $this->_params );
                $this->_response = $service->getResponse();


            }
            else {

                throw new Exception( $this->_translate->translate( 'ERROR.INVALID_SERVICE' ) );

            }

        }
        catch ( Error $e ) {

            $this->_response->setTextMessage( $e->getMessage(), 'error' );
            $this->_response->result = false;

        }
        catch ( Exception $e ) {

            $this->_response->setTextMessage( $e->getMessage(), 'error' );
            $this->_response->result = false;

        }

    }

    // Sanity Validation //

    /**
     * Sets a valid module.
     * @throws Zend_Validate_Exception
     * @throws Exception
     */
    protected function _getValidModule ( )
    {
        /** $modules is an array of all of the active modules. */
        $modules = array_keys( Zend_Controller_Front::getInstance()->getDispatcher()->getControllerDirectory() );

        if ( isset( $this->_params['service'] ) && strstr( $this->_params['service'],':' ) ) {

            $this->_module = explode( ':', $this->_params['service'] )[0];

            if ( ! Zend_Validate::is( $this->_module, 'Alpha' ) || ! in_array( $this->_module, $modules) ){
                throw new Exception( $this->_translate->translate( 'ERROR.INVALID_MODULE' ) );
            }

        }
        else {

            throw new Exception( $this->_translate->translate( 'ERROR.INVALID_SERVICE' ) );

        }

    }

    /**
     * Sets a valid service name and class.
     * @throws Zend_Validate_Exception
     */
    protected function _getValidService ( )
    {
        if ( isset( $this->_params['service'] ) && strstr( $this->_params['service'],':' ) ) {

            $this->_service = $this->_params['service'];
            $service = explode( ':', $this->_service )[1];

            if ( Zend_Validate::is( $service, 'Alpha' ) ) {
                $this->_serviceClass = ucfirst( $this->_module ) . '_Service_' . ucfirst( $service );
            }
            else {
                throw new Exception( $this->_translate->translate( 'ERROR.INVALID_SERVICE' ) );
            }

        }
        else {
            throw new Exception( $this->_translate->translate( 'ERROR.INVALID_SERVICE' ) );
        }

    }

    /**
     * Sets a valid service method.
     * @throws Zend_Validate_Exception
     * @throws Exception
     */
    protected function _getValidMethod ( )
    {
        if ( isset( $this->_params['method'] ) && Zend_Validate::is( $this->_params['method'], 'Alnum' ) ) {
            $this->_method = $this->_params['method'];
        }
        else {
            throw new Exception( $this->_translate->translate( 'ERROR.INVALID_METHOD' ) );
        }

    }

}
