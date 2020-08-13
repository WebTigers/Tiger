<?php
/**
 * backend_boxed/config.php
 *
 * Author: pixelcave
 *
 * Boxed Backend configuration file
 *
 */

// **************************************************************************************************
// INCLUDED VIEWS
// **************************************************************************************************

$one->inc_header                 = 'inc/backend_boxed/views/inc_header.php';
$one->inc_footer                 = 'inc/backend_boxed/views/inc_footer.php';


// **************************************************************************************************
// HEADER
// **************************************************************************************************

$one->l_header_dark              = true;
$one->l_header_fixed             = false;


// **************************************************************************************************
// MAIN CONTENT
// **************************************************************************************************

$one->l_m_content                = 'boxed';


// **************************************************************************************************
// MAIN MENU
// **************************************************************************************************

$one->main_nav                   = array(
    array(
        'name'  => 'Dashboard',
        'icon'  => 'si si-compass',
        'url'   => 'bd_dashboard.php'
    ),
    array(
        'name'  => 'Pages',
        'type'  => 'heading'
    ),
    array(
        'name'  => 'Variations',
        'icon'  => 'si si-puzzle',
        'sub'   => array(
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
            ),
            array(
                'name'  => 'More Options',
                'sub'   => array(
                    array(
                        'name'  => 'Another Link',
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Another Link',
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Another Link',
                        'url'   => 'javascript:void(0)'
                    )
                )
            )
        )
    ),
    array(
        'name'  => 'Search',
        'icon'  => 'si si-magnifier',
        'url'   => 'bd_search.php'
    ),
    array(
        'name'  => 'Go Back',
        'icon'  => 'si si-action-undo',
        'url'   => 'be_pages_dashboard.php'
    )
);
