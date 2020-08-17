<?php

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