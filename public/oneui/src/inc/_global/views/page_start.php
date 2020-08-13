<?php
/**
 * page_start.php
 *
 * Author: pixelcave
 *
 * The start section of each page used in every page of the template
 *
 */
?>
<?php if(isset($one->page_loader) && $one->page_loader) { ?>
<!-- Page loader (functionality is initialized in Template._uiHandlePageLoader()) -->
<!-- If #page-loader markup and also the "show" class is added, the loading screen will be enabled and auto hide once the page loads -->
<div id="page-loader" class="show"></div>

<?php } ?>
<!-- Page Container -->
<!--
    Available classes for #page-container:

GENERIC

    'enable-cookies'                            Remembers active color theme between pages (when set through color theme helper Template._uiHandleTheme())

SIDEBAR & SIDE OVERLAY

    'sidebar-r'                                 Right Sidebar and left Side Overlay (default is left Sidebar and right Side Overlay)
    'sidebar-mini'                              Mini hoverable Sidebar (screen width > 991px)
    'sidebar-o'                                 Visible Sidebar by default (screen width > 991px)
    'sidebar-o-xs'                              Visible Sidebar by default (screen width < 992px)
    'sidebar-dark'                              Dark themed sidebar

    'side-overlay-hover'                        Hoverable Side Overlay (screen width > 991px)
    'side-overlay-o'                            Visible Side Overlay by default

    'enable-page-overlay'                       Enables a visible clickable Page Overlay (closes Side Overlay on click) when Side Overlay opens

    'side-scroll'                               Enables custom scrolling on Sidebar and Side Overlay instead of native scrolling (screen width > 991px)

HEADER

    ''                                          Static Header if no class is added
    'page-header-fixed'                         Fixed Header

HEADER STYLE

    ''                                          Light themed Header
    'page-header-dark'                          Dark themed Header

MAIN CONTENT LAYOUT

    ''                                          Full width Main Content if no class is added
    'main-content-boxed'                        Full width Main Content with a specific maximum width (screen width > 1200px)
    'main-content-narrow'                       Full width Main Content with a percentage width (screen width > 1200px)
-->
<div id="page-container"<?php $one->page_classes(); ?>>
    <?php if(isset($one->inc_side_overlay) && $one->inc_side_overlay) { include($one->inc_side_overlay); } ?>
    <?php if(isset($one->inc_sidebar) && $one->inc_sidebar) { include($one->inc_sidebar); } ?>
    <?php if(isset($one->inc_header) && $one->inc_header) { include($one->inc_header); } ?>

    <!-- Main Container -->
    <main id="main-container">
