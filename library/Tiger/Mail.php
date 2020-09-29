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

class Tiger_Mail extends Zend_Mail {

    public function __construct ( ) {
        
        parent::__construct();
        
        $config = Zend_Registry::get('Zend_Config');
        
        $params = array(
            
            'auth'      => 'login',
            'ssl'       => 'tls',
            'username'  => $config->mailsystem->smtp->username, // mailsystem.smtp.server
            'password'  => $config->mailsystem->smtp->password,
            
        );
        
        $server    = $config->mailsystem->smtp->server;
        $transport = new Zend_Mail_Transport_Smtp( $server , $params );
        
        self::setDefaultTransport( $transport );
        
    }
    
}
