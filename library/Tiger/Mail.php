<?php

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
        
        // pr( $config->mailsystem );
        
        $server    = $config->mailsystem->smtp->server;
        $transport = new Zend_Mail_Transport_Smtp( $server , $params );
        
        self::setDefaultTransport( $transport );
        
    }
    
}
