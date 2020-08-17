<?php

class Core_Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_locale;
    protected $_translate;

    protected function _initCore()
    {
        /** First we bootstrap our db and session ... */
        $this->bootstrap( ['db', 'session'] );


        /** Start the Session ... */
        Zend_Session::start();
        $session = new Zend_Session_Namespace( 'Tiger' );
        Zend_Registry::set( 'Session', $session );


        /** Then init any Database Config Overrides. */
        $config = new Zend_Config( $this->getOptions(), true );
        $configModel = new Core_Model_Config;
        $configArray = $configModel->getConfigArray();
        $config->merge( new Zend_Config( $configArray ) );
        Zend_Registry::set( 'Config', $config );

    }

}

