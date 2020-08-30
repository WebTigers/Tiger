<?php

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