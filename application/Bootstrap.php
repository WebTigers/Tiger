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
     * Views + active theme/skin. View script paths cascade (last wins):
     * Core (base) -> theme -> app. Actions are wrapped in the active theme's layout,
     * which loads bootstrap -> default.css -> the active skin.
     *
     * Theme + skin come from config now (tiger.theme / tiger.skin); the resolver
     * becomes per-org once tenancy lands.
     */
    protected function _initTigerViews()
    {
        $this->bootstrap('tigerPaths');

        $opts  = $this->getOption('tiger') ?: array();
        $theme = isset($opts['theme']) ? $opts['theme'] : 'puma';
        $skin  = isset($opts['skin'])  ? $opts['skin']  : '';
        $themePath = TIGER_CORE_PATH . '/themes/' . $theme;

        $view = new Zend_View();
        $view->doctype('HTML5');
        $view->addScriptPath(TIGER_CORE_PATH . '/core/views/scripts');      // base (Core)
        if (is_dir($themePath . '/views/scripts')) {
            $view->addScriptPath($themePath . '/views/scripts');           // theme override
        }
        if (is_dir(APPLICATION_PATH . '/views/scripts')) {
            $view->addScriptPath(APPLICATION_PATH . '/views/scripts');     // app override
        }

        // Theme context for views + layout:
        $view->theme       = $theme;
        $view->skin        = $skin;
        $view->themeAssets = '/_theme';

        $viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper('viewRenderer');
        $viewRenderer->setView($view);

        // Wrap actions in the active theme's layout:
        $layout = Zend_Layout::startMvc(array(
            'layoutPath' => $themePath . '/layouts/scripts',
            'layout'     => 'layout',
        ));
        $layout->setView($view);

        return $view;
    }
}
