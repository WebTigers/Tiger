<?php

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
        $navigation = new Zend_Navigation( $config );
        Zend_Registry::set( 'Zend_Navigation', $navigation );
        Zend_Layout::getMvcInstance()->getView()->navigation( $navigation );

    }

}