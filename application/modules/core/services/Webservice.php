<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Copyright Notice
 * ————————————————————————————————————————————————————————————————————————————————
 *
 *  Copyright © 2020 WebTigers
 *  All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains the property of WebTigers.
 * The intellectual and technical concepts contained herein are proprietary to
 * WebTigers and may be covered by U.S. and Foreign Patents, patents in process, and
 * are protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from WebTigers.
 *
 * See the LICENSE.txt for full licensing information governing the use of this
 * information and software.
 */

/**
 * Class Core_Service_Webservice
 *
 * A Core Abstract Service that can be extended by other classes when their functions
 * need to be made accessible to webservice calls.
 *
 */
abstract class Core_Service_Webservice
{

    protected $_locale;
    protected $_config;
    protected $_response;
    protected $_request;
    protected $_form;
    protected $_reflection;

    public function __construct( $input ) {

        $this->_locale      = Zend_Registry::get('Zend_Locale');
        $this->_config      = Zend_Registry::get('Zend_Config');
        $this->_response    = new Core_Model_ResponseObject();

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

    // Common Class Functions //

    /**
     * If this service is called via the API, the dispatch
     * method will route the $params to the proper function.
     * @param type $params
     */
    protected function _dispatch ( $params ) {

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
     * Convenience function used to set form errors. Call the function
     * without passing in a form to use the set form for the service,
     * or pass in a different form to set the responseObject from it.
     * @param null $frm
     */
    protected function _setFormErrors ( $frm = null ) {

        $form = ( ! is_null( $frm ) ) ? $frm : $this->_form;

        $this->_response->result    = 0;
        $this->_response->form      = $form->getName();
        $this->_response->messages  = $form->getMessages();

    }

    public function getForm ( ) {
        return $this->_form;
    }

    public function setForm ( Zend_Form $form ) {
        $this->_form = $form;
    }

    public function getResponse ( ) {
        return $this->_response;
    }

}