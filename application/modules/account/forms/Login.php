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

class Account_Form_Login extends Tiger_Form_Base
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

        $this->setName('Account_Form_Login');

        $this->addElement( $this->_getUsername() );
        $this->addElement( $this->_getPassword() );
        // $this->addElement( $this->_getReCaptcha() );
        $this->addElement( $this->_getRememberMe() );

    }

    ##### Form Fields #####

    protected function _getUsername ( ) {

        $name = 'username';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt no-validate',

            'attribs'           =>  [
                                        'placeholder'   =>  $this->_translate->translate( 'LOGIN.USERNAME_EMAIL' ),
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
                                    ]


        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getPassword ( ) {

        $name = 'password';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt no-validate',

            'attribs'       =>  [
                                    'placeholder'       =>  $this->_translate->translate( 'PASSWORD' ),
                                    'autocomplete'      => 'off',
                                ],

            'label'         =>  'LABEL.PASSWORD',

            'required'      =>  true,

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['NotEmpty', false, [
                                        'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                    ] ],
                                ],
        ];

        return new Zend_Form_Element_Password( $name, $options );

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

    protected function _getRememberMe ( ) {

        $name = 'remember_me';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'custom-control-input no-validate',

            'attribs'           =>  [
                                        'data-valid' => '0',
                                    ],

            'label'             =>  'LABEL.REMEMBER_ME',

            'checkedValue'      =>  '1',

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                    ],

            'validators'        =>  [
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
