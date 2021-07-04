<?php

class Message_Form_Message extends Tiger_Form_Base
{

    public function init ( ) {

        parent::init();

    }

    /**
     * This method gets called automagically by the base class.
     * @throws Zend_Form_Exception
     */
    protected function _addFormElements ( ) {

        $this->setName('Message_Form_Message');

        $this->addElement( $this->_getMessageId() );
        $this->addElement( $this->_getTitle() );
        $this->addElement( $this->_getMessage() );
        $this->addElement( $this->_getFormat() );
        $this->addElement( $this->_getIconCss() );
        $this->addElement( $this->_getDismissible() );
        $this->addElement( $this->_getSendUsers() );
        $this->addElement( $this->_getSendRoles() );
        $this->addElement( $this->_getSendOrgs() );
        $this->addElement( $this->_getTypeStatus() );
        $this->addElement( $this->_getTarget() );
        $this->addElement( $this->_getLocale() );
        $this->addElement( $this->_getStartDate() );
        $this->addElement( $this->_getEndDate() );
        $this->addElement( $this->_getRoute() );
        $this->addElement( $this->_getActive() );
        $this->addElement( $this->_getDeleted() );

    }

    ##### Form Fields #####

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

    protected function _getTitle ( ) {

        $name = 'title';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'required'          =>  false,

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

    protected function _getMessage ( ) {

        $name = 'message';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                'data-valid' => '1',
                'rows' => '3',
            ],

            'value'         => 'Start typing here ... Select text to edit.',

            'label'         =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                [ 'StringTrim' ],
                [ 'PregReplace', ['match' => '/[^\W\w\S\s]/mu', 'replace' => '']],
            ],
            'validators'    =>  [
                // [ 'StringLength', false, [1, 10000) ],
                [ 'Regex', false, [
                    'pattern' => '/^[\W\w\S\s]+$/mu',
                    'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                ]],
            ],
        ];

        return new Zend_Form_Element_Textarea( $name, $options );

    }

    protected function _getFormat ( ) {

        $name = 'format';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt select2',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.PRIVILEGE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'registerInArrayValidator'  => true,
            'multiOptions'      =>  $this->getFormatOptions(),

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z]/',
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
                                            'pattern' => '/^[A-Za-z]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getIconCss ( ) {

        $name = 'icon_css';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt select2',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.PRIVILEGE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^a-z \-]/',
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
                                            'pattern' => '/^[a-z \-]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Hidden( $name, $options );

    }

    protected function _getDismissible ( ) {

        $name = 'dismissible';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'custom-control-input',

            'attribs'           =>  [
                                        'data-valid' => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'disableHidden'     =>  true,

            'required'          =>  false,

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

    protected function _getSendUsers ( ) {

        $name = 'send_users';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '1',
                                    'multiple'   => 'multiple',
                                ],

            'label'         =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                    [ 'PregReplace', ['match' => '/[^\W\w\S\s]/mu', 'replace' => '']],
                                ],
            'validators'    =>  [
                                [ 'Regex', false, [
                                    'pattern' => '/^[\W\w\S\s]+$/mu',
                                    'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                ]],
            ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getSendRoles ( ) {

        $name = 'send_roles';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '1',
                                    'multiple'   => 'multiple',
                                ],

            'label'         =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'required'      =>  false,
            'filters'       =>  [
                [ 'StringTrim' ],
                [ 'PregReplace', ['match' => '/[^\W\w\S\s]/mu', 'replace' => '']],
            ],
            'validators'    =>  [
                // [ 'StringLength', false, [1, 10000) ],
                [ 'Regex', false, [
                    'pattern' => '/^[\W\w\S\s]+$/mu',
                    'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                ]],
            ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getSendOrgs ( ) {

        $name = 'send_orgs';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '1',
                                    'multiple'   => 'multiple',
                                ],

            'label'         =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                    [ 'PregReplace', [
                                        'match' => '/[^\W\w\S\s]/mu', 'replace' => '']
                                    ],
                                ],
            'validators'    =>  [
                                    [ 'Regex', false, [
                                        'pattern' => '/^[\W\w\S\s]+$/mu',
                                        'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getTypeStatus ( ) {

        $typeModel = new Core_Model_Type();
        $multiOptions = $typeModel->getTypeListByReference('message', null, true);

        $name = 'type_status';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt select2',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'registerInArrayValidator'  => true,
            'multiOptions'      =>  $multiOptions,

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9_]/',
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
                                            'pattern' => '/^[A-Za-z0-9_]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getTarget ( ) {

        $name = 'target';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt select2',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.PRIVILEGE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'registerInArrayValidator'  => true,
            'multiOptions'      =>  $this->getTargetOptions(),

            'required'          =>  true,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z\:]/',
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
                                            'pattern' => '/^[A-Za-z\:]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getLocale ( ) {

        $multiOptions = Zend_Registry::get('Zend_Translate')->getList();

        $name = 'locale';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                'data-valid'    => '1',
            ],

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

            'registerInArrayValidator'  => true,
            'multiOptions'  =>  $multiOptions,

            'required'      =>  false,
            'filters'       =>  [
                                    ['PregReplace', ['match' => '/[^A-Za-z\_]/', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    ['Regex', false, [
                                        'pattern' => '/^[A-Za-z\_]+$/',
                                        'messages' => [Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
            ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getStartDate( ) {

        $name = 'start_date';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt datetimepicker-input',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'        => '0',
                                        'data-target'       => '#datetimepickerstart'
                                    ],

            'label'             =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^0-9 \-\:]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[0-9 \-\:]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ],
                                        [ 'Date', false, [
                                            'format' => 'yyyy-MM-dd HH:mm',  // 2016-01-10 00:00:00
                                            'locale' => 'en_US'
                                        ] ],
            ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getEndDate( ) {

        $name = 'end_date';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'    => '0',
                                        'data-target'   => '#datetimepickerend'
                                    ],

            'label'             =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^0-9 \-\:]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[0-9 \-\:]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ],
                                        [ 'Date', false, [
                                            'format' => 'yyyy-MM-dd HH:mm',  // 2016-01-10 00:00:00
                                            'locale' => 'en_US'
                                        ] ],
            ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getRoute ( ) {

        $name = 'route';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control text',
            'attribs'       =>  [
                                    'data-valid' => '1',
                                    'rows' => '3',
                                ],

            'value'         => '',

            'label'         =>  strtoupper( 'LABEL.MESSAGE_' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.MESSAGE_' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                    [ 'PregReplace', ['match' => '/[^\W\w\S\s]/mu', 'replace' => '']],
                                ],
            'validators'    =>  [
                                    [ 'Regex', false, [
                                        'pattern' => '/^[\W\w\S\s]+$/mu',
                                        'messages' => [ Zend_Validate_Regex::NOT_MATCH => "Invalid characters."]
                                    ]],
                                ],
        ];

        return new Zend_Form_Element_Textarea( $name, $options );

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

    ##### Utility Methods #####

    public function getTargetOptions(){

        $targets = $this->_config->message->targets;

        $out = ['' => $this->_translate->translate( 'SELECT' ) ];
        foreach ( $targets as $target ) {
            $out[ $target->value ] = $this->_translate->translate( $target->label );
        }

        return $out;

    }

    public function getFormatOptions(){

        $formats = $this->_config->message->formats;

        $out = ['' => $this->_translate->translate( 'SELECT' ) ];
        foreach ( $formats as $key => $value ) {
            $out[ $key ] = $this->_translate->translate( $value );
        }

        return $out;

    }


}
