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
        Zend_Registry::set( 'Zend_Session', $session );


        /** Init Database Config Overrides. */
        $config = new Zend_Config( $this->getOptions(), true );
        $configModel = new Core_Model_Config;
        $configArray = $configModel->getConfigArray();
        $config->merge( new Zend_Config( $configArray ) );
        Zend_Registry::set( 'Zend_Config', $config );


        /** Theme Namespace Autoloading */
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('Oneui');

        /** Set a Guest User Id that tries to persist the same across all visits. */
        $guest_user_id = ( isset( $_COOKIE['TID'] ) )
            ? $_COOKIE['TID']
            : Tiger_Utility_Uuid::v1();
        setcookie('TID', $guest_user_id, time() + (3600 * 24 * 365));
        Zend_Registry::set('TID', $guest_user_id);
        defined('GUEST_USER_ID')
            || define('GUEST_USER_ID', $guest_user_id);


        /**
         * AWS General Access Keys
         * These constants will be automagically recognized by the
         * AWS SDK. It is best to create keys that only have access
         * to the resources you application needs.
         */

        defined('AWS_ACCESS_KEY_ID')
            || define('AWS_ACCESS_KEY_ID', $config->aws->key);

        defined('AWS_SECRET_ACCESS_KEY')
            || define('AWS_SECRET_ACCESS_KEY', $config->aws->secret);

        /**
         * If you need to get more granular with your access keys
         * you can use the following constants to grant your code
         * access to AWS resources, but you will need to set these
         * keys manually within your code.
         */

        /** AWS S3 (Simple Storage Service) Access Keys */
        defined('AWS_S3_ACCESS_KEY_ID')
        || define('AWS_S3_ACCESS_KEY_ID', $config->aws->s3->key);

        defined('AWS_S3_SECRET_ACCESS_KEY')
        || define('AWS_s3_SECRET_ACCESS_KEY', $config->aws->s3->secret);

        /** AWS SES (Simple Email Service) Access Keys */
        defined('AWS_SES_ACCESS_KEY_ID')
        || define('AWS_SES_ACCESS_KEY_ID', $config->aws->ses->key);

        defined('AWS_SES_SECRET_ACCESS_KEY')
        || define('AWS_SES_SECRET_ACCESS_KEY', $config->aws->ses->secret);

    }

}

