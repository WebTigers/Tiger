<?php

class Acl_AdminController extends Tiger_Controller_Action
{
    public function init ( )
    {
        /** The Admin Controller and Admin Service are only available on ports 8080 and 8081 for security purposes. */
        if ( ! in_array( $_SERVER['SERVER_PORT'], [ '8080', '8081' ] ) ) {
            throw new Error( 'ADMIN.DISALLOWED' );
        }

        /** Set any custom CSS files you might have. These can also be set statically in the layout. */
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/select2/css/select2.min.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/datatables/dataTables.bootstrap4.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/core/css/oneui/custom/tiger.css' ) );

        /** OneUI Dashboard Bundles */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/oneui.core.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/oneui.app.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/chart.js/Chart.bundle.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/pages/be_pages_dashboard.min.js' ) );

        /** Set any custom JS files you might have. These can also be set statically in the layout. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/select2/js/select2.full.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/datatables/jquery.dataTables.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/datatables/dataTables.bootstrap4.min.js' ) );

        /** Tiger Core DOM Plugins */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerDOM.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerForm.js' ) );

        $this->view->theme = 'oneui';

        /** Set the layout path to use the core layout instead of the default user module layout. */
        Zend_Layout::getMvcInstance()->setLayoutPath(MODULES_PATH .'/'. $this->view->theme . '/layouts/scripts');

        /** Set the OneUI theme vars. */
        $this->view->one = $this->_setThemeVars();

        /** Reset the layout path to use the admin layout instead of the default user module layout. */
        Zend_Layout::getMvcInstance()->setLayout('layout' );

        /** Adds the backend dashboard settings we need. */
        $this->_setBackendVars( $this->view->one );

        /** Set User to the theme container */
        $this->view->one->user = Zend_Auth::getInstance()->getIdentity();

        /** Global hero header vars */
        $this->view->one->page_title = $this->view->translate('PERMISSIONS');

    }

    protected function _setThemeVars ( )
    {

        // **************************************************************************************************
        // TEMPLATE OBJECT
        // **************************************************************************************************

        // : Name, version and assets folder's name
        $one = new Core_Service_Template('Tiger', '2.0', '/assets/oneui');


        // **************************************************************************************************
        // GLOBAL META & OPEN GRAPH DATA
        // **************************************************************************************************

        //                               : The data is added in the <head> section of the page
        $one->author                     = 'WebTIGERS';
        $one->robots                     = 'noindex, nofollow';
        $one->title                      = 'Tiger - Development Platform';
        $one->description                = 'Tiger - Push button. Get Application. The easiest way to jumpstart your application development.';

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

        $one->main_nav                  = [];
        $one->menu                      = 'admin';

        return $one;

    }

    protected function _setBackendVars ( & $one )
    {

        // **************************************************************************************************
        // INCLUDED VIEWS
        // **************************************************************************************************

        $one->inc_side_overlay           = true;
        $one->inc_sidebar                = true;
        $one->inc_header                 = true;
        $one->inc_footer                 = true;

        return $one;

    }


    ##### Admin Actions #####

    public function indexAction ( )
    {
        $this->forward('dashboard', 'admin', 'core');
    }

    public function resourceAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/acl/js/acl.admin.resource.js' ) );
        $this->view->resourceForm = new Acl_Form_Resource();
    }

    public function roleAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/acl/js/acl.admin.role.js' ) );
        $this->view->roleForm = new Acl_Form_Role();
    }

    public function ruleAction ( )
    {
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/acl/js/acl.admin.rule.js' ) );
        $this->view->ruleForm = new Acl_Form_Rule();
    }

}

