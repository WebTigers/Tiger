<?php

/**
 * 
 */
class Core_Service_Localize {

    protected $_locale;
    protected $_translate;
    protected $_currency;
    protected $_request;
    protected $_response;
    
    private $_reflection;

    public function __construct( $input ) {
        
        $this->_locale       = Zend_Registry::get( 'Zend_Locale' );
        $this->_translate    = Zend_Registry::get( 'Zend_Translate' );
        $this->_currency     = new Zend_Currency();
        
        if ( $input instanceof Zend_Controller_Request_Http ) {
            $this->_request = $input;
            $params = $this->_request->getParams();
        } 
        elseif( is_array($input) ) {
            $params = $input;
        }
        
        if( !isset( $this->_reflection ) ) {
            $this->_reflection = new ReflectionClass( $this );
        }
        
        $this->_dispatch( $params );
        
    }

    // Common Class Functions //
    
    /**
     * 
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
     * 
     * @return object of ResponseObject
     */
    public function getResponse() {
        return $this->_response;
    }
    
    
    // Public Functions //
    
    /**
     * 
     * @param type $params
     * @return type
     */
    public function translate ( $params ) {
        
        $this->_response = $this->_translate->{ $params['function'] }( $params['value'] );
        
    }
    
    /**
     * 
     * @param type $params
     * @return type
     */
    public function currency ( $params ) {
        
        $this->_response = $this->_currency-> { $params['function'] }( $params['value'] );
        
    }
    
    /**
     * 
     * @param type $params
     * @return type
     */
    public function format ( $params ) {
        
        $this->_response = Zend_Locale_Format::$params['function']( $params['value'] );
        
    }
    
}
