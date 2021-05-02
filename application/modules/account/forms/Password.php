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

class Account_Form_Password extends Tiger_Form_Base
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

        $this->setName('Account_Form_Password');

        $this->addElement( $this->_getPassword() );

    }

    ##### Form Fields #####

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

}
