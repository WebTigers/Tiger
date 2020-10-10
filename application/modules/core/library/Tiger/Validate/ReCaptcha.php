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

class Tiger_Validate_ReCaptcha extends Zend_Validate_Abstract {
    
    const MSG_YOU_APPEAR_TO_BE_A_ROBOT = "youappeartobearobot";
    
    protected $_config;
    protected $_translate;
    protected $_ip;
    protected $_user;
    protected $_post;
    protected $_messageTemplates;
    
    public function __construct() {
        
        $this->_config              =   Zend_Registry::get( 'Zend_Config' ); 
        $this->_translate           =   Zend_Registry::get( 'Zend_Translate' ); 
        $this->_ip                  =   $_SERVER['REMOTE_ADDR'];
        $this->_post                =   Zend_Controller_Front::getInstance()->getRequest()->getParams();
        $this->_messageTemplates    =   array( self::MSG_YOU_APPEAR_TO_BE_A_ROBOT => 
                                            $this->_translate->_( 'validate.recaptcha.youappeartobearobot' ) );
        
    }

    /**
     * Accepts a reCaptcha string to validate. 
     * 
     * @param string $value
     * @return boolean
     */
    public function isValid( $value, $context = null ) {

        $ip = $this->_ip;
        
        $this->_setValue( $value );
        $isValid = true;
        
        if ( ! empty( $value ) && ! $this->_checkReCaptcha( $value, $ip ) ) {

            $this->_error( self::MSG_YOU_APPEAR_TO_BE_A_ROBOT );
            $isValid = false;
              
        }

        return $isValid;

    }
    
    private function _checkReCaptcha ( $value, $ip ) {
        
        $recaptcha = new \ReCaptcha\ReCaptcha( $this->_config->recaptcha->secretkey );

        $captchaResponse = $recaptcha->verify( $value , $ip );

        return ( $captchaResponse->isSuccess() );

    }

}
