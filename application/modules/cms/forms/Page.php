<?php

class Cms_Form_Page extends Zend_Form {
    
    protected $_locale;
    protected $_translate;
    protected $_config;

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
        $this->addElement($this->_getCategory());
        $this->addElement($this->_getType());
        $this->addElement($this->_getName());

        # Article Content #

        $this->addElement($this->_getContent());
        $this->addElement($this->_getTitle());

        # CSS and JS #

        $this->addElement($this->_getCss());
        $this->addElement($this->_getJavascript());
        $this->addElement($this->_getStyles());
        $this->addElement($this->_getScripts());

        # Meta #

        $this->addElement($this->_getMeta());

        # Links #

        $this->addElement($this->_getLinks());

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
        
        $this->addDecorators(array('FormElements', 'Form'));

        $this->setElementDecorators(array(
            array('ViewHelper'),
        ));
        
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

            'filters'       =>  array(
                                    array( 'StringTrim' ),
                                ),
            'validators'    =>  array(
                                    array( 'Uuid', false ),
                            ),
        );
        
        return new Zend_Form_Element_Hidden( $name, $options );
        
    }

    protected function _getName ( ) {

        $name = 'name';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid'    => '1',
                                ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  true,
            'filters'       =>  array(
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9\- ]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 50)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\- ]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getKey ( ) {

        $name = 'key';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                'data-valid'    => '1',
            ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  true,
            'filters'       =>  array(
                array('PregReplace', array('match' => '/[^A-Za-z0-9\-]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(1, 50)),
                array('Regex', false, array(
                    'pattern' => '/^[A-Za-z0-9\-]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getCategory ( ) {

        $name = 'category';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                'data-valid'    => '1',
            ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                array('PregReplace', array('match' => '/[^A-Za-z0-9\- ]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(1, 50)),
                array('Regex', false, array(
                    'pattern' => '/^[A-Za-z0-9\- ]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getType ( ) {

        $name = 'type';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                'data-valid'    => '1',
            ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                array('PregReplace', array('match' => '/[^A-Za-z0-9\-]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(1, 50)),
                array('Regex', false, array(
                    'pattern' => '/^[A-Za-z0-9\-]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getContent ( ) {

        $name = 'content';

        $options = array(
            
            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                ),

            'value'         => 'Start typing here ... Select text to edit.',

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,
            
            'required'      =>  false,
            'filters'       =>  array(
                                    array( 'StringTrim' ),
                                    array( 'PregReplace', array('match' => '/[^A-Za-z0-9\W\'\-,.!:\"\<\>\=\&\_\?\+\/]/', 'replace' => '') ),
                                ),
            'validators'    =>  array(
                                    // array( 'StringLength', false, array(1, 10000) ),
                                    array( 'Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\W\'\-,.!:\"\<\>\=\&\_\?\+\/]+$/',
                                        'messages' => array( Zend_Validate_Regex::NOT_MATCH => "Invalid characters." )
                                    )),
                                ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getTitle ( ) {

        $name = 'title';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                'data-valid'    => '1',
                'placeholder' => $this->_translate->translate('form.page.label.' . $name),
            ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                array('PregReplace', array('match' => '/[^A-Za-z 0-9\-]/', 'replace' => '')),
            ),
            'validators'    =>  array(
                array('StringLength', false, array(0, 255)),
                array('Regex', false, array(
                    'pattern' => '/^[A-Za-z 0-9\-]+$/',
                    'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                )),
            ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    // JS & CSS //

    protected function _getCss ( ) {

        $name = 'css';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9\/\-:._\s]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\/\-:._\s)]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters."))
                                    ),
                                ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getJavascript ( ) {

        $name = 'javascript';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('PregReplace', array('match' => '/[^A-Za-z0-9\/\-:._\s]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z0-9\/\-:._\s]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
            ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getStyles ( ) {

        $name = 'styles';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
            ),
            'validators'    =>  array(
            ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getScripts ( ) {

        $name = 'scripts';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'rows' => '4',
                                ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                ),
            'validators'    =>  array(
                                ),
        );

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    // Meta //

    protected function _getMeta ( ) {

        $name = 'meta';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid'    => '1',
                                    'placeholder' => $this->_translate->translate('form.page.label.' . $name),
                                ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('PregReplace', array('match' => '/[^A-Za-z 0-9\-]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(0, 255)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z 0-9\-]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

        return new Zend_Form_Element_Text( $name, $options );

    }

    // Links //

    protected function _getLinks ( ) {

        $name = 'og_title';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  array(
                                    'data-valid' => '1',
                                    'placeholder' => $this->_translate->translate('form.page.label.' . $name),
                                ),

            'label'         =>  'form.page.label.' . $name,
            'description'   =>  'form.page.description.' . $name,

            'required'      =>  false,
            'filters'       =>  array(
                                    array('PregReplace', array('match' => '/[^A-Za-z 0-9\-]/', 'replace' => '')),
                                ),
            'validators'    =>  array(
                                    array('StringLength', false, array(1, 50)),
                                    array('Regex', false, array(
                                        'pattern' => '/^[A-Za-z 0-9\-]+$/',
                                        'messages' => array(Zend_Validate_Regex::NOT_MATCH => "Invalid characters.")
                                    )),
                                ),
        );

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

