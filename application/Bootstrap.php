<?php
/**
 * App-level bootstrap. This is where you wire Tiger Core's paths into ZF1 and where
 * app-wide, multi-tenant, and environment setup lives. App-owned — yours to edit freely.
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    /**
     * Point ZF1 at the Tiger Core package (in vendor/) for the default (module-less)
     * namespace and the first-party core modules. Your own modules in
     * application/modules are registered too, so both resolve.
     */
    protected function _initTigerPaths()
    {
        $this->bootstrap('frontController');
        $front = $this->getResource('frontController');

        // Core owns the default namespace, shipped from the package:
        $front->setControllerDirectory(TIGER_CORE_PATH . '/core/controllers', 'default');

        // Modules: yours first, then first-party core modules (both dirs registered):
        if (is_dir(APPLICATION_PATH . '/modules')) {
            $front->addModuleDirectory(APPLICATION_PATH . '/modules');
        }
        if (is_dir(TIGER_CORE_PATH . '/modules')) {
            $front->addModuleDirectory(TIGER_CORE_PATH . '/modules');
        }
    }

    /**
     * View script paths as a stack: Core is the base, the app is pushed on top and wins.
     */
    protected function _initTigerViews()
    {
        $this->bootstrap('tigerPaths');

        $view = new Zend_View();
        $view->addScriptPath(TIGER_CORE_PATH . '/core/views/scripts');   // base (Core)
        if (is_dir(APPLICATION_PATH . '/views/scripts')) {
            $view->addScriptPath(APPLICATION_PATH . '/views/scripts');   // override (app wins)
        }

        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->setView($view);

        return $view;
    }
}
