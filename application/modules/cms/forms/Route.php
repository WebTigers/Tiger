<?php

class Cms_Form_Route extends Tiger_Form_Base {
    
    protected $_locale;
    protected $_translate;
    protected $_config;
    protected $_page_id = null;

    const PAGE      = 'page';
    const MENU      = 'menu';
    const PARTIAL   = 'partial';
    const BLOG      = 'blog';
    const LAYOUT    = 'layout';

    public function init() {
        
        $this->_locale          = Zend_Registry::get('Zend_Locale');
        $this->_translate       = Zend_Registry::get('Zend_Translate');
        $this->_config          = Zend_Registry::get('Zend_Config');
        
        // Allows us to load and use custom ZendTiger validator classes with elements
        $this->addElementPrefixPath('Tiger_Validate', 'Tiger/Validate/', 'validate');
        $this->addElementPrefixPath('Tiger_Filter', 'Tiger/Filter/', 'filter');

        $this->setAction( '/ajax' )->
                setMethod('post')->
                setName('Cms_Form_Route')->
                setAttrib('id', 'route-form')->
                setAttrib('class', 'form-horizontal');

        $this->addElement($this->_getRoutePageId());

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

    protected function _getPageOptions ( ) {

        $pageModel = new Cms_Model_Page();

        $options = [
            '' => $this->_translate->translate('LABEL.USE_MVC_DEFAULT')
        ];

        $pageRowset = $pageModel->getPagesForSelect2();

        foreach ( $pageRowset as $page ) {
            $options[ $page->page_id ] = $page->name;
        }

        if ( isset( Zend_Registry::get('Zend_Config')->tiger->cms->default_home_page_id ) ) {
            $this->_page_id = Zend_Registry::get('Zend_Config')->tiger->cms->default_home_page_id;
        }

        return $options;

    }
    
    // Form Fields //

    // Content //

    protected function _getRoutePageId ( ) {

        $multiOptions = $this->_getPageOptions();

        $name = 'route_page_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg select2',
            'attribs'       =>  [
                                    'data-valid'    => '1',
                                ],
            'value'         =>  $this->_page_id,

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'registerInArrayValidator'  => false,
            'multiOptions'  =>  $multiOptions,

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    [ 'Uuid', false, [
                                        'messages'  => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID" ]
                                    ] ],

                                ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

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

