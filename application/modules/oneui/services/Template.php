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

class Oneui_Service_Template extends Oneui_Service_Base
{

    public $admin_logo =    '<a class="font-w600 text-dual" href="/admin">' .
                                '<i class="tiger tiger-logo-tiny"></i>' .
                                '<span class="smini-hide">' .
                                    '<span class="font-w700 font-size-h5"> TIGER</span>' .
                                '</span>' .
                            '</a>';

    public function setTemplateOptions( $options, Zend_Db_Table_Row_Abstract $pageRow = null ) {

        // **************************************************************************************************
        // DEFAULT TEMPLATE SETTINGS
        // **************************************************************************************************

        // First, set the theme's default options. This should come from the theme's config options.

        parent::setTemplateOptions( $options, $pageRow );

        // **************************************************************************************************
        // TEMPLATE SETTINGS
        // **************************************************************************************************

        // Now in our concrete template, we can override any of the theme's template settings with our
        // Core or other module theme template settings. These will then get passed to the theme's layout.

        $this->name                     = 'Tiger';
        $this->version                  = '2.0';
        $this->assets_folder            = '/assets/oneui';

        // **************************************************************************************************
        // HEAD DATA
        // **************************************************************************************************

        $this->title = 'Tiger - Development Platform';

        // Note that $this->meta is now Zend Config object. Treat accordingly ...

        $this->meta->name->description->attributes->description     = 'Tiger - Push button. Get Application. The easiest way to jumpstart your application development.';
        $this->meta->name->author->attributes->author               = 'WebTigers';
        $this->meta->name->keywords->attributes->keywords           = '';
        $this->meta->name->robots->attributes->robots               = 'noindex, nofollow';

        $this->links->favicon1->attributes->href = "/assets/oneui/media/favicons/favicon.png";
        $this->links->favicon2->attributes->href = "/assets/oneui/media/favicons/favicon.png";
        $this->links->favicon3->attributes->href = "/assets/oneui/media/favicons/apple-touch-icon-180x180.png";


        // **************************************************************************************************
        // OPEN GRAPH META
        // **************************************************************************************************

        $this->meta->opengraph->type->attributes->{'og-type'} = "website";
        $this->meta->opengraph->locale->attributes->{'og-locale'} = "en_US";
        $this->meta->opengraph->title->attributes->{'og-title'} = "";
        $this->meta->opengraph->description->attributes->{'og-description'} = "";
        $this->meta->opengraph->url->attributes->{'og-url'} = "";

        $this->meta->opengraph->image->attributes->{'og-image'} = "";
        $this->meta->opengraph->image_url->attributes->{'og-image-secure_url'} = "";
        $this->meta->opengraph->image_width->attributes->{'og-image-width'} = "";
        $this->meta->opengraph->image_height->attributes->{'og-image-height'} = "";
        $this->meta->opengraph->image_type->attributes->{'og-image-type'} = "";
        $this->meta->opengraph->image_alt->attributes->{'og-image-alt'} = "";
        
        
        // **************************************************************************************************
        // GLOBAL GENERIC THEME SETTINGS
        // **************************************************************************************************

        // ''                            : default color theme
        // 'amethyst'                    : Amethyst color theme
        // 'city'                        : City color theme
        // 'flat'                        : Flat color theme
        // 'modern'                      : Modern color theme
        // 'smooth'                      : Smooth color theme
        $this->scheme                    = '';

        // true                          : Enables Page Loader screen
        // false                         : Disables Page Loader screen
        $this->page_loader               = false;

        // true                          : Remembers active color theme between pages
        //                                (when set through color theme helper Template._uiHandleTheme())
        // false                         : No cookies
        $this->cookies                   = false;

        // You will have to obtain a Google Maps API key to use Google Maps, for more info please have a look at
        // https://developers.google.com/maps/documentation/javascript/get-api-key#key
        $this->google_maps_api_key       = '';


        // **************************************************************************************************
        // GLOBAL INCLUDED VIEWS
        // **************************************************************************************************

        //                               : Useful for adding different sidebars/headers per page or per section
        $this->inc_side_overlay          = true;
        $this->inc_sidebar               = true;
        $this->inc_header                = true;
        $this->inc_footer                = true;

        // **************************************************************************************************
        // GLOBAL SIDEBAR & SIDE OVERLAY
        // **************************************************************************************************

        // true                          : Left Sidebar and right Side Overlay
        // false                         : Right Sidebar and left Side Overlay
        $this->l_sidebar_left            = true;

        // true                          : Mini hoverable Sidebar (screen width > 991px)
        // false                         : Normal mode
        $this->l_sidebar_mini            = false;

        // true                          : Visible Sidebar (screen width > 991px)
        // false                         : Hidden Sidebar (screen width > 991px)
        $this->l_sidebar_visible_desktop = true;

        // true                          : Visible Sidebar (screen width < 992px)
        // false                         : Hidden Sidebar (screen width < 992px)
        $this->l_sidebar_visible_mobile  = false;

        // true                          : Dark themed Sidebar
        // false                         : Light themed Sidebar
        $this->l_sidebar_dark            = true;

        // true                          : Hoverable Side Overlay (screen width > 991px)
        // false                         : Normal mode
        $this->l_side_overlay_hoverable  = false;

        // true                          : Visible Side Overlay
        // false                         : Hidden Side Overlay
        $this->l_side_overlay_visible    = false;

        // true                          : Enables a visible clickable (closes Side Overlay) Page Overlay when Side Overlay opens
        // false                         : Disables Page Overlay when Side Overlay opens
        $this->l_page_overlay            = true;

        // true                          : Custom scrolling (screen width > 991px)
        // false                         : Native scrolling
        $this->l_side_scroll             = true;


        // **************************************************************************************************
        // GLOBAL HEADER
        // **************************************************************************************************

        // true                          : Fixed Header
        // false                         : Static Header
        $this->l_header_fixed            = true;

        // true                          : Dark themed Header
        // false                         : Light themed Header
        $this->l_header_dark             = false;


        // **************************************************************************************************
        // GLOBAL MAIN CONTENT
        // **************************************************************************************************

        // ''                            : Full width Main Content
        // 'boxed'                       : Full width Main Content with a specific maximum width (screen width > 1200px)
        // 'narrow'                      : Full width Main Content with a percentage width (screen width > 1200px)
        $this->l_m_content               = '';


        // **************************************************************************************************
        // GLOBAL MAIN MENU
        // **************************************************************************************************

        // It will get compared with the url of each menu link to make the link active and set up main menu accordingly
        // If you are using query strings to load different pages, you can use the following value: basename($_SERVER['REQUEST_URI'])
        $this->main_nav_active           = basename($_SERVER['PHP_SELF']);

        // You can use the following array to create your main menu
        $this->main_nav                  = [];
        $this->menu                      = 'admin';

    }
    
}