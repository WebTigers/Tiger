<?php

abstract class Tiger_Controller_Action extends Zend_Controller_Action {

    public $_config;
    public $_translate;

    public function init ( ) {
        
        parent::init();
        
        // $this->_config          = Zend_Registry::get( 'Config' );
        // $this->_translate       = Zend_Registry::get( 'Zend_Translate' );

    }
    
    /**
     * 
     */
    public function preDispatch ( ) {
        
        parent::preDispatch();

        /** Allows us to do stuff within the predispatch phase. */

    }

    /**
     * 
     */
    public function postDispatch ( ) {
        
        parent::postDispatch();

        /** Allows us to do stuff within the postdispatch phase. */


    }

    /**
     * This stubbed out function is just to let you know that you can create functions that are globablly
     * available to your application just by creating controllers that extend this Tiger_Controller_Action.
     */
    public function globalSomething ( )
    {
        // $request            = $this->getRequest();
        // $frontController    = $this->getFrontController();
    }

}
