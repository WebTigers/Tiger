<?php

class Tiger_Form_Base extends Zend_Form
{

    protected $_session;
    protected $_locale;
    protected $_translate;
    protected $_config;

    public function init() {

        $this->_session   = new Zend_Session_Namespace( 'forms' );
        $this->_locale    = Zend_Registry::get('Zend_Locale');
        $this->_translate = Zend_Registry::get('Zend_Translate');
        $this->_config    = Zend_Registry::get('Zend_Config');

        // Allows us to load and use custom ZendTiger validator classes with elements
        $this->addElementPrefixPath('Tiger_Validate', 'Tiger/Validate/', 'validate');

        // add the form elements
        $this->_addFormElements();

        // global decorator declarations
        $this->_setGlobalDecorators();

        // now set some global filters, adjustments, and settings
        $this->_elementAdjustments();

        $this->_getCSRF();

    }

    public function isValid ( $data ) {

        $remove = [
            'module' => null,
            'controller' => null,
            'action' => null,
            'service' => null,
            'method' => null,
            'form' => null,
        ];

        $newData = array_diff_key( $data, $remove );

        return parent::isValid( $newData );

    }

    public function isValidPreserve ( $data ) {
        return parent::isValid( $data );
    }

    protected function _addFormElements ( )
    {
        /** This will usually be overridden with an extension class. */
    }

    protected function _setGlobalDecorators ( )
    {
        $this->clearDecorators();

        $this->addDecorators([
            'FormElements',
        ]);

        $this->setElementDecorators([
            ['ViewHelper'],
        ]);
    }

    protected function _elementAdjustments ( )
    {
        /** This will usually be overridden with an extension class. */
    }

    ##### Form Fields #####

    protected function _getCSRF ( ) {

        /**
         * This form field works with the Tiger Validate Csrf validator.
         */

        $name = 'csrf';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 50,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Uuid', false, [
                                            'messages' => [
                                                Tiger_Validate_Uuid::MSG_EMPTY_UUID => "ERROR.EMPTY_VALUE",
                                                Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID",
                                            ]
                                        ] ],
                                        [ 'Csrf', false, [
                                            'messages' => [
                                                Tiger_Validate_Csrf::MSG_EMPTY_TOKEN => "ERROR.EMPTY_TOKEN",
                                                Tiger_Validate_Csrf::MSG_INVALID_TOKEN => "ERROR.INVALID_TOKEN",
                                                Tiger_Validate_Csrf::MSG_EXPIRED_TOKEN => "ERROR.EXPIRED_TOKEN",
                                                Tiger_Validate_Csrf::MSG_MISMATCHED_TOKENS => "ERROR.MISMATCHED_TOKENS",
                                            ]
                                        ] ],

            ]
        ];

        return new Zend_Form_Element_Hidden( $name, $options );

    }

    /**
     * $this->_session should first be set in the concrete class, usually
     * with the namespace of the form. That way, when the next form is created
     * for validation, it will pickup the existing session.
     *
     * Before echoing the csrf element to your page you should call the
     * setToken() method of the form. Note that a csrf token is only designed
     * to last for one page rendering before it should be regenerated.
     *
     * Note that you should not call setToken() before validation, since this
     * will regenerate a new token and render your sent token invalid.
     *
     * @throws Zend_Exception
     */
    public function setToken()
    {
        $token = Tiger_Utility_Uuid::v1();
        $this->_session->csrf = $token;

        // pr( $token );
        pr( $this->getElement('csrf') );

        $this->getElement('csrf')->setValue( $token );
    }

}
