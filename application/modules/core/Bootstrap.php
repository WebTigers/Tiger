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
    protected $_configModel;
    protected $_useCache;
    protected $_config;

    protected function _initCore ( )
    {
        /** Bootstrap database and sessions. */
        $this->bootstrap(['db', 'session']);
    }

    protected function _initSessions ( )
    {
        /** Init Sessions. */
        Zend_Session::start();
        $session = new Zend_Session_Namespace('Tiger');
        Zend_Registry::set('Zend_Session', $session);
    }

    protected function _initCoreConfigs ( )
    {
        /** Pulls in all of our application.ini configs */
        $this->_config = new Zend_Config($this->getOptions(), true);

        /** Return an array of only module.ini and acl.ini config files from the /configs folder */
        $configFiles = preg_grep('/(module|acl)\.(ini)/', scandir(realpath(dirname(__FILE__) . '/configs')));

        foreach ($configFiles as $configFile) {
            $filename = realpath(dirname(__FILE__) . '/configs') . '/' . $configFile;
            $configOptions = new Zend_Config_Ini($filename, APPLICATION_ENV, ['allowModifications' => true]);
            $this->_config->merge($configOptions);
        }

        Zend_Registry::set('Zend_Config', $this->_config);

    }

    protected function _initDBConfigs ( )
    {
        $this->_configModel = new Core_Model_Config();
        $configDBArray = $this->_configModel->getConfigArray();
        $zendDbConfigs = new Zend_Config( $configDBArray );
        Zend_Registry::set('Zend_DB_Config', $zendDbConfigs); // <-- this will get used in the ConfigCache plugin later.
        $this->_config->merge( $zendDbConfigs );
        Zend_Registry::set('Zend_Config', $this->_config);
    }

    protected function _initCache ( )
    {
        $this->_useCache = boolval( Zend_Registry::get('Zend_Config')->tiger->cache->useCache );

        /** Init Zend_Cache_Manager */
        if ( $this->_useCache === true ) {

            $frontEndOptions = new Zend_Cache_Core([
                'lifetime' => 7200,
                'automatic_serialization' => true,
            ]);

            $backEndOptions = new Tiger_Cache_Backend_Libmemcached([
                'server' => [
                    [
                        'host'      => $this->_config->tiger->cache->libmemcached->local->host,
                        'port'      => $this->_config->tiger->cache->libmemcached->local->port,
                        'weight'    => $this->_config->tiger->cache->libmemcached->local->weight,
                    ],
                ],
                'client' => [
                    Memcached::OPT_DISTRIBUTION => Memcached::DISTRIBUTION_CONSISTENT,
                    Memcached::OPT_HASH => Memcached::HASH_MD5,
                    Memcached::OPT_LIBKETAMA_COMPATIBLE => true,
                ]
            ]);

            if ( isset( $this->_config->tiger->cache->libmemcached ) ) {
                $cacheServers = $this->_config->tiger->cache->libmemcached;
                foreach ($cacheServers as $type => $server) {
                    if ( $type === 'local' ) { continue; } // Don't register the same local server twice.
                    $backEndOptions->addServer(
                        $server->host,
                        $server->port,
                        $server->weight
                    );
                }
            }

            $cache = Zend_Cache::factory( $frontEndOptions, $backEndOptions );

        }
        else {

            $cache = null;

        }

        Zend_Registry::set('Zend_Cache', $cache);

    }

    protected function _initCacheConfigs ( )
    {
        if ( $this->_useCache === true ) {
            if ( ($this->_config = Zend_Registry::get('Zend_Cache')->load('Zend_Config') ) !== false) {
                /** Store the cached configs. */
                Zend_Registry::set('Zend_Config', $this->_config);
            }
        }
    }

    protected function _initTranslations ( )
    {
        /** Init Core Translation */
        $translate = new Zend_Translate([
            'adapter' => Zend_Translate::AN_ARRAY,
            'content' => realpath(dirname(__FILE__) . '/languages'),
            'scan' => Zend_Translate::LOCALE_DIRECTORY,
            'locale' => LOCALE,
        ]);
        if ( $this->_useCache === true ) {
            $translate->setCache( Zend_Registry::get('Zend_Cache') );
        }
        Zend_Registry::set('Zend_Translate', $translate);
    }

    protected function _initTigerId ( )
    {
        /** Set a Guest User Id that tries to persist the same across all visits. */
        $guest_user_id = ( isset( $_COOKIE['TID'] ) && Tiger_Utility_Uuid::is_valid( $_COOKIE['TID'] )  )
            ? $_COOKIE['TID']
            : Tiger_Utility_Uuid::v1();
        setcookie('TID', $guest_user_id, time() + (3600 * 24 * 365));
        Zend_Registry::set('TID', $guest_user_id);
        defined('GUEST_USER_ID')
            || define('GUEST_USER_ID', $guest_user_id);

    }

}

