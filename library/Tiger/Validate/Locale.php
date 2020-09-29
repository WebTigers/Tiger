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

class Tiger_Validate_Locale extends Zend_Validate_Abstract
{
    const MSG_LOCALE_NOT_FOUND = "badLocale";
    
    protected $_translate;
    
    public    $dictionary;

    protected $_messageTemplates = array(
        self::MSG_LOCALE_NOT_FOUND => "Invalid locale."
    );
    
    public function __construct() {
        
        $this->_translate = Zend_Registry::get( 'Zend_Translate' );
        
    }

    /**
     * Accepts a UUID/GUID string to validate. 
     * 
     * @param string $value
     * @return boolean 
     */
    public function isValid( $value, $context = null ) {

        // pr( array( $value, $context ) );
        
        $this->_setValue( $value );
        $isValid = true;
        
        
        if ( !in_array($value, $this->_translate->getList() ) ) {

            $this->_error( self::MSG_LOCALE_NOT_FOUND );
            $isValid = false;

        }

        return $isValid;

    }

}
