<?php

class Core_Model_MessageObject {

    public $message;
    public $error;
    public $class;
    
    public function __construct( $message, $class = 'alert', $error = null ) {
        
        $this->message      = Zend_Registry::get( 'Zend_Translate' )->translate( $message );
        $this->class        = $class;
        $this->error        = $error;
        
    }
    
}
