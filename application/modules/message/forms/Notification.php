<?php

class Message_Form_Notification extends Tiger_Form_Base
{

    public function init ( ) {

        parent::init();

    }

    /**
     * This method gets called automagically by the base class.
     * @throws Zend_Form_Exception
     */
    protected function _addFormElements ( ) {

        $this->setName('Message_Form_Notification');

        $this->addElement( $this->_getNotificationId() );
        $this->addElement( $this->_getUserId() );
        $this->addElement( $this->_getMessageId() );
        $this->addElement( $this->_getActive() );
        $this->addElement( $this->_getDeleted() );

    }

    ##### Form Fields #####

    protected function _getNotificationId ( ) {

        $name = 'notification_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'hide',
            'required'      =>  false,

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID" ]
                                    ] ],
                                ]
        ];

        return new Zend_Form_Element_Hidden( $name, $options );

    }

    protected function _getUserId ( ) {

        $name = 'user_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'hide',
            'required'      =>  false,

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID" ]
                                    ] ],
                                ]
        ];

        return new Zend_Form_Element_Hidden( $name, $options );

    }

    protected function _getMessageId ( ) {

        $name = 'message_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'hide',
            'required'      =>  false,

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID" ]
                                    ] ],
                                ]
        ];

        return new Zend_Form_Element_Hidden( $name, $options );

    }

    protected function _getActive ( ) {

        $name = 'active';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name . '_message',
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
            'id'                =>  $name . '_message',
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
