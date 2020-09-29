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

class Tiger_Controller_Plugin_Routes extends Zend_Controller_Plugin_Abstract
{
    /**
     * The Routes Plugin is responsible for collecting and setting the
     * various router routes.
     *
     * @param Zend_Controller_Request_Abstract $request
     * @throws Zend_Exception
     */
    public function routeStartup(Zend_Controller_Request_Abstract $request)
    {

        $config = Zend_Registry::get('Zend_Config');
        $router = Zend_Controller_Front::getInstance()->getRouter();
        $router->removeDefaultRoutes();
        $router->addConfig($config, 'routes');
        Zend_Registry::set( 'Zend_Router', $router );

    }

}