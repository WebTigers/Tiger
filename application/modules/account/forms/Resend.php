<?php

class Account_Form_Resend extends Tiger_Form_Base
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

        $this->setName('Account_Form_Resend');

        $this->addElement( $this->_getUserId() );

    }

    ##### Form Fields #####

    protected function _getUserId ( ) {

        $name = 'user_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'hide',
            'required'      =>  true,

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['NotEmpty', false, [
                                        'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                    ] ],
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID." ]
                                    ] ],
                                ]
        ];

        return new Zend_Form_Element_Hidden( $name, $options );

    }

}
