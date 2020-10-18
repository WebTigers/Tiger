<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Copyright Notice
 * ————————————————————————————————————————————————————————————————————————————————
 *
 *  Copyright © 2020 WebTigers
 *  All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains the property of WebTigers.
 * The intellectual and technical concepts contained herein are proprietary to
 * WebTigers and may be covered by U.S. and Foreign Patents, patents in process, and
 * are protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from WebTigers.
 *
 * See the LICENSE.txt for full licensing information governing the use of this
 * information and software.
 */

class Core_Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_config;

    protected function _initCore()
    {
        /** Bootstrap database and sessions. */
        $this->bootstrap(['db', 'session']);
    }

    protected function _initSessions()
    {
        /** Init Sessions. */
        Zend_Session::start();
        $session = new Zend_Session_Namespace('Tiger');
        Zend_Registry::set('Zend_Session', $session);
    }

    protected function _initCache()
    {
        /** Init Zend_Cache_Manager */
        if ( boolval( $this->getOptions()['tiger']['useCache'] ) === true ) {

            $frontEndOptions = [
                'lifetime' => 7200,
                'automatic_serialization' => true,
            ];

            $backEndOptions = [
                'server' => [
                    [
                        'host' => 'localhost',
                        'port' => 11211,
                        'weight' => 1,
                    ],
                ],
                'client' => [
                    Memcached::OPT_DISTRIBUTION => Memcached::DISTRIBUTION_CONSISTENT,
                    Memcached::OPT_HASH => Memcached::HASH_MD5,
                    Memcached::OPT_LIBKETAMA_COMPATIBLE => true,
                ]
            ];

            $cache = Zend_Cache::factory('Core', 'Libmemcached', $frontEndOptions, $backEndOptions);

        }
        else {

            $cache = null;

        }

        Zend_Registry::set('Zend_Cache', $cache);

    }

    protected function _initConfig ( )
    {
        /** Init Database Config Overrides. */
        /** Is Cache enabled? */
        if ( boolval( $this->getOptions()['tiger']['useCache'] ) === true ) {
            if ( ($this->_config = Zend_Registry::get('Zend_Cache')->load('Zend_Config') ) === false ) {
                $this->_loadConfigs();
            }
            else {
                /** Store the cached configs. */
                Zend_Registry::set('Zend_Config', $this->_config);
            }
        }
        /** If Cache is disabled ... */
        else {
            $this->_loadConfigs();
        }
    }

    protected function _loadConfigs ( ){

        $this->_config = new Zend_Config($this->getOptions(), true);
        $configModel = new Core_Model_Config;
        $configArray = $configModel->getConfigArray();
        $this->_config->merge(new Zend_Config($configArray));

        /** Merge the ACL file separately. */
        $filename = realpath(dirname(__FILE__) . '/configs') . '/acl.ini';
        $configOptions = new Zend_Config_Ini($filename, APPLICATION_ENV, ['allowModifications' => true]);
        $this->_config->merge($configOptions);
        Zend_Registry::set('Zend_Config', $this->_config);

    }

    protected function _initTranslations ( )
    {
        /** Init Core Translation */
        $translate = new Zend_Translate([
            'adapter' => Zend_Translate::AN_ARRAY,
            'content' => realpath(dirname(__FILE__) . '/languages'),
            'scan' => Zend_Translate::LOCALE_DIRECTORY,
            'locale' => LOCALE,
            // 'cache' => Zend_Registry::get('Zend_Cache'),
        ]);
        if ( boolval( $this->_config->tiger->useCache ) === true ) {
            $translate->setCache( Zend_Registry::get('Zend_Cache') );
        }
        Zend_Registry::set('Zend_Translate', $translate);
    }

    protected function _initTigerId ( )
    {
        /** Set a Guest User Id that tries to persist the same across all visits. */
        $guest_user_id = ( isset( $_COOKIE['TID'] ) )
            ? $_COOKIE['TID']
            : Tiger_Utility_Uuid::v1();
        setcookie('TID', $guest_user_id, time() + (3600 * 24 * 365));
        Zend_Registry::set('TID', $guest_user_id);
        defined('GUEST_USER_ID')
            || define('GUEST_USER_ID', $guest_user_id);

    }

}

