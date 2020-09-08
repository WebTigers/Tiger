<?php

class User_AccountController extends Tiger_Controller_Action
{

    public function init ( )
    {
        /** Set any custom CSS files you might have. These can also be set statically in the layout. */
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/core/css/oneui/custom/tiger.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/select2/css/select2.min.css' ) );

        /** Set any custom JS files you might have. These can also be set statically in the layout. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/select2/js/select2.full.min.js' ) );

        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerDOM.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerForm.js' ) );

        /** Set the layout path to use the core layout instead of the default user module layout. */
        # Zend_Layout::getMvcInstance()->setLayoutPath(CORE_MODULE_PATH . '/layouts/scripts');

        $this->view->theme = 'oneui';

        /** Set the layout path to use the core layout instead of the default user module layout. */
        Zend_Layout::getMvcInstance()->setLayoutPath(MODULES_PATH .'/'. $this->view->theme . '/layouts/scripts');

        /** Set the OneUI theme vars. */
        $this->view->one = $this->_setThemeVars();

    }

    protected function _setThemeVars ( ) {

        // **************************************************************************************************
        // TEMPLATE OBJECT
        // **************************************************************************************************

        // : Name, version and assets folder's name
        $one = new Oneui_Service_Template('Tiger', '2.0', '/assets/oneui');


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

        $one->main_nav                   = array();

        return $one;

    }


    ### Public Actions ###

    public function indexAction ( )
    {
        $this->forward('dashboard');
    }

    public function signupAction ( )
    {

        /** Add the tigerPassword widget. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerPassword.js' ) );

        /** Add the signup page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/user/js/tiger/user.signup.js' ) );

        $this->view->signupForm = new User_Form_Signup();

    }

    public function welcomeAction ( )
    {
        /** Add the welcome page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/user/js/tiger/user.welcome.js' ) );

        $this->view->user = Zend_Auth::getInstance()->getIdentity();

        $resendForm = new User_Form_Resend();
        $resendForm->getElement('user_id')->setValue( $this->view->user->user_id );
        $this->view->resendForm = $resendForm;

    }

    public function loginAction ( )
    {
        /** Add the login page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/user/js/tiger/user.login.js' ) );
        $this->view->loginForm = new User_Form_Login();
        if ( isset( $_COOKIE['username'] ) ) {
            $this->view->loginForm->getElement('username')->setValue( $_COOKIE['username'] );
            $this->view->loginForm->getElement('remember_me')->setChecked( true );
        }
    }

    public function logoutAction ( )
    {
        Zend_Auth::getInstance()->clearIdentity();
        Zend_Session::destroy();
    }

    public function verifyAction ( )
    {

         $request = $this->getRequest();
         $request->setParam('method', 'verify');

         /**
          * Notice how we can just pass in the request object to have to Account Service
          * auto-route to the verify method, do the work, and then we can just poll the
          * service for the response once the service in instantiated.
          */
         $accountService = new User_Service_Account( $request );
         $this->view->response = $accountService->getResponse();

    }

    public function dashboardAction ( )
    {
        /** Reset the layout path to use the admin layout instead of the default user module layout. */
        Zend_Layout::getMvcInstance()->setLayoutPath(MODULES_PATH . '/admin/layouts/scripts');

        // pr( Zend_Auth::getInstance()->getIdentity() );

    }

}

