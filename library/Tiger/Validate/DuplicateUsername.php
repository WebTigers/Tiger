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

class Tiger_Validate_DuplicateUsername extends Zend_Validate_Abstract {
    
    const MSG_DUPLICATE_USERNAME = "duplicateUsername";
    
    protected $_translate;
    protected $_user_id;
    protected $_userModel;
    protected $_messageTemplates;
    
    public function __construct() {
        
        $this->_translate           =   Zend_Registry::get( 'Zend_Translate' ); 
        $this->_user_id             =   Zend_Auth::getInstance()->getIdentity()->user_id;
        $this->_userModel           =   new Application_Model_User;
        $this->_messageTemplates    =   array( self::MSG_DUPLICATE_USERNAME => 
                                            $this->_translate->_( 'validate.duplicateUsername.duplicateUsername' ) );
        
    }

    /**
     * Accepts a UUID/GUID string to validate. 
     * 
     * @param string $value
     * @return boolean 
     */
    public function isValid( $value, $context = null ) {

        $this->_setValue( $value );
        $isValid = true;
        
        if ( ! empty( $value ) && $this->_userModel->isDuplicateUsername( $this->_user_id, $value ) ) {

              $this->_error( self::MSG_DUPLICATE_USERNAME );
              $isValid = false;

        }

        return $isValid;

    }

}
