<?php

class Account_AccountController extends Tiger_Controller_Action
{

    public function init ( )
    {
        /** OneUI Dashboard Bundles */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/oneui.core.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/oneui.app.min.js' ) );

        /** Set any custom CSS files you might have. These can also be set statically in the layout. */
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/core/css/oneui/custom/tiger.css' ) );
        $this->view->headLink()->appendStylesheet( Tiger_Cache::version('/assets/oneui/js/plugins/select2/css/select2.min.css' ) );

        /** Set any custom JS files you might have. These can also be set statically in the layout. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/select2/js/select2.full.min.js' ) );

        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerDOM.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/core/js/tiger/tigerForm.js' ) );

        /** Set the layout path to use the core layout instead of the default account module layout. */
        # Zend_Layout::getMvcInstance()->setLayoutPath(CORE_MODULE_PATH . '/layouts/scripts');

        $this->view->theme = 'oneui';

        /** Set the layout path to use the core layout instead of the default account module layout. */
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

    protected function _setBackendVars ( & $one )
    {

        // **************************************************************************************************
        // INCLUDED VIEWS
        // **************************************************************************************************

        $one->inc_side_overlay           = true;
        $one->inc_sidebar                = true;
        $one->inc_header                 = true;
        $one->inc_footer                 = true;


        // **************************************************************************************************
        // MAIN MENU
        // **************************************************************************************************

        $one->main_nav                   = array(
            array(
                'name'  => 'Dashboard',
                'icon'  => 'si si-speedometer',
                'url'   => 'be_pages_dashboard.php'
            ),
            array(
                'name'  => 'Page Packs',
                'icon'  => 'si si-layers',
                'sub'   => array(
                    array(
                        'name'  => 'e-Commerce',
                        'icon'  => 'si si-bag',
                        'sub'    => array(
                            array(
                                'name'  => 'Dashboard',
                                'url'   => 'be_pages_ecom_dashboard.php'
                            ),
                            array(
                                'name'  => 'Orders',
                                'url'   => 'be_pages_ecom_orders.php'
                            ),
                            array(
                                'name'  => 'Order',
                                'url'   => 'be_pages_ecom_order.php'
                            ),
                            array(
                                'name'  => 'Products',
                                'url'   => 'be_pages_ecom_products.php'
                            ),
                            array(
                                'name'  => 'Product Edit',
                                'url'   => 'be_pages_ecom_product_edit.php'
                            ),
                            array(
                                'name'  => 'Customer',
                                'url'   => 'be_pages_ecom_customer.php'
                            )
                        )
                    ),
                    array(
                        'name'  => 'e-Commerce Store',
                        'icon'  => 'si si-handbag',
                        'sub'    => array(
                            array(
                                'name'  => 'Home',
                                'url'   => 'be_pages_ecom_store_home.php'
                            ),
                            array(
                                'name'  => 'Search Results',
                                'url'   => 'be_pages_ecom_store_search.php'
                            ),
                            array(
                                'name'  => 'Products List',
                                'url'   => 'be_pages_ecom_store_products.php'
                            ),
                            array(
                                'name'  => 'Product Page',
                                'url'   => 'be_pages_ecom_store_product.php'
                            ),
                            array(
                                'name'  => 'Checkout',
                                'url'   => 'be_pages_ecom_store_checkout.php'
                            )
                        )
                    ),
                    array(
                        'name'  => 'Blog',
                        'icon'  => 'si si-pencil',
                        'sub'    => array(
                            array(
                                'name'  => 'Classic',
                                'url'   => 'be_pages_blog_classic.php'
                            ),
                            array(
                                'name'  => 'List',
                                'url'   => 'be_pages_blog_list.php'
                            ),
                            array(
                                'name'  => 'Grid',
                                'url'   => 'be_pages_blog_grid.php'
                            ),
                            array(
                                'name'  => 'Story',
                                'url'   => 'be_pages_blog_story.php'
                            ),
                            array(
                                'name'  => 'Story Cover',
                                'url'   => 'be_pages_blog_story_cover.php'
                            )
                        )
                    ),
                    array(
                        'name'  => 'e-Learning',
                        'icon'  => 'si si-graduation',
                        'sub'    => array(
                            array(
                                'name'  => 'Courses',
                                'url'   => 'be_pages_elearning_courses.php'
                            ),
                            array(
                                'name'  => 'Course',
                                'url'   => 'be_pages_elearning_course.php'
                            ),
                            array(
                                'name'  => 'Lesson',
                                'url'   => 'be_pages_elearning_lesson.php'
                            )
                        )
                    ),
                    array(
                        'name'  => 'Forum',
                        'icon'  => 'si si-bubbles',
                        'sub'    => array(
                            array(
                                'name'  => 'Categories',
                                'url'   => 'be_pages_forum_categories.php'
                            ),
                            array(
                                'name'  => 'Topics',
                                'url'   => 'be_pages_forum_topics.php'
                            ),
                            array(
                                'name'  => 'Discussion',
                                'url'   => 'be_pages_forum_discussion.php'
                            )
                        )
                    ),
                    array(
                        'name'  => 'Boxed Backend',
                        'icon'  => 'si si-magnet',
                        'sub'   => array(
                            array(
                                'name'  => 'Dashboard',
                                'url'   => 'bd_dashboard.php'
                            ),
                            array(
                                'name'  => 'Search',
                                'url'   => 'bd_search.php'
                            ),
                            array(
                                'name'  => 'Simple 1',
                                'url'   => 'bd_simple_1.php'
                            ),
                            array(
                                'name'  => 'Simple 2',
                                'url'   => 'bd_simple_2.php'
                            ),
                            array(
                                'name'  => 'Image 1',
                                'url'   => 'bd_image_1.php'
                            ),
                            array(
                                'name'  => 'Image 2',
                                'url'   => 'bd_image_2.php'
                            ),
                            array(
                                'name'  => 'Video 1',
                                'url'   => 'bd_video_1.php'
                            ),
                            array(
                                'name'  => 'Video 2',
                                'url'   => 'bd_video_2.php'
                            )
                        )
                    )
                )
            ),
            array(
                'name'  => 'User Interface',
                'type'  => 'heading'
            ),
            array(
                'name'  => 'Blocks',
                'icon'  => 'si si-energy',
                'sub'   => array(
                    array(
                        'name'  => 'Styles',
                        'url'   => 'be_blocks_styles.php'
                    ),
                    array(
                        'name'  => 'Options',
                        'url'   => 'be_blocks_options.php'
                    ),
                    array(
                        'name'  => 'Forms',
                        'url'   => 'be_blocks_forms.php'
                    ),
                    array(
                        'name'  => 'Themed',
                        'url'   => 'be_blocks_themed.php'
                    ),
                    array(
                        'name'  => 'API',
                        'url'   => 'be_blocks_api.php'
                    )
                )
            ),
            array(
                'name'  => 'Elements',
                'icon'  => 'si si-badge',
                'sub'   => array(
                    array(
                        'name'  => 'Grid',
                        'url'   => 'be_ui_grid.php'
                    ),
                    array(
                        'name'  => 'Typography',
                        'url'   => 'be_ui_typography.php'
                    ),
                    array(
                        'name'  => 'Icons',
                        'url'   => 'be_ui_icons.php'
                    ),
                    array(
                        'name'  => 'Buttons',
                        'url'   => 'be_ui_buttons.php'
                    ),
                    array(
                        'name'  => 'Button Groups',
                        'url'   => 'be_ui_buttons_groups.php'
                    ),
                    array(
                        'name'  => 'Dropdowns',
                        'url'   => 'be_ui_dropdowns.php'
                    ),
                    array(
                        'name'  => 'Tabs',
                        'url'   => 'be_ui_tabs.php'
                    ),
                    array(
                        'name'  => 'Navigation',
                        'url'   => 'be_ui_navigation.php'
                    ),
                    array(
                        'name'  => 'Horizontal Navigation',
                        'url'   => 'be_ui_navigation_horizontal.php'
                    ),
                    array(
                        'name'  => 'Progress',
                        'url'   => 'be_ui_progress.php'
                    ),
                    array(
                        'name'  => 'Alerts',
                        'url'   => 'be_ui_alerts.php'
                    ),
                    array(
                        'name'  => 'Tooltips',
                        'url'   => 'be_ui_tooltips.php'
                    ),
                    array(
                        'name'  => 'Popovers',
                        'url'   => 'be_ui_popovers.php'
                    ),
                    array(
                        'name'  => 'Modals',
                        'url'   => 'be_ui_modals.php'
                    ),
                    array(
                        'name'  => 'Images Overlay',
                        'url'   => 'be_ui_images.php'
                    ),
                    array(
                        'name'  => 'Timeline',
                        'url'   => 'be_ui_timeline.php'
                    ),
                    array(
                        'name'  => 'Ribbons',
                        'url'   => 'be_ui_ribbons.php'
                    ),
                    array(
                        'name'  => 'Animations',
                        'url'   => 'be_ui_animations.php'
                    ),
                    array(
                        'name'  => 'Color Themes',
                        'url'   => 'be_ui_color_themes.php'
                    )
                )
            ),
            array(
                'name'  => 'Tables',
                'icon'  => 'si si-grid',
                'sub'   => array(
                    array(
                        'name'  => 'Styles',
                        'url'   => 'be_tables_styles.php'
                    ),
                    array(
                        'name'  => 'Responsive',
                        'url'   => 'be_tables_responsive.php'
                    ),
                    array(
                        'name'  => 'Helpers',
                        'url'   => 'be_tables_helpers.php'
                    ),
                    array(
                        'name'  => 'Pricing',
                        'url'   => 'be_tables_pricing.php'
                    ),
                    array(
                        'name'  => 'DataTables',
                        'url'   => 'be_tables_datatables.php'
                    )
                )
            ),
            array(
                'name'  => 'Forms',
                'icon'  => 'si si-note',
                'sub'   => array(
                    array(
                        'name'  => 'Elements',
                        'url'   => 'be_forms_elements.php'
                    ),
                    array(
                        'name'  => 'Custom Controls',
                        'url'   => 'be_forms_custom_controls.php'
                    ),
                    array(
                        'name'  => 'Layouts',
                        'url'   => 'be_forms_layouts.php'
                    ),
                    array(
                        'name'  => 'Input Groups',
                        'url'   => 'be_forms_input_groups.php'
                    ),
                    array(
                        'name'  => 'Plugins',
                        'url'   => 'be_forms_plugins.php'
                    ),
                    array(
                        'name'  => 'Editors',
                        'url'   => 'be_forms_editors.php'
                    ),
                    array(
                        'name'  => 'Validation',
                        'url'   => 'be_forms_validation.php'
                    ),
                    array(
                        'name'  => 'Wizard',
                        'url'   => 'be_forms_wizard.php'
                    )
                )
            ),
            array(
                'name'  => 'Develop',
                'type'  => 'heading'
            ),
            array(
                'name'  => 'Components',
                'icon'  => 'si si-wrench',
                'sub'   => array(
                    array(
                        'name'  => 'Loaders',
                        'url'   => 'be_comp_loaders.php'
                    ),
                    array(
                        'name'  => 'Image Cropper',
                        'url'   => 'be_comp_image_cropper.php'
                    ),
                    array(
                        'name'  => 'Appear',
                        'url'   => 'be_comp_appear.php'
                    ),
                    array(
                        'name'  => 'Charts',
                        'url'   => 'be_comp_charts.php'
                    ),
                    array(
                        'name'  => 'Calendar',
                        'url'   => 'be_comp_calendar.php'
                    ),
                    array(
                        'name'  => 'Sliders',
                        'url'   => 'be_comp_sliders.php'
                    ),
                    array(
                        'name'  => 'Syntax Highlighting',
                        'url'   => 'be_comp_syntax_highlighting.php'
                    ),
                    array(
                        'name'  => 'Rating',
                        'url'   => 'be_comp_rating.php'
                    ),
                    array(
                        'name'  => 'Google Maps',
                        'url'   => 'be_comp_maps_google.php'
                    ),
                    array(
                        'name'  => 'Vector Maps',
                        'url'   => 'be_comp_maps_vector.php'
                    ),
                    array(
                        'name'  => 'Dialogs',
                        'url'   => 'be_comp_dialogs.php'
                    ),
                    array(
                        'name'  => 'Notifications',
                        'url'   => 'be_comp_notifications.php'
                    ),
                    array(
                        'name'  => 'Gallery',
                        'url'   => 'be_comp_gallery.php'
                    )
                )
            ),
            array(
                'name'  => 'Layout',
                'icon'  => 'si si-magic-wand',
                'sub'   => array(
                    array(
                        'name'  => 'Page',
                        'sub'   => array(
                            array(
                                'name'  => 'Default',
                                'url'   => 'be_layout_page_default.php'
                            ),
                            array(
                                'name'  => 'Flipped',
                                'url'   => 'be_layout_page_flipped.php'
                            ),
                            array(
                                'name'  => 'Native Scrolling',
                                'url'   => 'be_layout_page_native_scrolling.php'
                            )
                        )
                    ),
                    array(
                        'name'  => 'Main Content',
                        'sub'   => array(
                            array(
                                'name'  => 'Full Width',
                                'url'   => 'be_layout_content_main_full_width.php'
                            ),
                            array(
                                'name'  => 'Narrow',
                                'url'   => 'be_layout_content_main_narrow.php'
                            ),
                            array(
                                'name'  => 'Boxed',
                                'url'   => 'be_layout_content_main_boxed.php'
                            )
                        )
                    ),
                    array(
                        'name'  => 'Header',
                        'sub'   => array(
                            array(
                                'name'  => 'Fixed',
                                'type'  => 'heading'
                            ),
                            array(
                                'name'  => 'Light',
                                'url'   => 'be_layout_header_fixed_light.php'
                            ),
                            array(
                                'name'  => 'Dark',
                                'url'   => 'be_layout_header_fixed_dark.php'
                            ),
                            array(
                                'name'  => 'Static',
                                'type'  => 'heading'
                            ),
                            array(
                                'name'  => 'Light',
                                'url'   => 'be_layout_header_static_light.php'
                            ),
                            array(
                                'name'  => 'Dark',
                                'url'   => 'be_layout_header_static_dark.php'
                            )
                        )
                    ),
                    array(
                        'name'  => 'Sidebar',
                        'sub'   => array(
                            array(
                                'name'  => 'Mini',
                                'url'   => 'be_layout_sidebar_mini.php'
                            ),
                            array(
                                'name'  => 'Light',
                                'url'   => 'be_layout_sidebar_light.php'
                            ),
                            array(
                                'name'  => 'Dark',
                                'url'   => 'be_layout_sidebar_dark.php'
                            ),
                            array(
                                'name'  => 'Hidden',
                                'url'   => 'be_layout_sidebar_hidden.php'
                            )
                        )
                    ),
                    array(
                        'name'  => 'Side Overlay',
                        'sub'   => array(
                            array(
                                'name'  => 'Visible',
                                'url'   => 'be_layout_side_overlay_visible.php'
                            ),
                            array(
                                'name'  => 'Hover Mode',
                                'url'   => 'be_layout_side_overlay_mode_hover.php'
                            ),
                            array(
                                'name'  => 'No Page Overlay',
                                'url'   => 'be_layout_side_overlay_no_page_overlay.php'
                            )
                        )
                    ),
                    array(
                        'name'  => 'API',
                        'url'   => 'be_layout_api.php'
                    )
                )
            ),
            array(
                'name'  => 'Multi Level Menu',
                'icon'  => 'si si-puzzle',
                'sub'   => array(
                    array(
                        'name'  => 'Link 1-1',
                        'url'   => '#'
                    ),
                    array(
                        'name'  => 'Link 1-2',
                        'url'   => '#'
                    ),
                    array(
                        'name'  => 'Sub Level 2',
                        'sub'   => array(
                            array(
                                'name'  => 'Link 2-1',
                                'url'   => '#'
                            ),
                            array(
                                'name'  => 'Link 2-2',
                                'url'   => '#'
                            ),
                            array(
                                'name'  => 'Sub Level 3',
                                'sub'   => array(
                                    array(
                                        'name'  => 'Link 3-1',
                                        'url'   => '#'
                                    ),
                                    array(
                                        'name'  => 'Link 3-2',
                                        'url'   => '#'
                                    ),
                                    array(
                                        'name'  => 'Sub Level 4',
                                        'sub'   => array(
                                            array(
                                                'name'  => 'Link 4-1',
                                                'url'   => '#'
                                            ),
                                            array(
                                                'name'  => 'Link 4-2',
                                                'url'   => '#'
                                            ),
                                            array(
                                                'name'  => 'Sub Level 5',
                                                'sub'   => array(
                                                    array(
                                                        'name'  => 'Link 5-1',
                                                        'url'   => '#'
                                                    ),
                                                    array(
                                                        'name'  => 'Link 5-2',
                                                        'url'   => '#'
                                                    ),
                                                    array(
                                                        'name'  => 'Sub Level 6',
                                                        'sub'   => array(
                                                            array(
                                                                'name'  => 'Link 6-1',
                                                                'url'   => '#'
                                                            ),
                                                            array(
                                                                'name'  => 'Link 6-2',
                                                                'url'   => '#'
                                                            )
                                                        )
                                                    )
                                                )
                                            )
                                        )
                                    )
                                )
                            )
                        )
                    )
                )
            ),
            array(
                'name'  => 'Pages',
                'type'  => 'heading'
            ),
            array(
                'name'  => 'Generic',
                'icon'  => 'si si-layers',
                'sub'   => array(
                    array(
                        'name'  => 'Blank',
                        'url'   => 'be_pages_generic_blank.php'
                    ),
                    array(
                        'name'  => 'Blank (Block)',
                        'url'   => 'be_pages_generic_blank_block.php'
                    ),
                    array(
                        'name'  => 'Search',
                        'url'   => 'be_pages_generic_search.php'
                    ),
                    array(
                        'name'  => 'Profile',
                        'url'   => 'be_pages_generic_profile.php'
                    ),
                    array(
                        'name'  => 'Profile Edit',
                        'url'   => 'be_pages_generic_profile_edit.php'
                    ),
                    array(
                        'name'  => 'Inbox',
                        'url'   => 'be_pages_generic_inbox.php'
                    ),
                    array(
                        'name'  => 'Invoice',
                        'url'   => 'be_pages_generic_invoice.php'
                    ),
                    array(
                        'name'  => 'FAQ',
                        'url'   => 'be_pages_generic_faq.php'
                    ),
                    array(
                        'name'  => 'Team',
                        'url'   => 'be_pages_generic_team.php'
                    ),
                    array(
                        'name'  => 'Contact',
                        'url'   => 'be_pages_generic_contact.php'
                    ),
                    array(
                        'name'  => 'Support',
                        'url'   => 'be_pages_generic_support.php'
                    ),
                    array(
                        'name'  => 'Upgrade Plan',
                        'url'   => 'be_pages_generic_upgrade_plan.php'
                    ),
                    array(
                        'name'  => 'Maintenance',
                        'url'   => 'op_maintenance.php'
                    ),
                    array(
                        'name'  => 'Status',
                        'url'   => 'op_status.php'
                    ),
                    array(
                        'name'  => 'Coming Soon',
                        'url'   => 'op_coming_soon.php'
                    )
                )
            ),
            array(
                'name'  => 'Authentication',
                'icon'  => 'si si-lock',
                'sub'   => array(
                    array(
                        'name'  => 'All',
                        'url'   => 'be_pages_auth_all.php'
                    ),
                    array(
                        'name'  => 'Sign In',
                        'url'   => 'op_auth_signin.php'
                    ),
                    array(
                        'name'  => 'Sign In 2',
                        'url'   => 'op_auth_signin2.php'
                    ),
                    array(
                        'name'  => 'Sign Up',
                        'url'   => 'op_auth_signup.php'
                    ),
                    array(
                        'name'  => 'Sign Up 2',
                        'url'   => 'op_auth_signup2.php'
                    ),
                    array(
                        'name'  => 'Lock Screen',
                        'url'   => 'op_auth_lock.php'
                    ),
                    array(
                        'name'  => 'Lock Screen 2',
                        'url'   => 'op_auth_lock2.php'
                    ),
                    array(
                        'name'  => 'Pass Reminder',
                        'url'   => 'op_auth_reminder.php'
                    ),
                    array(
                        'name'  => 'Pass Reminder 2',
                        'url'   => 'op_auth_reminder2.php'
                    )
                )
            ),
            array(
                'name'  => 'Error Pages',
                'icon'  => 'si si-fire',
                'sub'    => array(
                    array(
                        'name'  => 'All',
                        'url'   => 'be_pages_error_all.php'
                    ),
                    array(
                        'name'  => '400',
                        'url'   => 'op_error_400.php'
                    ),
                    array(
                        'name'  => '401',
                        'url'   => 'op_error_401.php'
                    ),
                    array(
                        'name'  => '403',
                        'url'   => 'op_error_403.php'
                    ),
                    array(
                        'name'  => '404',
                        'url'   => 'op_error_404.php'
                    ),
                    array(
                        'name'  => '500',
                        'url'   => 'op_error_500.php'
                    ),
                    array(
                        'name'  => '503',
                        'url'   => 'op_error_503.php'
                    )
                )
            )
        );

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
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.signup.js' ) );

        $this->view->signupForm = new Account_Form_Signup();

    }

    public function welcomeAction ( )
    {
        /** Add the welcome page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.welcome.js' ) );

        $this->view->user = Zend_Auth::getInstance()->getIdentity();

        $resendForm = new Account_Form_Resend();
        $resendForm->getElement('user_id')->setValue( $this->view->user->user_id );
        $this->view->resendForm = $resendForm;

    }

    public function loginAction ( )
    {
        /** Add the login page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.login.js' ) );

        $this->view->loginForm = new Account_Form_Login();

        if ( isset( $_COOKIE['username'] ) ) {
            $this->view->loginForm->getElement('username')->setValue( $_COOKIE['username'] );
            $this->view->loginForm->getElement('remember_me')->setChecked( true );
        }

    }

    public function logoutAction ( )
    {
        Zend_Auth::getInstance()->clearIdentity();  // <-- This logs us out of the application.
        Zend_Session::regenerateId();               // <-- Gets us a shiny new session id.

        /**
         * We could set a guest identity here, but at this point we're on the public logout page and a
         * new guest identity will be generated automagically on the next public page hit. No worries.
         */

        /** Add the login page JS plugin. */
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/account/js/account.login.js' ) );

        $this->view->loginForm = new Account_Form_Login();

        if ( isset( $_COOKIE['username'] ) ) {
            $this->view->loginForm->getElement('username')->setValue( $_COOKIE['username'] );
            $this->view->loginForm->getElement('remember_me')->setChecked( true );
        }

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
         $accountService = new Account_Service_Account( $request );
         $this->view->response = $accountService->getResponse();

    }

    public function dashboardAction ( )
    {
        /** Adds the backend dashboard settings we need. */
        $this->_setBackendVars( $this->view->one );

        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/plugins/chart.js/Chart.bundle.min.js' ) );
        $this->view->inlineScript()->appendFile( Tiger_Cache::version( '/assets/oneui/js/pages/be_pages_dashboard.min.js' ) );

    }

}

