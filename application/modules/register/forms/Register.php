<?php

class Register_Form_Register extends Tiger_Form_Base
{

    public function init ( ) {

        parent::init();

    }

    /**
     * This method gets called automagically by the base class.
     * @throws Zend_Form_Exception
     */
    protected function _addFormElements ( ) {

        $this->setName('Register_Form_Register');

        $this->addElement( $this->_getRegisterId() );
        $this->addElement( $this->_getFirstName() );
        $this->addElement( $this->_getLastName() );
        $this->addElement( $this->_getCompanyName() );
        $this->addElement( $this->_getEmail() );
        $this->addElement( $this->_getCountry() );
        $this->addElement( $this->_getTypeProfession() );
        $this->addElement( $this->_getTypeHearAbout() );
        $this->addElement( $this->_getSubscribe() );
        $this->addElement( $this->_getActive() );
        $this->addElement( $this->_getDeleted() );
        $this->addElement( $this->_getVersion() );
        $this->addElement( $this->_getPlatform() );
        $this->addElement( $this->_getHost() );
        $this->addElement( $this->_getFramework() );

    }

    ##### Form Fields #####

    protected function _getRegisterId ( ) {

        $name = 'register_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt',

            'attribs'       =>  [
                                    // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                    'data-valid'    => '0',
                                ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID." ]
                                    ] ],
                                ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getFirstName ( ) {

        $name = 'first_name';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^\w\W]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 255,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[\w\W]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getLastName ( ) {

        $name = 'last_name';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^\w\W]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 255,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[\w\W]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getCompanyName ( ) {

        $name = 'company_name';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^\w\W]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 255,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[\w\W]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getEmail ( ) {

        $name = 'email';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt password-strength',
            'attribs'       =>  [
                                    // 'placeholder'   =>  $this->_translate->translate( 'EMAIL' ),
                                    'data-valid'    => '0',
                                ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    [ 'StringLength', false, [
                                        'min' => 5,
                                        'max' => 100,
                                        'messages' => [
                                            Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                            Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                        ]
                                    ] ],
                                    [ 'EmailAddress', false, [
                                        'messages' => [
                                            // Zend_Validate_EmailAddress::INVALID            => "Invalid type.",
                                            Zend_Validate_EmailAddress::INVALID_FORMAT     => "ERROR.EMAIL_INVALID_FORMAT",
                                            Zend_Validate_EmailAddress::INVALID_HOSTNAME   => "ERROR.EMAIL_INVALID_HOSTNAME",
                                            // Zend_Validate_EmailAddress::INVALID_MX_RECORD  => "Invalid host MX record.",
                                            // Zend_Validate_EmailAddress::INVALID_SEGMENT    => "Invalid address segments.",
                                            Zend_Validate_EmailAddress::DOT_ATOM           => "ERROR.EMAIL_INVALID_USER",
                                            // Zend_Validate_EmailAddress::QUOTED_STRING      => "Invalid email address.",
                                            // Zend_Validate_EmailAddress::INVALID_LOCAL_PART => "Invalid email address.",
                                            // Zend_Validate_EmailAddress::LENGTH_EXCEEDED    => "Email length is too long.",
                                        ],
                                    ] ],
                                ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getCountry ( ) {

        /** This gets us a list of Hearabout Types than can be used in the select control. */
        $countryModel = new Core_Model_Country;
        $countryList   = $countryModel->getCountryList();

        /** Add an empty "Please Select' to the top of the list. */
        array_unshift( $countryList, $this->_translate->translate('SELECT.PLEASE_SELECT') );

        $name = 'country';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'multiOptions'  =>  $countryList,

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                ],
        );

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getTypeProfession ( ) {

        /** This gets us a list of Hearabout Types than can be used in the select control. */
        $type       = new Core_Model_Type;
        $typeList   = $type->getTypeListByReference( 'profession', false, true );

        /** Add an empty "Please Select' to the top of the list. */
        array_unshift( $typeList, $this->_translate->translate('SELECT.PLEASE_SELECT') );

        $name = 'type_profession';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'multiOptions'  =>  $typeList,

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    [ 'Regex', false, [
                                        'pattern'   => '/^[A-Za-z0-9_\-\.]+$/',
                                        'messages'  => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                    ] ],

                                ],
        );

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getTypeHearAbout ( ) {

        /** This gets us a list of Hearabout Types than can be used in the select control. */
        $type       = new Core_Model_Type;
        $typeList   = $type->getTypeListByReference( 'hearabout', false, true );

        /** Add an empty "Please Select' to the top of the list. */
        array_unshift( $typeList, $this->_translate->translate('SELECT.PLEASE_SELECT') );

        $name = 'type_hearabout';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'multiOptions'  =>  $typeList,

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    [ 'Regex', false, [
                                        'pattern'   => '/^[A-Za-z0-9_\-\.]+$/',
                                        'messages'  => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                    ] ],

                                ],
        );

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getSubscribe ( ) {

        $name = 'subscribe';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name . '_register',
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

    protected function _getActive ( ) {

        $name = 'active';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name . '_register',
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
            'id'                =>  $name . '_register',
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

    protected function _getVersion ( ) {

        $name = 'version';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^\w\W]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 255,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[\w\W]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getPlatform ( ) {

        $name = 'platform';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^\w\W]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 255,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[\w\W]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getHost ( ) {

        $name = 'host';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^\w\W]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 255,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[\w\W]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getFramework ( ) {

        $name = 'framework';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^\w\W]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 255,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[\w\W]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

}
