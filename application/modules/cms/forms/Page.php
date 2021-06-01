<?php

class Cms_Form_Page extends Tiger_Form_Base {
    
    protected $_locale;
    protected $_translate;
    protected $_config;

    const PAGE      = 'page';
    const MENU      = 'menu';
    const PARTIAL   = 'partial';
    const BLOG      = 'blog';
    const LAYOUT    = 'layout';
    const DOC       = 'doc';


    public function init() {
        
        $this->_locale          = Zend_Registry::get('Zend_Locale');
        $this->_translate       = Zend_Registry::get('Zend_Translate');
        $this->_config          = Zend_Registry::get('Zend_Config');
        
        // Allows us to load and use custom ZendTiger validator classes with elements
        $this->addElementPrefixPath('Tiger_Validate', 'Tiger/Validate/', 'validate');
        $this->addElementPrefixPath('Tiger_Filter', 'Tiger/Filter/', 'filter');

        $this->setAction( '/ajax' )->
                setMethod('post')->
                setName('Cms_Form_Page')->
                setAttrib('id', 'page-form')->
                setAttrib('class', 'form-horizontal');

        $this->addElement($this->_getPageId());

        # URL Data #

        $this->addElement($this->_getKey());
        $this->addElement($this->_getName());
        $this->addElement($this->_getTheme());
        $this->addElement($this->_getLayout());
        $this->addElement($this->_getCategory());
        $this->addElement($this->_getType());
        $this->addElement($this->_getTemplates());

        # Article Content #

        $this->addElement($this->_getContent());
        $this->addElement($this->_getLocale());
        $this->addElement($this->_getTitle());

        # Links, Scripts, Meta, & Options #

        $this->addElement($this->_getLinks());
        $this->addElement($this->_getHeadScripts());
        $this->addElement($this->_getInlineScripts());
        $this->addElement($this->_getStyles());
        $this->addElement($this->_getScripts());
        $this->addElement($this->_getMeta());
        $this->addElement($this->_getOptions());

        # Article Controls #

        $this->addElement($this->_getActive());
        $this->addElement($this->_getDeleted());


        # Global Decorator Declarations #
        $this->_setGlobalDecorators();

        # Now set some global filters, adjustments, and settings. #

        $this->_setGlobalFilters();
        $this->_elementAdjustments();
        
    }
    
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
    
    // Form Fields //

    // Content //

    protected function _getPageId ( ) {

        $name = 'page_id';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    [ 'Uuid', false, [
                                        'messages'  => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID" ]
                                    ] ],

                                ],
        );

        return new Zend_Form_Element_Hidden( $name, $options );
        
    }

    protected function _getName ( ) {

        $name = 'name';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid'    => '1',
                                ],

            'label'         =>  strtoupper( 'LABEL.PAGE_' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.PAGE_' . $name ),

            'required'      =>  true,
            'filters'       =>  [
                                    ['PregReplace', ['match' => '/[^A-Za-z0-9\- ]/', 'replace' => ''] ],
                                ],
            'validators'    =>  [
                                    ['StringLength', false, [1, 50] ],
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z0-9\- ]+$/',
                                        'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getKey ( ) {

        $name = 'key';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid'    => '1',
                                ],

            'label'         =>  strtoupper( 'LABEL.PAGE_' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.PAGE_' . $name ),

            'required'      =>  true,
            'filters'       =>  [
                ['PregReplace', ['match' => '/[^A-Za-z0-9\-]/', 'replace' => '']],
            ],
            'validators'    =>  [
                ['StringLength', false, [1, 50]],
                ['Regex', false, [
                    'pattern' => '/^[A-Za-z0-9\-]+$/',
                    'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                ]],
            ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getTheme ( ) {

        $name = 'theme';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg select2',
            'attribs'       =>  [
                                    'data-valid'    => '1',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'registerInArrayValidator'  => false,
            'multiOptions'  =>  [],

            'required'      =>  false,
            'filters'       =>  [
                                    ['PregReplace', ['match' => '/[^A-Za-z0-9\-]/', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    ['StringLength', false, [1, 50]],
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z0-9\-]+$/',
                                        'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getLayout ( ) {

        $name = 'layout';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg select2',
            'attribs'       =>  [
                                    'data-valid'    => '1',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'registerInArrayValidator'  => false,
            'multiOptions'  =>  [],

            'required'      =>  false,
            'filters'       =>  [
                                    ['PregReplace', ['match' => '/[^A-Za-z0-9\-]/', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    ['StringLength', false, [1, 50]],
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z0-9\-]+$/',
                                        'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getCategory ( ) {

        $name = 'category';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid'    => '1',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

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

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getType ( ) {

        $multiOptions = [
            self::PAGE      => $this->_translate->translate('OPTION.PAGE'),
            self::BLOG      => $this->_translate->translate('OPTION.BLOG'),
            self::PARTIAL   => $this->_translate->translate('OPTION.PARTIAL'),
            self::MENU      => $this->_translate->translate('OPTION.MENU'),
            self::LAYOUT    => $this->_translate->translate('OPTION.LAYOUT'),
            self::DOC       => $this->_translate->translate('OPTION.DOC'),
        ];

        $name = 'type';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg select2',
            'attribs'       =>  [
                'data-valid'    => '1',
            ],

            'label'         =>  strtoupper( 'LABEL.PAGE_' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.PAGE_' . $name ),

            'registerInArrayValidator'  => true,
            'multiOptions'  =>  $multiOptions,

            'required'      =>  true,
            'filters'       =>  [
                                    ['PregReplace', ['match' => '/[^A-Za-z0-9\-]/', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z0-9\-]+$/',
                                        'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getContent ( ) {

        $name = 'content';

        $options = [
            
            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid' => '1',
                                ],

            'value'         => 'Start typing here ... Select text to edit.',

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),
            
            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                    [ 'PregReplace', ['match' => '/[^\W\w\S\s]/mu', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    // [ 'StringLength', false, [1, 10000) ],
                                    [ 'Regex', false, [
                                        'pattern' => '/^[\W\w\S\s]+$/mu',
                                        'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getLocale ( ) {

        $multiOptions = Zend_Registry::get('Zend_Translate')->getList();

        $name = 'locale';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg select2',
            'attribs'       =>  [
                'data-valid'    => '1',
            ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'registerInArrayValidator'  => true,
            'multiOptions'  =>  $multiOptions,

            'required'      =>  false,
            'filters'       =>  [
                                    ['PregReplace', ['match' => '/[^A-Za-z\_]/', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z\_]+$/',
                                        'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
            ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getTitle ( ) {

        $name = 'title';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid'    => '1',
                                    'placeholder' => $this->_translate->translate('form.page.label.' . $name),
                                ],

            'label'         =>  strtoupper( 'LABEL.PAGE_' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.PAGE_' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    ['PregReplace', ['match' => '/[^A-Za-z 0-9\-]/', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    ['StringLength', false, [0, 255]],
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z 0-9\-]+$/',
                                        'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getTemplates ( ) {

        $name = 'templates';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg select2',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'required'      =>  false,
            'filters'       =>  [
                                    ['StringTrim'],
                                    ['PregReplace', ['match' => '/[^A-Za-z0-9\/\-:._\s]/', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z0-9\/\-:._\s]+$/',
                                        'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        );

        return new Zend_Form_Element_Select( $name, $options );

    }

    // Links, Scripts, Meta, & Options //

    protected function _getLinks ( ) {

        $name = 'links';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid' => '1',
                                    'placeholder' => $this->_translate->translate('form.page.label.' . $name),
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                    [ 'PregReplace', ['match' => '/[^\W\w\S\s]/mu', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    // [ 'StringLength', false, [1, 10000) ],
                                    [ 'Regex', false, [
                                        'pattern' => '/^[\W\w\S\s]+$/mu',
                                        'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],

        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getHeadScripts ( ) {

        $name = 'headScripts';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid'    => '1',
                                    'placeholder' => $this->_translate->translate('form.page.label.' . $name),
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                    [ 'PregReplace', ['match' => '/[^\W\w\S\s]/mu', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    // [ 'StringLength', false, [1, 10000) ],
                                    [ 'Regex', false, [
                                        'pattern' => '/^[\W\w\S\s]+$/mu',
                                        'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getInlineScripts ( ) {

        $name = 'inlineScripts';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid'    => '1',
                                    'placeholder' => $this->_translate->translate('form.page.label.' . $name),
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                    [ 'PregReplace', ['match' => '/[^\W\w\S\s]/mu', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    // [ 'StringLength', false, [1, 10000) ],
                                    [ 'Regex', false, [
                                        'pattern' => '/^[\W\w\S\s]+$/mu',
                                        'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getStyles ( ) {

        $name = 'styles';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                ],
            'validators'    =>  [
                                ],
        ];

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getScripts ( ) {

        $name = 'scripts';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                ],
            'validators'    =>  [
                                ],
        ];

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getMeta ( ) {

        $name = 'meta';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid'    => '1',
                                    'placeholder' => $this->_translate->translate('form.page.label.' . $name),
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                    [ 'PregReplace', ['match' => '/[^\W\w\S\s]/mu', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    // [ 'StringLength', false, [1, 10000) ],
                                    [ 'Regex', false, [
                                        'pattern' => '/^[\W\w\S\s]+$/mu',
                                        'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getOptions ( ) {

        $name = 'options';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                'data-valid'    => '1',
                'placeholder' => $this->_translate->translate('form.page.label.' . $name),
            ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                [ 'StringTrim' ],
                [ 'PregReplace', ['match' => '/[^\W\w\S\s]/mu', 'replace' => '']],
            ],
            'validators'    =>  [
                // [ 'StringLength', false, [1, 10000) ],
                [ 'Regex', false, [
                    'pattern' => '/^[\W\w\S\s]+$/mu',
                    'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                ]],
            ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    // Boilerplate //

    protected function _getActive ( ) {

        $name = 'active';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name . '_page',
            'class'             =>  'custom-control-input',

            'attribs'           =>  [
                                        'data-valid' => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'disableHidden'     =>  true,

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'        =>  [
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

    protected function _getDeleted ( ) {

        $name = 'deleted';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name . '_page',
            'class'             =>  'custom-control-input',

            'attribs'           =>  [
                                        'data-valid' => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'disableHidden'     =>  true,

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'        =>  [
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

}

