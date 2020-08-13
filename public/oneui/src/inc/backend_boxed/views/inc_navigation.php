<?php
/**
 * backend_boxed/views/inc_navigation.php
 *
 * Author: pixelcave
 *
 * The navigation section of each page
 *
 */
?>

<!-- Navigation -->
<div class="bg-white">
    <div class="content py-3">
        <!-- Toggle Main Navigation -->
        <div class="d-lg-none">
            <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
            <button type="button" class="btn btn-block btn-alt-secondary d-flex justify-content-between align-items-center" data-toggle="class-toggle" data-target="#main-navigation" data-class="d-none">
                Menu
                <i class="fa fa-bars"></i>
            </button>
        </div>
        <!-- END Toggle Main Navigation -->

        <!-- Main Navigation -->
        <div id="main-navigation" class="d-none d-lg-block mt-2 mt-lg-0">
            <ul class="nav-main nav-main-horizontal nav-main-hover">
                <?php $one->build_nav(false, true); ?>
                <li class="nav-main-heading">Extra</li>
                <li class="nav-main-item ml-lg-auto">
                    <a class="nav-main-link nav-main-link-submenu" data-toggle="submenu" aria-haspopup="true" aria-expanded="false" href="#">
                        <i class="nav-main-link-icon si si-drop"></i>
                        <span class="nav-main-link-name d-lg-none">Themes</span>
                    </a>
                    <ul class="nav-main-submenu nav-main-submenu-right">
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="theme" data-theme="default" href="#">
                                <i class="nav-main-link-icon fa fa-square text-default"></i>
                                <span class="nav-main-link-name">Default</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/amethyst.min.css" href="#">
                                <i class="nav-main-link-icon fa fa-square text-amethyst"></i>
                                <span class="nav-main-link-name">Amethyst</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/city.min.css" href="#">
                                <i class="nav-main-link-icon fa fa-square text-city"></i>
                                <span class="nav-main-link-name">City</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/flat.min.css" href="#">
                                <i class="nav-main-link-icon fa fa-square text-flat"></i>
                                <span class="nav-main-link-name">Flat</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/modern.min.css" href="#">
                                <i class="nav-main-link-icon fa fa-square text-modern"></i>
                                <span class="nav-main-link-name">Modern</span>
                            </a>
                        </li>
                        <li class="nav-main-item">
                            <a class="nav-main-link" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/smooth.min.css" href="#">
                                <i class="nav-main-link-icon fa fa-square text-smooth"></i>
                                <span class="nav-main-link-name">Smooth</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- END Main Navigation -->
    </div>
</div>
<!-- END Navigation -->