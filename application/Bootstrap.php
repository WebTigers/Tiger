<?php
/**
 * App bootstrap.
 *
 * Inherits module scanning, default-namespace wiring, theme-as-path resolution,
 * and the config cascade from Tiger. Add your own `_init*` methods here to hook
 * into the boot sequence — you never need to touch Tiger's base (in vendor/).
 *
 *   protected function _initMyThing() { ... }
 */
class Bootstrap extends Tiger_Application_Bootstrap
{
    /**
     * Custom application routes (optional — stub).
     *
     * Tiger already wires, so you DON'T add them here: the default route
     * (/:module/:controller/:action), the /api gateway, and the semantic /xx/
     * locale prefix — the prefix works on EVERY route automatically (/es/pricing,
     * /es/billing/invoice, …) via Tiger's LocalePrefix plugin.
     *
     * Add PRETTY / custom URLs here. Module-scoped routes can instead live in a
     * module's configs/routes.ini (make:module scaffolds one). Uncomment to use:
     */
    // protected function _initRoutes()
    // {
    //     $this->bootstrap('frontController');
    //     $router = $this->getResource('frontController')->getRouter();
    //
    //     // /pricing  ->  default module, PricingController::indexAction
    //     $router->addRoute('pricing', new Zend_Controller_Router_Route_Static(
    //         'pricing',
    //         ['module' => 'default', 'controller' => 'pricing', 'action' => 'index']
    //     ));
    //
    //     // /blog/:slug  ->  Blog module, PostController::viewAction (?slug=…)
    //     $router->addRoute('blog_post', new Zend_Controller_Router_Route(
    //         'blog/:slug',
    //         ['module' => 'blog', 'controller' => 'post', 'action' => 'view'],
    //         ['slug' => '[a-z0-9-]+']               // param constraint
    //     ));
    //
    //     // /u/:username  ->  a public profile page
    //     $router->addRoute('profile', new Zend_Controller_Router_Route(
    //         'u/:username',
    //         ['module' => 'default', 'controller' => 'profile', 'action' => 'show']
    //     ));
    //
    //     // The /xx/ locale prefix composes with all of the above for free:
    //     //   /es/pricing, /es/blog/mi-articulo, /es/u/beau …
    // }
}
