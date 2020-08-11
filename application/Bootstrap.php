<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected $_config;

    /** AutoInit resource Modules */
    protected function _initModules ( ) {

    }

    /** AutoInit resource Database */
//    protected function _initDb ( ) {
//
//    }

    protected function _initConfig ( ) {

        /**
         * The bootstrap already contains all of the options from the application.ini,
         * so we just need to grab them and stuff them into a Zend_Config instance.
         */
        $this->_config = new Zend_Config( $this->getOptions(), true );

        /**  Grab our config overrides from the database */
        $configModel = new Default_Model_Config();
        $configArray = $configModel->getConfigArray();
        $this->_config->merge( new Zend_Config( $configArray ) );

        /**
         * Finally set the configuration object into the Zend Registry for easy global access.
         * anywhere within Tiger.
         */
        Zend_Registry::set( 'Tiger_Config', $this->_config );

    }

    /** AutoInit resource Sessions */
//    protected function _initSession ( ) {
//
//        Zend_Session::setSaveHandler( new Zend_Session_SaveHandler_DbTable( $this->_config ) );
//
////        $session = new Zend_Session_Namespace( 'Default' );
////        $session->setExpirationSeconds( $this->_config->account->login->timeout );
////
////        Zend_Registry::set( 'Zend_Session', $session );
//        Zend_Session::start();
//    }

}

