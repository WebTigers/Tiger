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

class Tiger_Controller_Plugin_Layout extends Zend_Controller_Plugin_Abstract
{
    /**
     * This function is called once after router shutdown. It automagically
     * sets the layout for the default or module-specific layout.
     *
     * @param Zend_Controller_Request_Abstract $request
     */
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {

        $MVC    = Zend_Layout::getMvcInstance();
        $module = strtolower($request->getModuleName());

        $view = $MVC->getView();
        
        $layoutPath = MODULES_PATH . '/' . $module . '/layouts/scripts/';
        $viewPath   = MODULES_PATH . '/' . $module . '/views/';

        $MVC->setLayoutPath( $layoutPath );
        $view->setBasePath( $viewPath );

    }

}