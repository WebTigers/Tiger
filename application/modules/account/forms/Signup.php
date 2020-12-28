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

class Account_Form_Signup extends Tiger_Form_Base
{

    public function init() {

        parent::init();

        if ( ! isset( $this->_session->pageSignupCaptchaValidated ) ) {
            // $this->_session->pageSignupCaptchaValidated = false;
        }

    }

    /**
     * This method gets called automagically by the base class.
     * @throws Zend_Form_Exception
     */
    protected function _addFormElements ( ) {

        $this->setName('Account_Form_Signup');

        $this->addElement( $this->_getReferralCode() );
        $this->addElement( $this->_getFirstName() );
        $this->addElement( $this->_getLastName() );
        $this->addElement( $this->_getCompanyName() );
        $this->addElement( $this->_getUsername() );
        $this->addElement( $this->_getPassword() );
        $this->addElement( $this->_getEmail() );
        $this->addElement( $this->_getTypeHearAbout() );
        // $this->addElement( $this->_getReCaptcha() );
        $this->addElement( $this->_getTerms() );

    }

    ##### Form Fields #####

    protected function _getReferralCode ( ) {

        /**
         * Referral code is usually set within the signup form or via the URL. You will need to create a specific
         * route to set a referral code from a URL. The current /signup route has this referral code pre-configured.
         * Typing /signup/123456 will make the referral_code available within the form field as a hidden form element.
         * What you do with the referral code is up to your specific application use case, but it will be sent,
         * validated and stored in the database when the user signs up if it is present.
         */

        $name = 'referral_code';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        'placeholder' =>  $this->_translate->translate( 'REFERRAL_CODE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  'LABEL.REFERRAL_CODE',
            'description'       =>  'DESCRIPTION.REFERRAL_CODE',

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9]/',
                                            'replace' => ''
                                        ] ],
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
                                            'pattern'   => '/^[A-Za-z0-9]+$/',
                                            'messages'  => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
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
                                        'placeholder'   =>  $this->_translate->translate( 'FIRST_NAME' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  'label.first_name',
            'description'       =>  'description.first_name',

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
                                        'placeholder'   =>  $this->_translate->translate( 'LAST_NAME' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  'label.first_name',
            'description'       =>  'description.first_name',

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

    protected function _getCompanyName ( ) {

        $name = 'company_name';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        'placeholder'   =>  $this->_translate->translate( 'COMPANY_NAME' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  'label.first_name',
            'description'       =>  'description.first_name',

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

    protected function _getUsername ( ) {

        $name = 'username';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        'placeholder'   =>  $this->_translate->translate( 'USERNAME' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  'LABEL.USERNAME',
            'description'       =>  'DESCRIPTION.USERNAME',

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        ['PregReplace', [
                                            'match' => '/[^A-Za-z0-9\-@._]+$/',
                                            'replace' => '']
                                        ],
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
                                        [ 'Regex', false, [
                                            'pattern' => '/[A-Za-z0-9\-@._]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ],
                                        ] ],
                                        [ 'Db_NoRecordExists', false, [
                                            'table'    => 'user',
                                            'field'    => 'username',
                                            'messages' => [
                                                Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND => "ERROR.USERNAME_UNAVAILABLE",
                                            ]
                                        ]
                                    ] ]

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
                                    'placeholder'       =>  $this->_translate->translate( 'PASSWORD' ),
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
                                            Tiger_Validate_Strength::PW_LENGTH    => "Must have at least %pw_length% characters.",
                                            Tiger_Validate_Strength::PW_UPPER     => "Must contain %pw_upper% uppercase.",
                                            Tiger_Validate_Strength::PW_LOWER     => "Must contain %pw_lower% lowercase.",
                                            Tiger_Validate_Strength::PW_DIGIT     => "Must contain %pw_digit% number(s).",
                                            Tiger_Validate_Strength::PW_SPECIAL   => "Must contain %pw_special% punctuation.",
                                            Tiger_Validate_Strength::PW_ILLEGAL   => "Cannot contain spaces.",
                                            Tiger_Validate_Strength::PW_REPEATING => "More than %pw_repeating% repeat characters.",
                                        ],
                                    ] ],
                                ],
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
                                    'placeholder'   =>  $this->_translate->translate( 'EMAIL' ),
                                    'data-valid'    => '0',
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

            'label'         =>  'form.signup.label.' . $name,
            'description'   =>  'form.signup.description.' . $name,

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    [ 'NotEmpty', false, [
                                        'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "Required." ]
                                    ] ],
                                    [ 'Regex', false, [
                                        'pattern'   => '/^[A-Za-z0-9_\-\.]+$/',
                                        'messages'  => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                    ] ],

                                ],
        );

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getReCaptcha ( ) {

        $options = array(

            'name'          =>  'recaptcha',

            'required'      =>  true,
            'validators'    =>  array(
                array( 'ReCaptcha', false ),
                array( 'NotEmpty', false, array(
                    'messages' => array( Zend_Validate_NotEmpty::IS_EMPTY => "Required." )
                )),

            ),
        );

        return new Zend_Form_Element_Textarea('recaptcha', $options);

    }

    protected function _getTerms ( ) {

        $name = 'terms';

        $options = [

           'name'              =>  $name,
           'id'                =>  $name,
           'class'             =>  'custom-control-input',

           'attribs'           =>  [
                                        'data-valid' => '0',
                                   ],

           'label'             =>  'LABEL.ACCEPT_TERMS',

           'checkedValue'      =>  '1',

           'required'          =>  true,

           'filters'           =>  [
                                        [ 'StringTrim' ],
                                   ],

           'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            Zend_Validate_NotEmpty::ALL,
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
