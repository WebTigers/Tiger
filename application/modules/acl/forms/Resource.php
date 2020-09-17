<?php

class Acl_Form_Resource extends Tiger_Form_Base
{

    public function init ( ) {

        parent::init();

    }

    /**
     * This method gets called automagically by the base class.
     * @throws Zend_Form_Exception
     */
    protected function _addFormElements ( ) {

        $this->setName('Acl_Form_Resource');

        $this->addElement( $this->_getResourceName() );
        $this->addElement( $this->_getResourceDescription() );
        $this->addElement( $this->_getResource() );
        $this->addElement( $this->_getPrivilege() );

    }

    ##### Form Fields #####

    protected function _getResourceName ( ) {

        $name = 'resource_name';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_NAME' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  'label.' . $name,
            'description'       =>  'description.' . $name,

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9 \'\-,.]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 100,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[A-Za-z0-9 \'\-,.]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getResourceDescription ( ) {

        $name = 'resource_description';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  'label.' . $name,
            'description'       =>  'description.' . $name,

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9 \'\-,.]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 100,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[A-Za-z0-9 \'\-,.]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getResource ( ) {

        $name = 'resource';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                'data-valid'    => '0',
            ],

            'label'             =>  'label.' . $name,
            'description'       =>  'description.' . $name,

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9\_.]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 100,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[A-Za-z0-9\_.]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getPrivilege ( ) {

        $name = 'privilege';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.PRIVILEGE' ),
                'data-valid'    => '0',
            ],

            'label'             =>  'label.' . $name,
            'description'       =>  'description.' . $name,

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9\_.]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 100,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[A-Za-z0-9\_.]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

}
