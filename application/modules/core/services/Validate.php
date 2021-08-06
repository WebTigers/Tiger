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

/**
 * Class Core_Service_Validate
 */
final class Core_Service_Validate extends Core_Service_Webservice {

    protected $_translate;

    public function __construct( $input ) {

        $this->_translate = Zend_Registry::get('Zend_Translate');

        parent::__construct( $input );

    }

    /**
     * Validate Field
     * 
     * @param array $params
     * @return object ResponseObject 
     */
    public function element ( Array $params ) {
        
        $element = $this->_form->getElement( $params['element'] );

        if ( $element instanceof Zend_Form_Element ) {

            /** Some fields need to be unique within the DB. However, if the user or admin is editing a field, we need to */

            if ( $element->getName() === 'username' ){
                $element->getValidator('Db_NoRecordExists')->setExclude( [ 'field' => 'user_id', 'value' => $params['context'] ] );
            }
            elseif ( $element->getName() === 'email' ){
                $element->getValidator('Db_NoRecordExists')->setExclude( [ 'field' => 'user_id', 'value' => $params['context'] ] );
            }
            elseif ( $element->getName() === 'orgname' ){
                $element->getValidator('Db_NoRecordExists')->setExclude( [ 'field' => 'org_id', 'value' => $params['context'] ] );
            }
            elseif ( $element->getName() === 'referral_code' ){
                $field = ( $this->_form->getName() === 'Account_Form_Org' ) ? 'org_id' : 'user_id';
                $element->getValidator('Db_NoRecordExists')->setExclude( [ 'field' => $field, 'value' => $params['context'] ] );
            }

            if ($element->isValid($params['value'], $params)) {

                // Sends an empty response
                $this->_response->result = 1;
                $this->_response->form = $this->_form->getName();
                $this->_response->element = $params['element'];
                $this->_response->messages = [];


            } else {

                // Invalid Entry //

                $this->_setElementMessages($element);

                $this->_response->result = 0;
                $this->_response->form = $this->_form->getName();
                $this->_response->element = $params['element'];

            }

        }
        
    }

    /**
     *
     * @param Zend_Form_Element $element
     * @return \Core_Model_MessageObject
     */
    protected function _setElementMessages ( Zend_Form_Element $element ) {

        $messages = $element->getMessages();

        foreach ( $messages as $error => $message ) {

            $this->_response->messages[] = new Core_Model_MessageObject( $message, 'error', $error );

        }

    }

}
