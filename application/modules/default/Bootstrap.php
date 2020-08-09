<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected $_config;

    protected function _initModules ( ) {

    }

    /**
     * This initConfig() initializes our base configuration to the database and then pulls
     * in any db config overrides from the config table. We then stuff the config into the
     * Zend Registry for global access to configs anywhere within Tiger.
     *
     * @throws Zend_Config_Exception
     * @throws Zend_Db_Exception
     */
    protected function _initConfig() {

        /**
         * The bootstrap already contains all of the options from the application.ini,
         * so we just need to grab them and stuff them into a Zend_Config instance.
         */
        $this->_config = new Zend_Config( $this->getOptions(), true );

        /**
         * Now let's grab all of the super sensitive configs from the tiger-restricted.ini
         * that lives in the /var/www/tiger-config dir and merge them with the $_config property.
         * This static restricted.ini keeps the sensitive password data out of our source control.
        */
        $restrictedConfig = new Zend_Config_Ini( TIGER_CONFIG_PATH . '/tiger-restricted.ini', APPLICATION_ENV );
        $this->_config->merge( $restrictedConfig );

        /** Make our default connection to the database */
        $db = Zend_Db::factory( $this->_config->resources->db );
        Zend_Db_Table_Abstract::setDefaultAdapter( $db );

        /**  Grab our config overrides from the database */
        $configModel = new Default_Model_Config();
        $configArray = $configModel->getConfigArray();
        $this->_config->merge( new Zend_Config( $configArray ) );

        /**
         * Finally set the configuration object into the Zend Registry for easy global access.
         * anywhere within Tiger.
         */
        Zend_Registry::set( 'Zend_Config', $this->_config );

    }

}

