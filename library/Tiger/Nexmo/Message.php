<?php

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
