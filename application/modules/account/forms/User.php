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

class Account_Form_User extends Tiger_Form_Base
{

    public function init ( ) {

        parent::init();

    }

    /**
     * This method gets called automagically by the base class.
     * @throws Zend_Form_Exception
     */
    protected function _addFormElements ( ) {

        $this->setName('Account_Form_User');

        $this->addElement( $this->_getUserId() );
        $this->addElement( $this->_getUsername() );
        $this->addElement( $this->_getPassword() );
        $this->addElement( $this->_getPasswordResetKey() );
        $this->addElement( $this->_getRole() );
        $this->addElement( $this->_getEmail() );
        $this->addElement( $this->_getEmailVerifyKey() );
        $this->addElement( $this->_getUserDisplayName() );
        $this->addElement( $this->_getTypeTitle() );
        $this->addElement( $this->_getFirstName() );
        $this->addElement( $this->_getMiddleName() );
        $this->addElement( $this->_getLastName() );
        $this->addElement( $this->_getTypeSuffix() );
        $this->addElement( $this->_getCompanyTitle() );
        $this->addElement( $this->_getReferralUserId() );
        $this->addElement( $this->_getReferralOrgId() );
        $this->addElement( $this->_getTypeHearAbout() );
        $this->addElement( $this->_getActive() );
        $this->addElement( $this->_getDeleted() );

        $this->addElement( $this->_getCurrentPassword() );
        $this->addElement( $this->_getAvatarURL() );

    }

    ##### Form Fields #####

    protected function _getUserId ( ) {

        $name = 'user_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt disabled',

            'attribs'       =>  [
                                    // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                    'disabled'      => 'disabled',
                                    'data-valid'    => '0',
                                ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID" ]
                                    ] ],
                                ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getUsername ( ) {

        $name = 'username';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'    => '0',
                                        'data-context'  => '',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 50,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Db_NoRecordExists', false, [
                                            'table'    => 'user',
                                            'field'    => 'username',
                                            'messages' => [
                                                Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND => "ERROR.USERNAME_EXISTS",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                                'pattern' => '/^[A-Za-z0-9]+$/',
                                                'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                            ] ]
                                        ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getPassword ( ) {

        // Get the password strength configs and update them with translated labels
        $configs = $this->_config->password->toArray();

        $configs['labels'][0] = $this->_translate->translate('PASSWORD.WEAK');
        $configs['labels'][1] = $this->_translate->translate('PASSWORD.FAIR');
        $configs['labels'][2] = $this->_translate->translate('PASSWORD.GOOD');
        $configs['labels'][3] = $this->_translate->translate('PASSWORD.STRONG');

        $name = 'password';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt tiger-password-strength',

            'attribs'       =>  [
                'placeholder'       =>  $this->_translate->translate( 'FORM.NEW_PASSWORD' ),
                'data-valid'        => '0',
                'autocomplete'      => 'off',
                'data-requirements' => json_encode( $configs ), // <-- configs get added to the control
            ],

            'label'         =>  'LABEL.PASSWORD',
            'description'   =>  'PASSWORD.DESCRIPTION', // <-- this is a special template that needs to be set in translations

            'required'      =>  true,

            'filters'       =>  [
                [ 'StringTrim' ],
            ],

            'validators'    =>  [
                ['NotEmpty', false, [
                    'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                ] ],
                ['StringLength', false, [
                    'min' => 1,
                    'max' => 50,
                    'messages' => [
                        Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                        Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                    ]
                ] ],
                [ 'Strength', false, [
                    'messages' => [
                        Tiger_Validate_Strength::PW_LENGTH    => "ERROR.PW_LENGTH",
                        Tiger_Validate_Strength::PW_UPPER     => "ERROR.PW_UPPER",
                        Tiger_Validate_Strength::PW_LOWER     => "ERROR.PW_LOWER",
                        Tiger_Validate_Strength::PW_DIGIT     => "ERROR.PW_DIGIT",
                        Tiger_Validate_Strength::PW_SPECIAL   => "ERROR.PW_SPECIAL",
                        Tiger_Validate_Strength::PW_ILLEGAL   => "ERROR.PW_ILLEGAL",
                        Tiger_Validate_Strength::PW_REPEATING => "ERROR.PW_REPEATING",
                    ],
                ] ],
            ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getPasswordResetKey ( ) {

        $name = 'password_reset_key';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'    => '0',
                                    ],

            'required'      =>  false,

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID" ]
                                    ] ],
                                ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getRole ( ) {

        $name = 'role';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'required'      =>  true,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    [ 'NotEmpty', false, [
                                        'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                    ] ],
                                    [ 'Regex', false, [
                                        'pattern'   => '/^[A-Za-z]+$/',
                                        'messages'  => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                    ] ],

                                ],
        );

        return new Zend_Form_Element_Select( $name, $options );

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
                                    'data-context'  => '',
            ],

            'label'         =>  'LABEL.EMAIL',
            'description'   =>  'DESCRIPTION.EMAIL',

            'required'      =>  true,

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['NotEmpty', false, [
                                        'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                    ] ],
                                    [ 'StringLength', false, [
                                        'min' => 5,
                                        'max' => 100,
                                        'messages' => [
                                            Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                            Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                        ]
                                    ] ],
                                    [ 'Db_NoRecordExists', false, [
                                        'table'    => 'user',
                                        'field'    => 'email',
                                        'messages' => [
                                            Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND => "ERROR.EMAIL_EXISTS",
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

    protected function _getEmailVerifyKey ( ) {

        $name = 'email_verify_key';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt',

            'attribs'       =>  [
                                    // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                    'data-valid'    => '0',
                                ],

            'required'      =>  false,

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID" ]
                                    ] ],
            ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getUserDisplayName ( ) {

        $name = 'user_display_name';

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
                                            'match' => '/[^A-Za-z0-9 \'\-,.]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 50,
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

    protected function _getTypeTitle ( ) {

        $name = 'type_title';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

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

        ];

        return new Zend_Form_Element_Select( $name, $options );

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
                                            'match' => '/[^A-Za-z0-9 \'\-,.]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 50,
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

    protected function _getMiddleName ( ) {

        $name = 'middle_name';

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
                                            'match' => '/[^A-Za-z0-9 \'\-,.]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 50,
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
                                            'match' => '/[^A-Za-z0-9 \'\-,.]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 50,
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

    protected function _getTypeSuffix ( ) {

        $name = 'type_suffix';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

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

        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getCompanyTitle ( ) {

        $name = 'company_title';

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
                                            'match' => '/[^A-Za-z0-9 \'\-,.]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 50,
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

    protected function _getReferralUserId ( ) {

        $name = 'referral_user_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                'data-valid' => '0',
            ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID" ]
                                    ] ],

            ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getReferralOrgId ( ) {

        $name = 'referral_org_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                'data-valid' => '0',
            ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID" ]
                                    ] ],

            ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getTypeHearAbout ( ) {

        $name = 'type_hearabout';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt select2',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Z0-9]/',
                                            'replace' => ''
                                        ] ]
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
                                        [ 'Regex', false, [
                                            'pattern' => '/^[A-Z0-9]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getActive ( ) {

        $name = 'active';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name . '_user',
            'class'             =>  'custom-control-input',

            'attribs'           =>  [
                                        'data-valid' => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'disableHidden'     => true,

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
            'id'                =>  $name . '_user',
            'class'             =>  'custom-control-input',

            'attribs'           =>  [
                                        'data-valid' => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'disableHidden'     => true,

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

    protected function _getCurrentPassword ( ) {

        $name = 'current_password';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt',

            'attribs'       =>  [
                // 'placeholder'       =>  $this->_translate->translate( 'PASSWORD' ),
                'data-valid'        => '0',
                'autocomplete'      => 'off',
                // 'data-requirements' => json_encode( $configs ), // <-- configs get added to the control
            ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  true,

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['NotEmpty', false, [
                                        'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                    ] ],
                                    ['StringLength', false, [
                                        'min' => 1,
                                        'max' => 50,
                                        'messages' => [
                                            Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                            Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                        ]
                                    ] ],
                                ],
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getAvatarURL ( ) {

        $name = 'avatar_url';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                        'data-toggle'   => 'custom-file-input'
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9\/\_\%\&\$\-\.\+]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 250,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[A-Za-z0-9\/\_\%\&\$\-\.\+]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ],

        ];

        return new Zend_Form_Element_Hidden( $name, $options );

    }

}
