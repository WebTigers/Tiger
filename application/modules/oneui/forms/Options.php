<?php

class Oneui_Form_Options extends Zend_Form {
    
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
        $this->addElement($this->_getAssetsFolder());
        $this->addElement($this->_getMainNav());
        $this->addElement($this->_getScheme());

        $this->addElement($this->_getCookies());
        $this->addElement($this->_getIncFooter());
        $this->addElement($this->_getIncHeader());
        $this->addElement($this->_getIncSideOverlay());
        $this->addElement($this->_getIncSidebar());
        $this->addElement($this->_getLHeaderDark());
        $this->addElement($this->_getLHeaderFixed());
        $this->addElement($this->_getLMContent());
        $this->addElement($this->_getLPageOverlay());
        $this->addElement($this->_getLSideOverlayHoverable());
        $this->addElement($this->_getLSideOverlayVisible());
        $this->addElement($this->_getLSideScroll());
        $this->addElement($this->_getLSidebarDark());
        $this->addElement($this->_getLSidebarLeft());
        $this->addElement($this->_getLSidebarMini());
        $this->addElement($this->_getLSidebarVisibleDesktop());
        $this->addElement($this->_getLSidebarVisibleMobile());
        $this->addElement($this->_getMainNavActive());
        $this->addElement($this->_getPageLoader());

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

    protected function _getAssetsFolder ( ) {

        $name = 'assets_folder';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'required'      =>  false,
            'filters'       =>  [
                                    ['PregReplace', ['match' => '/[^A-Za-z0-9\/\-:._\s]/', 'replace' => ''] ],
                                ],
            'validators'    =>  [
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z0-9\/\-:._\s]+$/',
                                        'messages' => [
                                            Zend_Validate_Regex::NOT_MATCH => "Invalid characters."
                                        ]
                                    ] ],
            ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getCookies ( ) {

        $name = 'cookies';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getIncFooter ( ) {

        $name = 'inc_footer';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getIncHeader ( ) {

        $name = 'inc_header';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getIncSideOverlay ( ) {

        $name = 'inc_side_overlay';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getIncSidebar ( ) {

        $name = 'inc_sidebar';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLHeaderDark ( ) {

        $name = 'l_header_dark';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLHeaderFixed ( ) {

        $name = 'l_header_fixed';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLMContent ( ) {

        $name = 'l_m_content';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLPageOverlay ( ) {

        $name = 'l_page_overlay';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLSideOverlayHoverable ( ) {

        $name = 'l_side_overlay_hoverable';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLSideOverlayVisible ( ) {

        $name = 'l_side_overlay_visible';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLSideScroll ( ) {

        $name = 'l_side_scroll';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLSidebarDark ( ) {

        $name = 'l_sidebar_dark';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLSidebarLeft ( ) {

        $name = 'l_sidebar_left';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLSidebarMini ( ) {

        $name = 'l_sidebar_mini';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLSidebarVisibleDesktop ( ) {

        $name = 'l_sidebar_visible_desktop';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getLSidebarVisibleMobile ( ) {

        $name = 'l_sidebar_visible_mobile';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getMainNav ( ) {

        $name = 'main_nav';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid'    => '1',
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

    protected function _getMainNavActive ( ) {

        $name = 'main_nav_active';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getPageLoader ( ) {

        $name = 'page_loader';

        $options = [

            'name'          =>  $name,

            'id'            =>  $name,
            'class'         =>  'custom-control-input',

            'attribs'       =>  [
                                        'data-valid' => '0',
                                    ],

            'label'         =>  strtoupper( 'LABEL.' . $name),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name),

            'disableHidden' =>  true,

            'required'      =>  false,

            'filters'       =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'    =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::INTEGER,
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Digits', false, [
                                            'messages' => [
                                                Zend_Validate_Digits::INVALID => "ERROR.INVALID",
                                                Zend_Validate_Digits::NOT_DIGITS => "ERROR.INVALID",
                                            ]
                                        ] ],
                                        [ 'Between', false, [
                                            'min' => 0,
                                            'max' => 1
                                        ] ],
                                    ],
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

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

