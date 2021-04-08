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

trait Core_Service_CacheTrait
{

    ### Public Admin Service Functions ###

    public function clearcache ( $params ) {

        if ( boolval( Zend_Registry::get('Zend_Config')->tiger->cache->useCache ) === true ) {

            Zend_Registry::get('Zend_Cache')->clean( Zend_Cache::CLEANING_MODE_ALL );

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 1;
            $this->_response->setTextMessage( 'MESSAGE.CACHE_CLEARED', 'success' );

        }
        else {

            /**
             * Populate the responseObject with our success.
             */
            $this->_response->result = 0;
            $this->_response->setTextMessage( 'MESSAGE.CACHE_NOT_ENABLED', 'alert' );

        }

    }

    /**
     * Sets the DB useCache param override.
     * @param $params
     */
    public function useCache ( $params ) {

        try {

            /** First see if the config key tiger.cache.useCache exists */
            $configRow = $this->_configModel->getAdminConfigByKey('tiger.cache.useCache');

            if (!empty($configRow)) {

                if (intval($params['active']) === 1) {
                    $configRow->value = 1;
                    $configRow->active = 1;
                    $configRow->deleted = 0;
                } else {
                    $configRow->value = 0;
                    $configRow->active = 1;
                    $configRow->deleted = 0;
                }

            } else {

                /** If the DB record doesn't exist, create it. */
                $configRow = $this->_configModel->createRow([
                    'config_id' => Tiger_Utility_Uuid::v1(),
                    'key' => 'tiger.cache.useCache',
                    'value' => $params['active'],
                    'active' => 1,
                    'deleted' => 0
                ]);

            }

            $configRow->saveRow();

            $this->_response->result = 1;
            $this->_response->setTextMessage('MESSAGE.CACHE_UPDATED', 'success');

        }
        catch ( Error | Exception $e ) {

            $this->_response->result = 0;
            $this->_response->setTextMessage('MESSAGE.CACHE_ERROR', 'error');

        }

    }

    /**
     * getCacheServerTextList is usually called by a controller action
     * to return a static text list of cache servers in use. It is for
     * informational purposes only.
     *
     * @return string
     * @throws Zend_Exception
     */
    public function getCacheServerTextList ( )
    {
        $list = '';
        if ( boolval( Zend_Registry::get('Zend_Config')->tiger->cache->useCache ) === true ) {
            $servers = Zend_Registry::get('Zend_Cache')->getBackend()->getServerList();
            foreach ($servers as $server) {
                $list .= $server['host'] . ' | ' . $server['port'] . ' | ' . $server['type'] . PHP_EOL;
            }
        }
        return $list;
    }



}