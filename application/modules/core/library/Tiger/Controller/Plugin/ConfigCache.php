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

class Tiger_Controller_Plugin_ConfigCache extends Zend_Controller_Plugin_Abstract
{
    public function routeStartup(Zend_Controller_Request_Abstract $request) {

        /** By routeShutdown we should have loaded all of the modules' and DB configs. */
        if ( boolval( Zend_Registry::get('Zend_Config')->tiger->cache->useCache ) === true ) {

            if ( ($config = Zend_Registry::get('Zend_Cache')->load('Zend_Config') ) === false ) {
                $config = Zend_Registry::get('Zend_Config');
                $config->merge( Zend_Registry::get('Zend_DB_Config') );
                Zend_Registry::get('Zend_Cache')->save($config, 'Zend_Config');
            }

        }

    }

}
