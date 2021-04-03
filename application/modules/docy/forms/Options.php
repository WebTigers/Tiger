<?php

class Docy_Form_Options extends Zend_Form {
    
    protected $_locale;
    protected $_translate;
    protected $_config;

    public function init() {
        
        $this->_locale          = Zend_Registry::get('Zend_Locale');
        $this->_translate       = Zend_Registry::get('Zend_Translate');
        $this->_config          = Zend_Registry::get('Zend_Config');

        /** Allows us to load and use custom Tiger validator and filter classes with elements */
        $this->addElementPrefixPath('Tiger_Validate', 'Tiger/Validate/', 'validate');
        $this->addElementPrefixPath('Tiger_Filter', 'Tiger/Filter/', 'filter');

        /**
         * Setting these form attributes is probably overkill because we typically don't use them.
         * But, we set them just in case you want to use them in your own applications.
         */
        $this->setAction( '/ajax' )->
                setMethod('post')->
                setName('Cms_Form_Page')->
                setAttrib('id', 'page-form')->
                setAttrib('class', 'form-horizontal');

        /**
         * Theme Options
         *
         * Note that order is important here. We try to organize the text inputs, selects
         * and the checkbox toggles together.
         */

        $this->addElement($this->_getTitle());
        $this->addElement($this->_getScheme());

        # Global Decorator Declarations #
        $this->_setGlobalDecorators();

        # Now set some global filters, adjustments, and settings. #
        $this->_setGlobalFilters();
        $this->_elementAdjustments();

    }

    // Setup Functions //

    protected function _setGlobalDecorators ( ) {

        $this->clearDecorators();

        $this->addDecorators(['FormElements', 'Form']);

        $this->setElementDecorators([
            ['ViewHelper'],
        ]);

    }

    protected function _setGlobalFilters ( ) {

    }

    protected function _elementAdjustments ( ) {

    }


    // Options Form Fields //

    protected function _getTitle ( ) {

        $name = 'title';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'required'      =>  true,
            'filters'       =>  [
                                    ['PregReplace', ['match' => '/[^A-Za-z0-9\- ]/', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    ['StringLength', false, [1, 50]],
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z0-9\- ]+$/',
                                        'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
            ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getScheme ( ) {

        $name = 'scheme';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'multiOptions'  =>  [],  // Set via Ajax call from Select2

            'required'      =>  false,
            'filters'       =>  [
                                    ['PregReplace', ['match' => '/[^A-Za-z0-9\- ]/', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    ['StringLength', false, [1, 50]],
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z0-9\- ]+$/',
                                        'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

}

