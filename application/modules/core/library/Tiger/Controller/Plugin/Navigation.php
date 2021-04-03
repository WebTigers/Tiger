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

class Tiger_Controller_Plugin_Navigation extends Zend_Controller_Plugin_Abstract
{
    /**
     * This function is called once after router shutdown. It automagically
     * sets our view with any navigation items from the various module configs.
     * We could do this in each of the bootstraps, but it's cleaner to just do
     * it once here.
     *
     * @param Zend_Controller_Request_Abstract $request
     */
    public function routeShutdown( Zend_Controller_Request_Abstract $request )
    {

        $config = Zend_Registry::get( 'Zend_Config' )->resources->navigation->pages->toArray();

        // Uncomment if you are having navigation issues; allows you to see what's in the navigation config.
        // pr( $config );

        $navigation = new Zend_Navigation( $config );
        Zend_Registry::set( 'Zend_Navigation', $navigation );
        Zend_Layout::getMvcInstance()->getView()->navigation( $navigation );

    }

}