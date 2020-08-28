<?php

class ErrorController extends Zend_Controller_Action
{

    public function errorAction ( )
    {
        /**
         * Dev Notes: If we get here, there's a good chance someone typed in some random
         * URL that doesn't route within the application. Because of Tiger's core routing
         * and routes, /abcdefg can be a valid route but will not map to valid modules,
         * controllers or actions. Tiger "sees" the above non-routable URL as
         *
         *     module = abcdefg
         *     controller = index
         *     action = index
         *
         * which is undesirable since there is no abcdefg module.
         */

        Zend_Layout::getMvcInstance()->setLayoutPath( CORE_MODULE_PATH . '/layouts/scripts/');

        $errors = $this->_getParam('error_handler');

        switch ( $errors->type ) {

            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ROUTE:
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_ACL_NO_RESOURCE:
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_NO_CONTROLLER:
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_NO_ACTION:
                // 404 error -- controller or action not found
                $priority = Zend_Log::NOTICE;
                $this->forward('error404');
                break;
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_ACL_NOT_AUTHORIZED:
            case Tiger_Controller_Plugin_ErrorHandler::EXCEPTION_OTHER:
                $priority = Zend_Log::NOTICE;
                $this->forward('error403');
                break;
            default:
                // application error
                $priority = Zend_Log::CRIT;
                $this->forward('error500');
                break;
        }

        // Log exception, if logger available
//        if ($log = $this->getLog()) {
//            $log->log($this->view->message, $priority, $errors->exception);
//            $log->log('Request Parameters', $priority, $errors->request->getParams());
//        }
        
        // conditionally display exceptions
        if ($this->getInvokeArg('displayExceptions') == true) {
            $this->view->exception = $errors->exception;
        }

        // $this->view->message = $errors->message;
        $this->view->request = $errors->request;
    }

    public function getLog ( )
    {
        $bootstrap = $this->getInvokeArg('bootstrap');
        if (!$bootstrap->hasResource('Log')) {
            return false;
        }
        $log = $bootstrap->getResource('Log');
        return $log;
    }

    public function error403Action ( )
    {
        $this->getResponse()->setHttpResponseCode(403);

        /** Set the OneUI theme vars. */
        $this->view->one = $this->_setThemeVars();

        /**
         * If we're here in the error403 action, then the original request is garbage
         * and cannot be use. Switch to the core layout and render this error page.
         */
        $this->view->message = 'Page not authorized.';

    }

    public function error404Action ( )
    {
        $this->getResponse()->setHttpResponseCode(404);

        /** Set the OneUI theme vars. */
        $this->view->one = $this->_setThemeVars();

        /**
         * If we're here in the error404 action, then the original request is garbage
         * and cannot be use. Switch to the core layout and render this error page.
         */
        $this->view->message = 'Page not found';

    }

    public function error500Action ( )
    {
        $this->getResponse()->setHttpResponseCode(500);

        /** Set the OneUI theme vars. */
        $this->view->one = $this->_setThemeVars();

        /**
         * If we're here in the error404 action, then the original request is garbage
         * and cannot be use. Switch to the core layout and render this error page.
         */
        $this->view->message = 'Application error';

    }

    protected function _setThemeVars ( ) {

        // **************************************************************************************************
        // TEMPLATE OBJECT
        // **************************************************************************************************

        // : Name, version and assets folder's name
        $one = new Core_Service_Template('Tiger', '2.0', '/assets/core');


        // **************************************************************************************************
        // GLOBAL META & OPEN GRAPH DATA
        // **************************************************************************************************

        //                               : The data is added in the <head> section of the page
        $one->author                     = 'pixelcave';
        $one->robots                     = 'noindex, nofollow';
        $one->title                      = 'OneUI - Bootstrap 4 Admin Template &amp; UI Framework';
        $one->description                = 'OneUI - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest';

        //                               : The url of your site, used in Open Graph Meta Data (eg 'https://example.com')
        $one->og_url_site                = '';

        //                               : The url of your image/logo, used in Open Graph Meta Data (eg 'https://example.com/assets/img/your_logo.png')
        $one->og_url_image               = '';


        // **************************************************************************************************
        // GLOBAL GENERIC
        // **************************************************************************************************

        // ''                            : default color theme
        // 'amethyst'                    : Amethyst color theme
        // 'city'                        : City color theme
        // 'flat'                        : Flat color theme
        // 'modern'                      : Modern color theme
        // 'smooth'                      : Smooth color theme
        $one->theme                      = '';

        // true                          : Enables Page Loader screen
        // false                         : Disables Page Loader screen
        $one->page_loader                = false;

        // true                          : Remembers active color theme between pages
        //                                (when set through color theme helper Template._uiHandleTheme())
        // false                         : No cookies
        $one->cookies                    = false;

        // You will have to obtain a Google Maps API key to use Google Maps, for more info please have a look at
        // https://developers.google.com/maps/documentation/javascript/get-api-key#key
        $one->google_maps_api_key        = '';


        // **************************************************************************************************
        // GLOBAL INCLUDED VIEWS
        // **************************************************************************************************

        //                               : Useful for adding different sidebars/headers per page or per section
        $one->inc_side_overlay           = '';
        $one->inc_sidebar                = '';
        $one->inc_header                 = '';
        $one->inc_footer                 = '';


        // **************************************************************************************************
        // GLOBAL SIDEBAR & SIDE OVERLAY
        // **************************************************************************************************

        // true                          : Left Sidebar and right Side Overlay
        // false                         : Right Sidebar and left Side Overlay
        $one->l_sidebar_left             = true;

        // true                          : Mini hoverable Sidebar (screen width > 991px)
        // false                         : Normal mode
        $one->l_sidebar_mini             = false;

        // true                          : Visible Sidebar (screen width > 991px)
        // false                         : Hidden Sidebar (screen width > 991px)
        $one->l_sidebar_visible_desktop  = true;

        // true                          : Visible Sidebar (screen width < 992px)
        // false                         : Hidden Sidebar (screen width < 992px)
        $one->l_sidebar_visible_mobile   = false;

        // true                          : Dark themed Sidebar
        // false                         : Light themed Sidebar
        $one->l_sidebar_dark             = true;

        // true                          : Hoverable Side Overlay (screen width > 991px)
        // false                         : Normal mode
        $one->l_side_overlay_hoverable   = false;

        // true                          : Visible Side Overlay
        // false                         : Hidden Side Overlay
        $one->l_side_overlay_visible     = false;

        // true                          : Enables a visible clickable (closes Side Overlay) Page Overlay when Side Overlay opens
        // false                         : Disables Page Overlay when Side Overlay opens
        $one->l_page_overlay             = true;

        // true                          : Custom scrolling (screen width > 991px)
        // false                         : Native scrolling
        $one->l_side_scroll              = true;


        // **************************************************************************************************
        // GLOBAL HEADER
        // **************************************************************************************************

        // true                          : Fixed Header
        // false                         : Static Header
        $one->l_header_fixed             = true;

        // true                          : Dark themed Header
        // false                         : Light themed Header
        $one->l_header_dark              = false;


        // **************************************************************************************************
        // GLOBAL MAIN CONTENT
        // **************************************************************************************************

        // ''                            : Full width Main Content
        // 'boxed'                       : Full width Main Content with a specific maximum width (screen width > 1200px)
        // 'narrow'                      : Full width Main Content with a percentage width (screen width > 1200px)
        $one->l_m_content                = '';


        // **************************************************************************************************
        // GLOBAL MAIN MENU
        // **************************************************************************************************

        // It will get compared with the url of each menu link to make the link active and set up main menu accordingly
        // If you are using query strings to load different pages, you can use the following value: basename($_SERVER['REQUEST_URI'])
        $one->main_nav_active            = basename($_SERVER['PHP_SELF']);

        // You can use the following array to create your main menu
        $one->main_nav                   = array();


        // **************************************************************************************************
        // MAIN MENU
        // **************************************************************************************************

        $one->main_nav                   = array();

        return $one;

    }

}

