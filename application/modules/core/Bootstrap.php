<?php

class Core_Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_locale;
    protected $_translate;

    protected function _initCore()
    {
        /** Bootstrap database and sessions. */
        $this->bootstrap( ['db', 'session'] );


        /** Init Sessions. */
        Zend_Session::start();
        $session = new Zend_Session_Namespace( 'Tiger' );
        Zend_Registry::set( 'Session', $session );

        /** Init Database Config Overrides. */
        $config = new Zend_Config( $this->getOptions(), true );
        $configModel = new Core_Model_Config;
        $configArray = $configModel->getConfigArray();
        $config->merge( new Zend_Config( $configArray ) );
        Zend_Registry::set( 'Config', $config );

        /** AWS Access Keys */
        defined('AWS_ACCESS_KEY_ID')
            || define('AWS_ACCESS_KEY_ID', $config->aws->key);

        defined('AWS_SECRET_ACCESS_KEY')
            || define('AWS_SECRET_ACCESS_KEY', $config->aws->secret);


    }

}

