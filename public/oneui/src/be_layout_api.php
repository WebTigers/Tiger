<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">Layout API</h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Layout</li>
                    <li class="breadcrumb-item active" aria-current="page">API</li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Sidebar Visibility -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Sidebar Visibility</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter mb-0">
                    <thead>
                        <tr>
                            <th style="min-width: 300px; width: 300px;">Live</th>
                            <th style="min-width: 380px; width: 380px;">JS</th>
                            <th style="min-width: 400px;">Button Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_toggle">Toggle Sidebar</button>
                                <p class="font-size-sm mb-0">
                                    Opens or Closes the Sidebar based on its current state
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_toggle');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_toggle"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_open">Open Sidebar</button>
                                <p class="font-size-sm mb-0">
                                    Opens the Sidebar
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_open');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_open"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_close">Close Sidebar</button>
                                <p class="font-size-sm mb-0">
                                    Closes the Sidebar
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_close');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_close"</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Sidebar Visibility -->

    <!-- Sidebar Position -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Sidebar Position</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter mb-0">
                    <thead>
                        <tr>

                            <th style="min-width: 300px; width: 300px;">Live</th>
                            <th style="min-width: 380px; width: 380px;">JS</th>
                            <th style="min-width: 400px;">Button Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_pos_toggle">Toggle Sidebar Position</button>
                                <p class="font-size-sm mb-0">
                                    Sets the Sidebar position to the left or to the right based on its current position
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_pos_toggle');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_pos_toggle"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_pos_right">Right Sidebar Position</button>
                                <p class="font-size-sm mb-0">
                                    Moves the Sidebar to the right
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_pos_right');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_pos_right"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_pos_left">Left Sidebar Position</button>
                                <p class="font-size-sm mb-0">
                                    Moves the Sidebar to the left
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_pos_left');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_pos_left"</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Sidebar Position -->

    <!-- Sidebar Mini -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Sidebar Mini</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter mb-0">
                    <thead>
                        <tr>

                            <th style="min-width: 300px; width: 300px;">Live</th>
                            <th style="min-width: 380px; width: 380px;">JS</th>
                            <th style="min-width: 400px;">Button Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_mini_toggle">Toggle Mini Mode</button>
                                <p class="font-size-sm mb-0">
                                    Toggles the Sidebar mini mode
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_mini_toggle');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_mini_toggle"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_mini_on">Enable Mini Mode</button>
                                <p class="font-size-sm mb-0">
                                    Enables the Sidebar mini mode
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_mini_on');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_mini_on"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_mini_off">Disable Mini Mode</button>
                                <p class="font-size-sm mb-0">
                                    Disables the Sidebar mini mode
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_mini_off');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_mini_off"</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Sidebar Mini -->

    <!-- Sidebar Styles -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Sidebar Styles</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter mb-0">
                    <thead>
                        <tr>

                            <th style="min-width: 300px; width: 300px;">Live</th>
                            <th style="min-width: 380px; width: 380px;">JS</th>
                            <th style="min-width: 400px;">Button Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_style_toggle">Toggle Sidebar Style</button>
                                <p class="font-size-sm mb-0">
                                    Toggles Sidebar style between light and dark variations
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_style_toggle');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_style_toggle"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_style_light">Light Themed Sidebar</button>
                                <p class="font-size-sm mb-0">
                                    Sets the Sidebar to light variation
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_style_light');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_style_light"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="sidebar_style_dark">Dark Themed Sidebar</button>
                                <p class="font-size-sm mb-0">
                                    Sets the Sidebar to dark variation
                                </p>
                            </td>
                            <td>
                                <code>One.layout('sidebar_style_dark');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="sidebar_style_dark"</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Sidebar Styles -->

    <!-- Side Overlay Visibility -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Side Overlay Visibility</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter mb-0">
                    <thead>
                        <tr>

                            <th style="min-width: 300px; width: 300px;">Live</th>
                            <th style="min-width: 380px; width: 380px;">JS</th>
                            <th style="min-width: 400px;">Button Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="side_overlay_toggle">Toggle Side Overlay</button>
                                <p class="font-size-sm mb-0">
                                    Opens or Closes the Side Overlay based on its current state
                                </p>
                            </td>
                            <td>
                                <code>One.layout('side_overlay_toggle');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="side_overlay_toggle"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="side_overlay_open">Open Side Overlay</button>
                                <p class="font-size-sm mb-0">
                                    Opens the Side Overlay
                                </p>
                            </td>
                            <td>
                                <code>One.layout('side_overlay_open');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="side_overlay_open"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="side_overlay_close">Close Side Overlay</button>
                                <p class="font-size-sm mb-0">
                                    Closes the Side Overlay
                                </p>
                            </td>
                            <td>
                                <code>One.layout('side_overlay_close');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="side_overlay_close"</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Side Overlay Visibility -->

    <!-- Side Overlay Hover Mode -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Side Overlay Hover Mode</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter mb-0">
                    <thead>
                        <tr>

                            <th style="min-width: 300px; width: 300px;">Live</th>
                            <th style="min-width: 380px; width: 380px;">JS</th>
                            <th style="min-width: 400px;">Button Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="side_overlay_mode_hover_toggle">Toggle Hover Mode</button>
                                <p class="font-size-sm mb-0">
                                    Toggles the Side Overlay hover mode
                                </p>
                            </td>
                            <td>
                                <code>One.layout('side_overlay_mode_hover_toggle');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="side_overlay_mode_hover_toggle"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="side_overlay_mode_hover_on">Enable Hover Mode</button>
                                <p class="font-size-sm mb-0">
                                    Enables the Side Overlay hover mode
                                </p>
                            </td>
                            <td>
                                <code>One.layout('side_overlay_mode_hover_on');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="side_overlay_mode_hover_on"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="side_overlay_mode_hover_off">Disable Hover Mode</button>
                                <p class="font-size-sm mb-0">
                                    Disables the Side Overlay hover mode
                                </p>
                            </td>
                            <td>
                                <code>One.layout('side_overlay_mode_hover_off');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="side_overlay_mode_hover_off"</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Side Overlay Hover Mode -->

    <!-- Side Scrolling -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Side Scrolling</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter mb-0">
                    <thead>
                        <tr>

                            <th style="min-width: 300px; width: 300px;">Live</th>
                            <th style="min-width: 380px; width: 380px;">JS</th>
                            <th style="min-width: 400px;">Button Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="side_scroll_toggle">Toggle Side Scrolling</button>
                                <p class="font-size-sm mb-0">
                                    Toggles between native and custom scrolling in Sidebar and Side Overlay
                                </p>
                            </td>
                            <td>
                                <code>One.layout('side_scroll_toggle');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="side_scroll_toggle"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="side_scroll_native">Enable Native Scrolling</button>
                                <p class="font-size-sm mb-0">
                                    Enables native scrolling in Sidebar and Side Overlay
                                </p>
                            </td>
                            <td>
                                <code>One.layout('side_scroll_native');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="side_scroll_native"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="side_scroll_custom">Enable Custom Scrolling</button>
                                <p class="font-size-sm mb-0">
                                    Enables custom scrolling in Sidebar and Side Overlay
                                </p>
                            </td>
                            <td>
                                <code>One.layout('side_scroll_custom');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="side_scroll_custom"</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Side Scrolling -->

    <!-- Header Mode -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Header Mode</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter mb-0">
                    <thead>
                        <tr>

                            <th style="min-width: 300px; width: 300px;">Live</th>
                            <th style="min-width: 380px; width: 380px;">JS</th>
                            <th style="min-width: 400px;">Button Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="header_mode_toggle">Toggle Header Mode</button>
                                <p class="font-size-sm mb-0">
                                    Toggles Header mode between static and fixed
                                </p>
                            </td>
                            <td>
                                <code>One.layout('header_mode_toggle');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="header_mode_toggle"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="header_mode_static">Static Header</button>
                                <p class="font-size-sm mb-0">
                                    Sets the Header to static mode
                                </p>
                            </td>
                            <td>
                                <code>One.layout('header_mode_static');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="header_mode_static"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="header_mode_fixed">Fixed Header</button>
                                <p class="font-size-sm mb-0">
                                    Sets the Header to fixed mode
                                </p>
                            </td>
                            <td>
                                <code>One.layout('header_mode_fixed');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="header_mode_fixed"</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Header Mode -->

    <!-- Header Styles -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Header Styles</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter mb-0">
                    <thead>
                        <tr>

                            <th style="min-width: 300px; width: 300px;">Live</th>
                            <th style="min-width: 380px; width: 380px;">JS</th>
                            <th style="min-width: 400px;">Button Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="header_style_toggle">Toggle Header Style</button>
                                <p class="font-size-sm mb-0">
                                    Toggles Header style between light and dark variations
                                </p>
                            </td>
                            <td>
                                <code>One.layout('header_style_toggle');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="header_style_toggle"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="header_style_light">Light Themed Header</button>
                                <p class="font-size-sm mb-0">
                                    Sets the Header to light variation
                                </p>
                            </td>
                            <td>
                                <code>One.layout('header_style_light');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="header_style_light"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="header_style_dark">Dark Themed Header</button>
                                <p class="font-size-sm mb-0">
                                    Sets the Header to dark variation
                                </p>
                            </td>
                            <td>
                                <code>One.layout('header_style_dark');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="header_style_dark"</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Header Styles -->

    <!-- Main Content -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Main Content</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="table-responsive">
                <table class="table table-striped table-vcenter mb-0">
                    <thead>
                        <tr>

                            <th style="min-width: 300px; width: 300px;">Live</th>
                            <th style="min-width: 380px; width: 380px;">JS</th>
                            <th style="min-width: 400px;">Button Attributes</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="content_layout_toggle">Toggle Content Layout</button>
                                <p class="font-size-sm mb-0">
                                    Toggles between all available content layouts (boxed, narrow and full width)
                                </p>
                            </td>
                            <td>
                                <code>One.layout('content_layout_toggle');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="content_layout_toggle"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="content_layout_boxed">Boxed Content Layout</button>
                                <p class="font-size-sm mb-0">
                                    Sets the content layout to boxed
                                </p>
                            </td>
                            <td>
                                <code>One.layout('content_layout_boxed');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="content_layout_boxed"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="content_layout_narrow">Narrow Content Layout</button>
                                <p class="font-size-sm mb-0">
                                    Sets the content layout to narrow
                                </p>
                            </td>
                            <td>
                                <code>One.layout('content_layout_narrow');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="content_layout_narrow"</code>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="layout" data-action="content_layout_full_width">Full Width Content Layout</button>
                                <p class="font-size-sm mb-0">
                                    Sets the content layout to full width
                                </p>
                            </td>
                            <td>
                                <code>One.layout('content_layout_full_width');</code>
                            </td>
                            <td>
                                <code>data-toggle="layout" data-action="content_layout_full_width"</code>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Main Content -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
