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

class Account_Form_Org extends Tiger_Form_Base
{

    public function init ( ) {

        parent::init();

    }

    /**
     * This method gets called automagically by the base class.
     * @throws Zend_Form_Exception
     */
    protected function _addFormElements ( ) {

        $this->setName('Account_Form_Org');

        $this->addElement( $this->_getOrgId() );
        $this->addElement( $this->_getParentOrgId() );
        $this->addElement( $this->_getOrgname() );
        $this->addElement( $this->_getOrgDisplayName() );
        $this->addElement( $this->_getDescription() );
        $this->addElement( $this->_getCompanyName() );
        $this->addElement( $this->_getDomain() );
        $this->addElement( $this->_getReferralCode() );
        $this->addElement( $this->_getTypeOrg() );
        $this->addElement( $this->_getTypeHearabout() );
        $this->addElement( $this->_getTypeBusiness() );
        $this->addElement( $this->_getReferralOrgId() );
        $this->addElement( $this->_getReferralUserId() );
        $this->addElement( $this->_getActive() );
        $this->addElement( $this->_getDeleted() );

    }

    ##### Form Fields #####

    protected function _getOrgId ( ) {

        $name = 'org_id';

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
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID." ]
                                    ] ],
                                ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getParentOrgId ( ) {

        $name = 'parent_org_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID." ]
                                    ] ],
                                ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getOrgname ( ) {

        $name = 'orgname';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
                                        [ 'StringLength', false, [
                                            'min'   => 1,
                                            'max'   => 25,
                                            'messages' => [
                                                Zend_Validate_StringLength::TOO_SHORT => "ERROR.TOO_SHORT",
                                                Zend_Validate_StringLength::TOO_LONG => "ERROR.TOO_LONG",
                                            ]
                                        ] ],
                                        [ 'Db_NoRecordExists', false, [
                                            'table'    => 'org',
                                            'field'    => 'orgname',
                                            'messages' => [
                                                Zend_Validate_Db_NoRecordExists::ERROR_RECORD_FOUND => "ERROR.ORGNAME_EXISTS",
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

    protected function _getOrgDisplayName ( ) {

        $name = 'org_display_name';

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
                                            'max'   => 255,
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
                                            'max'   => 255,
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

    protected function _getDescription ( ) {

        $name = 'org_description';

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
                                            'max'   => 255,
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

    protected function _getDomain ( ) {

        $name = 'domain';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9\_.]/',
                                            'replace' => ''
                                        ] ]
                                    ],

            'validators'        =>  [
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

    protected function _getReferralCode ( ) {

        $name = 'referral_code';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.PRIVILEGE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'          =>  false,

            'filters'           =>  [
                                        [ 'StringTrim' ],
                                        [ 'PregReplace', [
                                            'match' => '/[^A-Za-z0-9\_\-.]/',
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
                                            'pattern' => '/^[A-Za-z0-9\_\-.]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getTypeOrg ( ) {

        $name = 'type_org';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

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

        return new Zend_Form_Element_Text( $name, $options );

    }

    protected function _getTypeHearAbout ( ) {

        $name = 'type_hearabout';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'label'         =>  strtoupper( 'LABEL.' . $name ),
            'description'   =>  strtoupper( 'DESCRIPTION.' . $name ),

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
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getTypeBusiness ( ) {

        $name = 'type_business';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        // 'placeholder'   =>  $this->_translate->translate( 'PLACEHOLDER.RESOURCE' ),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

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

        return new Zend_Form_Element_Text( $name, $options );

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

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID." ]
                                    ] ],

                                ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

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

            'multiOptions'              =>  [],     // Set vis Select2 Control
            'registerInArrayValidator'  => false,

            'label'             =>  strtoupper( 'LABEL.' . $name ),
            'description'       =>  strtoupper( 'DESCRIPTION.' . $name ),

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            'validators'    =>  [
                                    ['Uuid', false, [
                                        'messages' => [ Tiger_Validate_Uuid::MSG_INVALID_UUID => "ERROR.INVALID_ID." ]
                                    ] ],

                                ],
        ];

        return new Zend_Form_Element_Select( $name, $options );

    }

    protected function _getActive ( ) {

        $name = 'active';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name . '_org',
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
            'id'                =>  $name . '_org',
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

}
