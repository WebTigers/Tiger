<?php

class Default_Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected function _initTiger()
    {

        /** First we bootstrap our db and session */
        $this->bootstrap( ['db', 'session'] );


        /** Start the Session */
        Zend_Session::start();
        $session = new Zend_Session_Namespace( 'Default' );
        Zend_Registry::set( 'Session', $session );


        /** Add Database Config Overrides */
        $config = new Zend_Config( $this->getOptions(), true );
        $configModel = new Default_Model_Config;
        $configArray = $configModel->getConfigArray();
        $config->merge( new Zend_Config( $configArray ) );
        Zend_Registry::set( 'Config', $config );


    }

}

