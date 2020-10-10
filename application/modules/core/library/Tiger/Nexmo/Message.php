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

class Tiger_Nexmo_Message {
    
    protected $_config;
            
    private $_key;
    private $_secret;
    private $_from;

    public function __construct() {
        
        $this->_config = Zend_Registry::get('Zend_Config');
        
        $this->_key     = $this->_config->Nexmo->key;
        $this->_secret  = $this->_config->Nexmo->secret;
        $this->_from    = $this->_config->Nexmo->from;
    
    }
    
    public function sendMessage ( $to, $message ) {
        
        $url = 'https://rest.nexmo.com/sms/json?' . http_build_query([
                    'api_key' => $this->_key,
                    'api_secret' => $this->_secret,
                    'to' => $to,
                    'from' => $this->_from,
                    'text' => $message
        ]);
        
        // pr( $url );

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true) ;
        $response = curl_exec( $ch );
        
        return $response;
        
    }
    
}
