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

class Core_Form_Setup extends Tiger_Form_Base
{

    public function init ( ) {

        parent::init();

    }

    /**
     * This method gets called automagically by the base class.
     * @throws Zend_Form_Exception
     */
    protected function _addFormElements ( ) {

        $this->setName('Core_Form_Setup');

        // Admin User //

        $this->addElement( $this->_getAdminFirstName() );
        $this->addElement( $this->_getAdminLastName() );
        $this->addElement( $this->_getAdminEmail() );
        $this->addElement( $this->_getAdminUsername() );
        $this->addElement( $this->_getAdminPassword() );

        // Database //

        $this->addElement( $this->_getDBUsername() );
        $this->addElement( $this->_getDBPassword() );

        // Encryption //

        $this->addElement( $this->_getEncryptionKey() );
        $this->addElement( $this->_getEncryptionIV() );

        // SES SMTP //

        $this->addElement( $this->_getSMTPHost() );
        $this->addElement( $this->_getSMTPUsername() );
        $this->addElement( $this->_getSMTPPassword() );
        $this->addElement( $this->_getSMTPAuth() );
        $this->addElement( $this->_getSMTPSSL() );
        $this->addElement( $this->_getSMTPPort() );

        // COMPOSER GITHUB oAUTH TOKEN //

        $this->addElement( $this->_getGitHubToken() );

        // Register //

        $this->addElement( $this->_getFirstName() );
        $this->addElement( $this->_getLastName() );
        $this->addElement( $this->_getCompanyName() );
        $this->addElement( $this->_getEmail() );
        $this->addElement( $this->_getCountry() );
        $this->addElement( $this->_getTypeProfession() );
        $this->addElement( $this->_getTypeHearAbout() );

    }

    ##### Admin User #####

    protected function _getAdminFirstName ( ) {

        $name = 'admin_first_name';

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

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^\w\W]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        ['NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 1,
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

    protected function _getAdminLastName ( ) {

        $name = 'admin_last_name';

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

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^\w\W]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        ['NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
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

    protected function _getAdminEmail ( ) {

        $name = 'admin_email';

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

    protected function _getAdminUsername ( ) {

        $name = 'admin_username';

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

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9]+$/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        ['NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 255,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
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

    protected function _getAdminPassword ( ) {

        // Get the password strength configs and update them with translated labels
        $configs = $this->_config->password->toArray();

        $configs['labels'][0] = $this->_translate->translate('PASSWORD.WEAK');
        $configs['labels'][1] = $this->_translate->translate('PASSWORD.FAIR');
        $configs['labels'][2] = $this->_translate->translate('PASSWORD.GOOD');
        $configs['labels'][3] = $this->_translate->translate('PASSWORD.STRONG');

        $name = 'admin_password';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt tiger-password-strength',

            'attribs'       =>  [
                                    // 'placeholder'       =>  $this->_translate->translate( 'PASSWORD' ),
                                    'data-valid'        => '0',
                                    'autocomplete'      => 'off',
                                    'data-requirements' => json_encode( $configs ), // <-- configs get added to the control
                                ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
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

    ##### Database #####

    protected function _getDBUsername ( ) {

        $name = 'db_username';

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

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9]+$/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        ['NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 250,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
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

    protected function _getDBPassword ( ) {

        $name = 'db_password';

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

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9]+$/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        ['NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 250,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
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

    ##### Encryption #####

    protected function _getEncryptionKey ( ) {

        $name = 'encryption_key';

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

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9 ]+$/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        ['NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 150,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[A-Za-z0-9 ]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );


    }

    protected function _getEncryptionIV ( ) {

        $name = 'encryption_iv';

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

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9 ]+$/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        ['NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 150,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[A-Za-z0-9 ]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    ##### SES SMTP #####

    protected function _getSMTPHost ( ) {

        $name = 'smtp_host';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'value'             => 'email-smtp.us-east-1.amazonaws.com',   // Sets a default value.

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
                                            'min'   => 30,
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

    protected function _getSMTPUsername ( ) {

        $name = 'smtp_username';

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
                                            'min'   => 1,
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

    protected function _getSMTPPassword ( ) {

        $name = 'smtp_password';

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
                                            'min'   => 1,
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

    protected function _getSMTPAuth ( ) {

        $name = 'smtp_auth';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'value'             => 'login',   // Sets a default value.

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9]+$/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 25,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
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

    protected function _getSMTPSSL ( ) {

        $name = 'smtp_ssl';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'value'             => 'tls',   // Sets a default value.

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9]+$/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 0,
                                            'max'   => 25,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
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

    protected function _getSMTPPort ( ) {

        $name = 'smtp_port';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                    ],

            'value'             => '587',   // Sets a default value.

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^0-9]+$/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 10,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[0-9]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    ##### COMPOSER GITHUB TOKEN #####

    protected function _getGitHubToken ( ) {

        $name = 'github_oauth_token';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE_DESCRIPTION' ),
                                        'data-valid'    => '0',
                                        'data-token-url' => $this->_config->tiger->composer->token_url
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
                                            'min'   => 1,
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

    ##### Register #####

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

}
