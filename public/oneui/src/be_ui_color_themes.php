<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Color Themes <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Carefully picked colors that will inspire and make you more productive.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Elements</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Color Themes</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Preview Color Themes -->
    <h2 class="content-heading">Preview Color Theme</h2>
    <div class="block">
        <div class="block-content block-content-full">
            <!-- Toggle Themes functionality initialized in Template._uiHandleTheme() -->
            <div class="row text-center">
                <div class="col-6 col-xl-2 py-4">
                    <a class="item item-link-pop item-circle bg-default text-white-75 mx-auto mb-3" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                        <i class="si si-drop"></i>
                    </a>
                    <div class="font-w600">Default</div>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <a class="item item-link-pop item-circle bg-amethyst text-white-75 mx-auto mb-3" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/amethyst.min.css" href="javascript:void(0)">
                        <i class="si si-drop"></i>
                    </a>
                    <div class="font-w600">Amethyst</div>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <a class="item item-link-pop item-circle bg-city text-white-75 mx-auto mb-3" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/city.min.css" href="javascript:void(0)">
                        <i class="si si-drop"></i>
                    </a>
                    <div class="font-w600">City</div>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <a class="item item-link-pop item-circle bg-flat text-white-75 mx-auto mb-3" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/flat.min.css" href="javascript:void(0)">
                        <i class="si si-drop"></i>
                    </a>
                    <div class="font-w600">Flat</div>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <a class="item item-link-pop item-circle bg-modern text-white-75 mx-auto mb-3" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/modern.min.css" href="javascript:void(0)">
                        <i class="si si-drop"></i>
                    </a>
                    <div class="font-w600">Modern</div>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <a class="item item-link-pop item-circle bg-smooth text-white-75 mx-auto mb-3" data-toggle="theme" data-theme="<?php echo $one->assets_folder; ?>/css/themes/smooth.min.css" href="javascript:void(0)">
                        <i class="si si-drop"></i>
                    </a>
                    <div class="font-w600">Smooth</div>
                </div>
            </div>
            <hr>
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <div class="row text-center">
                <div class="col-6 col-xl-2 offset-xl-1 py-4">
                    <a class="item item-link-pop item-circle bg-sidebar-light text-muted mx-auto mb-3" data-toggle="layout" data-action="sidebar_style_light" href="javascript:void(0)">
                        <i class="si si-drop"></i>
                    </a>
                    <div class="font-w600">Light Sidebar</div>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <a class="item item-link-pop item-circle bg-sidebar-dark text-white-75 mx-auto mb-3" data-toggle="layout" data-action="sidebar_style_dark" href="javascript:void(0)">
                        <i class="si si-drop"></i>
                    </a>
                    <div class="font-w600">Dark Sidebar</div>
                </div>
                <div class="col-6 col-xl-2 offset-xl-2 py-4">
                    <a class="item item-link-pop item-circle bg-header-light text-muted mx-auto mb-3" data-toggle="layout" data-action="header_style_light" href="javascript:void(0)">
                        <i class="si si-drop"></i>
                    </a>
                    <div class="font-w600">Light Header</div>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <a class="item item-link-pop item-circle bg-header-dark text-white-75 mx-auto mb-3" data-toggle="layout" data-action="header_style_dark" href="javascript:void(0)">
                        <i class="si si-drop"></i>
                    </a>
                    <div class="font-w600">Dark Header</div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Preview Color Themes -->

    <!-- Primary Colors -->
    <h2 class="content-heading">Primary Colors <small>Colors of the active color theme</small></h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row text-center">
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-primary-lighter mx-auto mb-3"></div>
                    <code>.bg-primary-lighter</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-primary-light mx-auto mb-3"></div>
                    <code>.bg-primary-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-primary mx-auto mb-3"></div>
                    <code>.bg-primary</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-primary-dark mx-auto mb-3"></div>
                    <code>.bg-primary-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-primary-darker mx-auto mb-3"></div>
                    <code>.bg-primary-darker</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-primary-op mx-auto mb-3"></div>
                    <code>.bg-primary-op</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-primary-dark-op mx-auto mb-3"></div>
                    <code>.bg-primary-dark-op</code>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-primary-lighter mb-3">Primary Lighter</div>
                    <code>.text-primary-lighter</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-primary-light mb-3">Primary Light</div>
                    <code>.text-primary-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="text-primary mb-3">Primary</div>
                    <code>.text-primary</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-primary-dark mb-3">Primary Dark</div>
                    <code>.text-primary-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-primary-darker mb-3">Primary Darker</div>
                    <code>.text-primary-darker</code>
                </div>
            </div>
        </div>
    </div>
    <!-- END Primary Colors -->

    <!-- Default Theme -->
    <h2 class="content-heading">Default Theme</h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row text-center">
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-default-lighter mx-auto mb-3"></div>
                    <code>.bg-default-lighter</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-default-light mx-auto mb-3"></div>
                    <code>.bg-default-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-default mx-auto mb-3"></div>
                    <code>.bg-default</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-default-dark mx-auto mb-3"></div>
                    <code>.bg-default-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-default-darker mx-auto mb-3"></div>
                    <code>.bg-default-darker</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-default-op mx-auto mb-3"></div>
                    <code>.bg-default-op</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-default-dark-op mx-auto mb-3"></div>
                    <code>.bg-default-dark-op</code>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-default-lighter mb-3">Default Lighter</div>
                    <code>.text-default-lighter</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-default-light mb-3">Default Light</div>
                    <code>.text-default-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="text-default mb-3">Default Main</div>
                    <code>.text-default</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-default-dark mb-3">Default Dark</div>
                    <code>.text-default-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-default-darker mb-3">Default Darker</div>
                    <code>.text-default-darker</code>
                </div>
            </div>
        </div>
    </div>
    <!-- END Default Theme -->

    <!-- Amethyst Theme -->
    <h2 class="content-heading">Amethyst Theme</h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row text-center">
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-amethyst-lighter mx-auto mb-3"></div>
                    <code>.bg-amethyst-lighter</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-amethyst-light mx-auto mb-3"></div>
                    <code>.bg-amethyst-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-amethyst mx-auto mb-3"></div>
                    <code>.bg-amethyst</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-amethyst-dark mx-auto mb-3"></div>
                    <code>.bg-amethyst-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-amethyst-darker mx-auto mb-3"></div>
                    <code>.bg-amethyst-darker</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-amethyst-op mx-auto mb-3"></div>
                    <code>.bg-amethyst-op</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-amethyst-dark-op mx-auto mb-3"></div>
                    <code>.bg-amethyst-dark-op</code>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-amethyst-lighter mb-3">Amethyst Lighter</div>
                    <code>.text-amethyst-lighter</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-amethyst-light mb-3">Amethyst Light</div>
                    <code>.text-amethyst-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="text-amethyst mb-3">Amethyst Main</div>
                    <code>.text-amethyst</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-amethyst-dark mb-3">Amethyst Dark</div>
                    <code>.text-amethyst-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-amethyst-darker mb-3">Amethyst Darker</div>
                    <code>.text-amethyst-darker</code>
                </div>
            </div>
        </div>
    </div>
    <!-- END Amethyst Theme -->

    <!-- City Theme -->
    <h2 class="content-heading">City Theme</h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row text-center">
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-city-lighter mx-auto mb-3"></div>
                    <code>.bg-city-lighter</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-city-light mx-auto mb-3"></div>
                    <code>.bg-city-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-city mx-auto mb-3"></div>
                    <code>.bg-city</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-city-dark mx-auto mb-3"></div>
                    <code>.bg-city-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-city-darker mx-auto mb-3"></div>
                    <code>.bg-city-darker</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-city-op mx-auto mb-3"></div>
                    <code>.bg-city-op</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-city-dark-op mx-auto mb-3"></div>
                    <code>.bg-city-dark-op</code>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-city-lighter mb-3">City Lighter</div>
                    <code>.text-city-lighter</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-city-light mb-3">City Light</div>
                    <code>.text-city-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="text-city mb-3">City Main</div>
                    <code>.text-city</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-city-dark mb-3">City Dark</div>
                    <code>.text-city-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-city-darker mb-3">City Darker</div>
                    <code>.text-city-darker</code>
                </div>
            </div>
        </div>
    </div>
    <!-- END City Theme -->

    <!-- Flat Theme -->
    <h2 class="content-heading">Flat Theme</h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row text-center">
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-flat-lighter mx-auto mb-3"></div>
                    <code>.bg-flat-lighter</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-flat-light mx-auto mb-3"></div>
                    <code>.bg-flat-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-flat mx-auto mb-3"></div>
                    <code>.bg-flat</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-flat-dark mx-auto mb-3"></div>
                    <code>.bg-flat-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-flat-darker mx-auto mb-3"></div>
                    <code>.bg-flat-darker</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-flat-op mx-auto mb-3"></div>
                    <code>.bg-flat-op</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-flat-dark-op mx-auto mb-3"></div>
                    <code>.bg-flat-dark-op</code>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-flat-lighter mb-3">Flat Lighter</div>
                    <code>.text-flat-lighter</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-flat-light mb-3">Flat Light</div>
                    <code>.text-flat-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="text-flat mb-3">Flat Main</div>
                    <code>.text-flat</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-flat-dark mb-3">Flat Dark</div>
                    <code>.text-flat-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-flat-darker mb-3">Flat Darker</div>
                    <code>.text-flat-darker</code>
                </div>
            </div>
        </div>
    </div>
    <!-- END Flat Theme -->

    <!-- Modern Theme -->
    <h2 class="content-heading">Modern Theme</h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row text-center">
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-modern-lighter mx-auto mb-3"></div>
                    <code>.bg-modern-lighter</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-modern-light mx-auto mb-3"></div>
                    <code>.bg-modern-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-modern mx-auto mb-3"></div>
                    <code>.bg-modern</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-modern-dark mx-auto mb-3"></div>
                    <code>.bg-modern-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-modern-darker mx-auto mb-3"></div>
                    <code>.bg-modern-darker</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-modern-op mx-auto mb-3"></div>
                    <code>.bg-modern-op</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-modern-dark-op mx-auto mb-3"></div>
                    <code>.bg-modern-dark-op</code>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-modern-lighter mb-3">Modern Lighter</div>
                    <code>.text-modern-lighter</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-modern-light mb-3">Modern Light</div>
                    <code>.text-modern-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="text-modern mb-3">Modern Main</div>
                    <code>.text-modern</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-modern-dark mb-3">Modern Dark</div>
                    <code>.text-modern-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-modern-darker mb-3">Modern Darker</div>
                    <code>.text-modern-darker</code>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modern Theme -->

    <!-- Smooth Theme -->
    <h2 class="content-heading">Smooth Theme</h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row text-center">
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-smooth-lighter mx-auto mb-3"></div>
                    <code>.bg-smooth-lighter</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-smooth-light mx-auto mb-3"></div>
                    <code>.bg-smooth-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="item item-circle bg-smooth mx-auto mb-3"></div>
                    <code>.bg-smooth</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-smooth-dark mx-auto mb-3"></div>
                    <code>.bg-smooth-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-smooth-darker mx-auto mb-3"></div>
                    <code>.bg-smooth-darker</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-smooth-op mx-auto mb-3"></div>
                    <code>.bg-smooth-op</code>
                </div>
                <div class="col-6 col-md-4 col-xl-3 py-4">
                    <div class="item item-circle bg-smooth-dark-op mx-auto mb-3"></div>
                    <code>.bg-smooth-dark-op</code>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-smooth-lighter mb-3">Smooth Lighter</div>
                    <code>.text-smooth-lighter</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-smooth-light mb-3">Smooth Light</div>
                    <code>.text-smooth-light</code>
                </div>
                <div class="col-6 col-md-4 py-4">
                    <div class="text-smooth mb-3">Smooth Main</div>
                    <code>.text-smooth</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-smooth-dark mb-3">Smooth Dark</div>
                    <code>.text-smooth-dark</code>
                </div>
                <div class="col-6 col-md-4 col-xl-2 py-4">
                    <div class="text-smooth-darker mb-3">Smooth Darker</div>
                    <code>.text-smooth-darker</code>
                </div>
            </div>
        </div>
    </div>
    <!-- END Smooth Theme -->

    <!-- Contextual Colors -->
    <h2 class="content-heading">Contextual Colors</h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row text-center">
                <div class="col-6 col-md-3 py-4">
                    <div class="item item-circle bg-success mx-auto mb-3"></div>
                    <code>.bg-success</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="item item-circle bg-info mx-auto mb-3"></div>
                    <code>.bg-info</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="item item-circle bg-warning mx-auto mb-3"></div>
                    <code>.bg-warning</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="item item-circle bg-danger mx-auto mb-3"></div>
                    <code>.bg-danger</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="item item-circle bg-success-light mx-auto mb-3"></div>
                    <code>.bg-success-light</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="item item-circle bg-info-light mx-auto mb-3"></div>
                    <code>.bg-info-light</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="item item-circle bg-warning-light mx-auto mb-3"></div>
                    <code>.bg-warning-light</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="item item-circle bg-danger-light mx-auto mb-3"></div>
                    <code>.bg-danger-light</code>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-6 col-md-3 py-4">
                    <div class="text-success mb-3">Success</div>
                    <code>.text-success</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="text-info mb-3">Info</div>
                    <code>.text-info</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="text-warning mb-3">Warning</div>
                    <code>.text-warning</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="text-danger mb-3">Danger</div>
                    <code>.text-danger</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="text-success-light mb-3">Success Light</div>
                    <code>.text-success-light</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="text-info-light mb-3">Info Light</div>
                    <code>.text-info-light</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="text-warning-light mb-3">Warning Light</div>
                    <code>.text-warning-light</code>
                </div>
                <div class="col-6 col-md-3 py-4">
                    <div class="text-danger-light mb-3">Danger Light</div>
                    <code>.text-danger-light</code>
                </div>
            </div>
        </div>
    </div>
    <!-- END Contextual Colors -->

    <!-- Gray Colors -->
    <h2 class="content-heading">Gray Colors</h2>
    <div class="block">
        <div class="block-content block-content-full">
            <div class="row text-center">
                <div class="col-6 col-xl-2 py-4">
                    <div class="item item-circle bg-gray-lighter mx-auto mb-3"></div>
                    <code>.bg-gray-lighter</code>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <div class="item item-circle bg-gray-light mx-auto mb-3"></div>
                    <code>.bg-gray-light</code>
                </div>
                <div class="col-xl-4 py-4">
                    <div class="item item-circle bg-gray mx-auto mb-3"></div>
                    <code>.bg-gray</code>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <div class="item item-circle bg-gray-dark mx-auto mb-3"></div>
                    <code>.bg-gray-dark</code>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <div class="item item-circle bg-gray-darker mx-auto mb-3"></div>
                    <code>.bg-gray-darker</code>
                </div>
            </div>
            <hr>
            <div class="row text-center">
                <div class="col-6 col-xl-2 py-4">
                    <div class="text-gray-lighter mb-3">Gray Lighter</div>
                    <code>.text-gray-lighter</code>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <div class="text-gray-light mb-3">Gray Light</div>
                    <code>.text-gray-light</code>
                </div>
                <div class="col-xl-4 py-4">
                    <div class="text-gray mb-3">Gray</div>
                    <code>.text-gray</code>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <div class="text-gray-dark mb-3">Gray Dark</div>
                    <code>.text-gray-dark</code>
                </div>
                <div class="col-6 col-xl-2 py-4">
                    <div class="text-gray-darker mb-3">Gray Darker</div>
                    <code>.text-gray-darker</code>
                </div>
            </div>
        </div>
    </div>
    <!-- END Gray Colors -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
