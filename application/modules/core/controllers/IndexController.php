<?php

/**
 * ————————————————————————————————————————————————————————————————————————————————
 * WEBTIGERS Copyright Notice
 * ————————————————————————————————————————————————————————————————————————————————
 *
 *  Copyright © 2020 WebTigers
 *  All Rights Reserved.
 *
 * NOTICE: All information contained herein is, and remains the property of WebTigers.
 * The intellectual and technical concepts contained herein are proprietary to
 * WebTigers and may be covered by U.S. and Foreign Patents, patents in process, and
 * are protected by trade secret or copyright law. Dissemination of this information
 * or reproduction of this material is strictly forbidden unless prior written
 * permission is obtained from WebTigers.
 *
 * See the LICENSE.txt for full licensing information governing the use of this
 * information and software.
 */

/**
 * Class IndexController
 */
class IndexController extends Tiger_Controller_Action
{
    public function init()
    {
        /** OneUI Dashboard Bundles */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/oneui.core.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/oneui.app.min.js' ) );

        $this->view->theme = 'oneui';

        /** Set the layout path to use the core layout instead of the default user module layout. */
        Zend_Layout::getMvcInstance()->setLayoutPath(MODULES_PATH .'/'. $this->view->theme . '/layouts/scripts');

        /** Reset the layout path to use the admin layout instead of the default user module layout. */
        Zend_Layout::getMvcInstance()->setLayout('layout' );

        /** Set the OneUI theme options. */
        $this->view->template = $this->_setThemeOptions();

    }

    protected function _setThemeOptions ( )
    {

        // **************************************************************************************************
        // TEMPLATE OBJECT
        // **************************************************************************************************

        // : Name, version and assets folder's name
        $template = new Core_Service_Template();

        $template->name                     = 'Tiger';
        $template->version                  = '2.0';
        $template->assets_folder            = '/assets/oneui';

        // **************************************************************************************************
        // GLOBAL META & OPEN GRAPH DATA
        // **************************************************************************************************

        //                                  : The data is added in the <head> section of the page
        $template->author                   = 'WebTIGERS';
        $template->robots                   = 'noindex, nofollow';
        $template->title                    = 'Tiger - Development Platform';
        $template->description              = 'Tiger - Push button. Get Application. The easiest way to jumpstart your application development.';

        //                                  : The url of your site, used in Open Graph Meta Data (eg 'https://example.com')
        $template->og_url_site              = '';

        //                                  : The url of your image/logo, used in Open Graph Meta Data (eg 'https://example.com/assets/img/your_logo.png')
        $template->og_url_image             = '';


        // **************************************************************************************************
        // GLOBAL GENERIC
        // **************************************************************************************************

        // ''                            : default color theme
        // 'amethyst'                    : Amethyst color theme
        // 'city'                        : City color theme
        // 'flat'                        : Flat color theme
        // 'modern'                      : Modern color theme
        // 'smooth'                      : Smooth color theme
        $template->scheme                    = '';

        // true                          : Enables Page Loader screen
        // false                         : Disables Page Loader screen
        $template->page_loader                = false;

        // true                          : Remembers active color theme between pages
        //                                (when set through color theme helper Template._uiHandleTheme())
        // false                         : No cookies
        $template->cookies                    = false;

        // You will have to obtain a Google Maps API key to use Google Maps, for more info please have a look at
        // https://developers.google.com/maps/documentation/javascript/get-api-key#key
        $template->google_maps_api_key        = '';


        // **************************************************************************************************
        // GLOBAL INCLUDED VIEWS
        // **************************************************************************************************

        //                               : Useful for adding different sidebars/headers per page or per section
        $template->inc_side_overlay           = '';
        $template->inc_sidebar                = '';
        $template->inc_header                 = '';
        $template->inc_footer                 = '';


        // **************************************************************************************************
        // GLOBAL SIDEBAR & SIDE OVERLAY
        // **************************************************************************************************

        // true                          : Left Sidebar and right Side Overlay
        // false                         : Right Sidebar and left Side Overlay
        $template->l_sidebar_left             = true;

        // true                          : Mini hoverable Sidebar (screen width > 991px)
        // false                         : Normal mode
        $template->l_sidebar_mini             = false;

        // true                          : Visible Sidebar (screen width > 991px)
        // false                         : Hidden Sidebar (screen width > 991px)
        $template->l_sidebar_visible_desktop  = true;

        // true                          : Visible Sidebar (screen width < 992px)
        // false                         : Hidden Sidebar (screen width < 992px)
        $template->l_sidebar_visible_mobile   = false;

        // true                          : Dark themed Sidebar
        // false                         : Light themed Sidebar
        $template->l_sidebar_dark             = true;

        // true                          : Hoverable Side Overlay (screen width > 991px)
        // false                         : Normal mode
        $template->l_side_overlay_hoverable   = false;

        // true                          : Visible Side Overlay
        // false                         : Hidden Side Overlay
        $template->l_side_overlay_visible     = false;

        // true                          : Enables a visible clickable (closes Side Overlay) Page Overlay when Side Overlay opens
        // false                         : Disables Page Overlay when Side Overlay opens
        $template->l_page_overlay             = true;

        // true                          : Custom scrolling (screen width > 991px)
        // false                         : Native scrolling
        $template->l_side_scroll              = true;


        // **************************************************************************************************
        // GLOBAL HEADER
        // **************************************************************************************************

        // true                          : Fixed Header
        // false                         : Static Header
        $template->l_header_fixed             = true;

        // true                          : Dark themed Header
        // false                         : Light themed Header
        $template->l_header_dark              = false;


        // **************************************************************************************************
        // GLOBAL MAIN CONTENT
        // **************************************************************************************************

        // ''                            : Full width Main Content
        // 'boxed'                       : Full width Main Content with a specific maximum width (screen width > 1200px)
        // 'narrow'                      : Full width Main Content with a percentage width (screen width > 1200px)
        $template->l_m_content                = '';


        // **************************************************************************************************
        // GLOBAL MAIN MENU
        // **************************************************************************************************

        // It will get compared with the url of each menu link to make the link active and set up main menu accordingly
        // If you are using query strings to load different pages, you can use the following value: basename($_SERVER['REQUEST_URI'])
        $template->main_nav_active            = basename($_SERVER['PHP_SELF']);

        // You can use the following array to create your main menu
        $template->main_nav                   = array();


        // **************************************************************************************************
        // MAIN MENU
        // **************************************************************************************************

        $template->main_nav                  = [];
        $template->menu                      = 'admin';

        return $template;

    }

    public function indexAction ( )
    {
    }

    public function originAction ( )
    {
        Zend_Layout::getMvcInstance()->setLayout('origin' );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/core/css/origin/origin.css' ) );

    }

    public function testAction ( )
    {

        $this->_helper->layout->disableLayout();

        try {

            $userModel = new Account_Model_User();
            $userRow = $userModel->getUserById('3436efde-ef95-11ea-9f43-12d1c32c0ac5');
            $activation_link = "http://" . $_SERVER['HTTP_HOST'] . "/account/activation/key/" . $userRow->email_verify_key;

            $view = new Zend_View();
            $view->setScriptPath(Zend_Registry::get('Zend_Config')->mail->templateScriptPath);
            $view->assign('site', Zend_Registry::get('Zend_Config')->site);
            $view->assign('activation_link', $activation_link);
            echo $view->render('verify.phtml');
            exit;

        }
        catch( Error $e ) {

            pr( $e->getMessage() );

        }

    }

}

