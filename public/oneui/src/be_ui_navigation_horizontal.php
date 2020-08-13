<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php
// Set up a custom navigation array
$one_example_nav = array(
    array(
        'name'  => 'Home',
        'icon'  => 'fa fa-home',
        'badge' => array(5, 'primary'),
        'url'   => 'be_ui_navigation_horizontal.php'
    ),
    array(
        'name'  => 'Manage',
        'type'  => 'heading'
    ),
    array(
        'name'  => 'Products',
        'icon'  => 'fa fa-briefcase',
        'sub'   => array(
            array(
                'name'  => 'HTML Templates',
                'icon'  => 'fab fa-html5',
                'sub'   => array(
                    array(
                        'name'  => 'Description',
                        'icon'  => 'fa fa-pencil-alt',
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Statistics',
                        'icon'  => 'fa fa-chart-line',
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Sales',
                        'icon'  => 'fa fa-chart-area',
                        'badge' => array(320, 'primary'),
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Media',
                        'icon'  => 'far fa-images',
                        'badge' => array(18, 'primary'),
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Files',
                        'icon'  => 'far fa-file-alt',
                        'badge' => array(32, 'primary'),
                        'url'   => 'javascript:void(0)'
                    )
                )
            ),
            array(
                'name'  => 'WordPress Themes',
                'icon'  => 'fab fa-wordpress',
                'sub'   => array(
                    array(
                        'name'  => 'Description',
                        'icon'  => 'fa fa-pencil-alt',
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Statistics',
                        'icon'  => 'fa fa-chart-line',
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Sales',
                        'icon'  => 'fa fa-chart-area',
                        'badge' => array(680, 'primary'),
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Media',
                        'icon'  => 'far fa-images',
                        'badge' => array(15, 'primary'),
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Files',
                        'icon'  => 'far fa-file-alt',
                        'badge' => array(20, 'primary'),
                        'url'   => 'javascript:void(0)'
                    )
                )
            ),
            array(
                'name'  => 'Web Applications',
                'icon'  => 'fab fa-medapps',
                'sub'   => array(
                    array(
                        'name'  => 'Description',
                        'icon'  => 'fa fa-pencil-alt',
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Statistics',
                        'icon'  => 'fa fa-chart-line',
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Sales',
                        'icon'  => 'fa fa-chart-area',
                        'badge' => array(158, 'primary'),
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Media',
                        'icon'  => 'far fa-images',
                        'badge' => array(65, 'primary'),
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Files',
                        'icon'  => 'far fa-file-alt',
                        'badge' => array(78, 'primary'),
                        'url'   => 'javascript:void(0)'
                    )
                )
            ),
            array(
                'name'  => 'Video Templates',
                'icon'  => 'fab fa-youtube',
                'sub'   => array(
                    array(
                        'name'  => 'Description',
                        'icon'  => 'fa fa-pencil-alt',
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Statistics',
                        'icon'  => 'fa fa-chart-line',
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Sales',
                        'icon'  => 'fa fa-chart-area',
                        'badge' => array(920, 'primary'),
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Media',
                        'icon'  => 'far fa-images',
                        'badge' => array(7, 'primary'),
                        'url'   => 'javascript:void(0)'
                    ),
                    array(
                        'name'  => 'Files',
                        'icon'  => 'far fa-file-alt',
                        'badge' => array(19, 'primary'),
                        'url'   => 'javascript:void(0)'
                    )
                )
            ),
            array(
                'name'  => 'Add Product',
                'icon'  => 'fa fa-plus',
                'url'   => 'javascript:void(0)'
            )
        )
    ),
    array(
        'name'  => 'Payments',
        'icon'  => 'fa fa-money-bill-wave',
        'sub'   => array(
            array(
                'name'  => 'Scheduled',
                'badge' => array(3, 'success'),
                'url'   => 'javascript:void(0)'
            ),
            array(
                'name'  => 'Recurring',
                'url'   => 'javascript:void(0)'
            ),
            array(
                'name'  => 'Manage',
                'url'   => 'javascript:void(0)'
            ),
            array(
                'name'  => 'New Payment',
                'icon'  => 'fa fa-plus',
                'url'   => 'javascript:void(0)'
            )
        )
    ),
    array(
        'name'  => 'Services',
        'icon'  => 'fa fa-globe-americas',
        'sub'   => array(
            array(
                'name'  => 'Hosting',
                'url'   => 'javascript:void(0)'
            ),
            array(
                'name'  => 'Web Design',
                'url'   => 'javascript:void(0)'
            ),
            array(
                'name'  => 'Web Development',
                'url'   => 'javascript:void(0)'
            ),
            array(
                'name'  => 'Graphic Design',
                'url'   => 'javascript:void(0)'
            ),
            array(
                'name'  => 'Legal',
                'url'   => 'javascript:void(0)'
            ),
            array(
                'name'  => 'Consulting',
                'url'   => 'javascript:void(0)'
            )
        )
    ),
    array(
        'name'  => 'Personal',
        'type'  => 'heading'
    ),
    array(
        'name'  => 'Profile',
        'icon'  => 'far fa-user',
        'sub'   => array(
            array(
                'name'  => 'Edit',
                'url'   => 'javascript:void(0)'
            ),
            array(
                'name'  => 'Settings',
                'url'   => 'javascript:void(0)'
            ),
            array(
                'name'  => 'Log out',
                'url'   => 'javascript:void(0)'
            )
        )
    )
);
?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Horizontal Navigation <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Easily adjust main navigation style to work horizontally as well</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Elements</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Horizontal Navigation</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <h2 class="content-heading">Hover based on large screens</h2>

    <!-- Horizontal Navigation - Hover Normal -->
    <div class="bg-white p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-light d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-hover-normal" data-class="d-none">
                Menu - Hover Normal
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-hover-normal" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-hover">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Hover Normal -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Left aligned, light themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <!-- Horizontal Navigation - Hover Normal Dark -->
    <div class="bg-sidebar-dark p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-secondary d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-hover-normal-dark" data-class="d-none">
                Menu - Hover Normal Dark
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-hover-normal-dark" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-hover nav-main-dark">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Hover Normal Dark -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Left aligned, dark themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <!-- Horizontal Navigation - Hover Centered -->
    <div class="bg-white p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-light d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-hover-centered" data-class="d-none">
                Menu - Hover Centered
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-hover-centered" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-hover nav-main-horizontal-center">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Hover Centered -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Center aligned, light themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <!-- Horizontal Navigation - Hover Centered Dark -->
    <div class="bg-sidebar-dark p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-secondary d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-hover-centered-dark" data-class="d-none">
                Menu - Hover Centered Dark
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-hover-centered-dark" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-hover nav-main-horizontal-center nav-main-dark">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Hover Centered Dark -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Center aligned, dark themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <!-- Horizontal Navigation - Hover Justified -->
    <div class="bg-white p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-light d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-hover-justified" data-class="d-none">
                Menu - Hover Justified
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-hover-justified" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-hover nav-main-horizontal-justify">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Hover Justified -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Justified, light themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <!-- Horizontal Navigation - Hover Justified Dark -->
    <div class="bg-sidebar-dark p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-secondary d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-hover-justified-dark" data-class="d-none">
                Menu - Hover Justified Dark
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-hover-justified-dark" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-hover nav-main-horizontal-justify nav-main-dark">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Hover Justified Dark -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Justified, dark themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <h2 class="content-heading">Click based on large screens</h2>

    <!-- Horizontal Navigation - Click Normal -->
    <div class="bg-white p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-light d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-click-normal" data-class="d-none">
                Menu - Click Normal
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-click-normal" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Click Normal -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Left aligned, light themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <!-- Horizontal Navigation - Click Normal Dark -->
    <div class="bg-sidebar-dark p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-secondary d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-click-normal-dark" data-class="d-none">
                Menu - Click Normal Dark
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-click-normal-dark" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-dark">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Click Normal Dark -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Left aligned, dark themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <!-- Horizontal Navigation - Click Centered -->
    <div class="bg-white p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-light d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-click-centered" data-class="d-none">
                Menu - Click Centered
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-click-centered" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-horizontal-center">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Click Centered -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Center aligned, light themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <!-- Horizontal Navigation - Click Centered Dark -->
    <div class="bg-sidebar-dark p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-secondary d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-click-centered-dark" data-class="d-none">
                Menu - Click Centered Dark
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-click-centered-dark" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-horizontal-center nav-main-dark">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Click Centered Dark -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Center aligned, dark themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <!-- Horizontal Navigation - Click Justified -->
    <div class="bg-white p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-light d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-click-justified" data-class="d-none">
                Menu - Click Justified
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-click-justified" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-horizontal-justify">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Click Justified -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Justified, light themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->

    <!-- Horizontal Navigation - Click Justified Dark -->
    <div class="bg-sidebar-dark p-3 push">
        <!-- Toggle Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-secondary d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#horizontal-navigation-click-justified-dark" data-class="d-none">
                Menu - Click Justified
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Navigation -->

        <!-- Navigation -->
        <div id="horizontal-navigation-click-justified-dark" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-click nav-main-horizontal-justify nav-main-dark">
                <?php $one->build_nav($one_example_nav, true); ?>
            </ul>
        </div>
        <!-- END Navigation -->
    </div>
    <!-- END Horizontal Navigation - Click Justified Dark -->

    <!-- Dummy content -->
    <div class="block d-none d-lg-block">
        <div class="block-content">
            <p class="text-center py-8">
                Justified, dark themed
            </p>
        </div>
    </div>
    <!-- END Dummy content -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
