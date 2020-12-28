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

class Doc_Form_Doc extends Tiger_Form_Base
{

    public function init()
    {

        parent::init();
        
        $this->setAction('/ajax')->
                setMethod('post')->
                setName('Doc_Form_Doc')->
                setAttrib('id', 'doc-form')->
                setAttrib('class', 'form-horizontal');
    }

    /**
     * This method gets called automagically by the base class.
     * @throws Zend_Form_Exception
     */
    protected function _addFormElements()
    {

        $this->setName('Doc_Form_Doc');

        $this->addElement($this->_getDocId());
        $this->addElement($this->_getTitle());
        $this->addElement($this->_getParentDoc());
        $this->addElement($this->_getDescription());
        $this->addElement($this->_getActive());
        $this->addElement($this->_getDeleted());
    }

    ##### Form Fields #####
    
    protected function _getDocId()
    {

        $name = 'doc_id';

        $options = [

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'hide',
            'required'      =>  false,

            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false]
                                    ]
        ];

        return new Zend_Form_Element_Hidden($name, $options);
    }

    protected function _getTitle()
    {

        $name = 'title';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',

            'attribs'           =>  [
                                        'placeholder'   =>  $this->_translate->translate('TITLE'),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  'label.title',
            'description'       =>  'description.title',

            'required'          =>  true,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false],
                                        [ 'Regex', false, [
                                            'pattern' => '/^[A-Za-z0-9 \'\-,.]+$/',
                                            'messages' => [ Zend_Validate_Regex::NOT_MATCH => "ERROR.INVALID_CHARACTERS" ]
                                        ] ]
                                    ]
        ];

        return new Zend_Form_Element_Text($name, $options);
    }

    protected function _getDescription()
    {

        $name = 'description';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name,
            'class'             =>  'form-control form-control-lg form-control-alt',
            'cols'              => 40,
            'rows'              =>7,
            'attribs'           =>  [
                                        'placeholder'   =>  $this->_translate->translate('DESCRIPTION'),
                                        'data-valid'    => '0',
                                    ],

            'label'             =>  'label.desc',
            'description'       =>  'description.desc',

            'required'          =>  true,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],

            'validators'        =>  [
                                        [ 'NotEmpty', false, [
                                            'messages' => [ Zend_Validate_NotEmpty::IS_EMPTY => "ERROR.REQUIRED" ]
                                        ] ],
                                        [ 'StringLength', false]
                                        
                                    ]
        ];

        return new Zend_Form_Element_Textarea($name, $options);
    }

    protected function _getParentDoc()
    {
        $model = new Doc_Model_Doc();
        $docTreeSelect = $model->getDocTreeForSelectElement();

        /** Add an empty "Please Select' to the top of the list. */
        //array_unshift($docTreeSelect, $this->_translate->translate('SELECT.PLEASE_SELECT'));

        $name = 'parent_id';

        $options = array(

            'name'          =>  $name,
            'id'            =>  $name,
            'class'         =>  'form-control form-control-lg form-control-alt select2',
            'attribs'       =>  [
                                    'data-valid' => '0',
                                ],

            'multiOptions'  =>  $docTreeSelect,

            'label'         =>  'form.doc.label.' . $name,
            'description'   =>  'form.doc.description.' . $name,

            'required'      =>  false,
            'filters'       =>  [
                                    [ 'StringTrim' ],
                                ],
            
            'validators'    =>  [
                                    
                                ],
        );

        return new Zend_Form_Element_Select($name, $options);
    }

    protected function _getActive ( ) {

        $name = 'active';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name . '_doc',
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
                                    ]
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }

    protected function _getDeleted ( ) {

        $name = 'deleted';

        $options = [

            'name'              =>  $name,
            'id'                =>  $name . '_doc',
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
                                    ]
        ];

        return new Zend_Form_Element_Checkbox( $name, $options );

    }
}
