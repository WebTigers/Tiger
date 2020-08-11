<?php

class Tiger_Controller_Plugin_Layout extends Zend_Controller_Plugin_Abstract
{
    /**
     * This function is called once after router shutdown. It automatically
     * sets the layout for the default MVC or a module-specific layout.
     *
     * @param Zend_Controller_Request_Abstract $request
     */
    public function routeShutdown(Zend_Controller_Request_Abstract $request)
    {
        // $mobile = new Tiger_Mobile_Detect;
        
        $MVC    = Zend_Layout::getMvcInstance();
        $module = strtolower($request->getModuleName());
        
        $theme  = Zend_Registry::get('Zend_Config')->resources->layout->theme;
        
        $view   = $MVC->getView();
        
        $layoutPath = APPLICATION_PATH . '/' . $module . '/layouts/scripts/';
        $viewPath   = APPLICATION_PATH . '/' . $module . '/views/';

        // $MVC->setLayout( $layout );
        $MVC->setLayoutPath( $layoutPath );
        $view->setBasePath( $viewPath );
        
        // register the placeholder helper with the view and init default settings
        // note that we need to call $view->placeholders->build() method somewhere
        // in the controller before the view is rendered.
        $placeholders = new Tiger_View_Helper_Placeholders();
        $view->registerHelper($placeholders, 'placeholders');
        $placeholders->setDefaults();
        $placeholders->build();
    }

}