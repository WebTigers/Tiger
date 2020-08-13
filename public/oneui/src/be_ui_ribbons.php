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
                Ribbons <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Easily add cool ribbons to your blocks.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Elements</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Ribbons</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Simple Ribbon -->
    <h2 class="content-heading">Simple Ribbon</h2>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <!-- Default Position Primary -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary">
                    <div class="ribbon-box">
                        $28
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fab fa-3x fa-html5 text-gray"></i>
                        </p>
                        <h4 class="mb-0">Learn HTML5</h4>
                    </div>
                </div>
            </div>
            <!-- END Default Position Primary -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Bottom Right Primary -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary ribbon-bottom">
                    <div class="ribbon-box">
                        $28
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fab fa-3x fa-html5 text-gray"></i>
                        </p>
                        <h4 class="mb-0">Learn HTML5</h4>
                    </div>
                </div>
            </div>
            <!-- END Bottom Right Primary -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Bottom Left Primary -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary ribbon-left ribbon-bottom">
                    <div class="ribbon-box">
                        $28
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fab fa-3x fa-html5 text-gray"></i>
                        </p>
                        <h4 class="mb-0">Learn HTML5</h4>
                    </div>
                </div>
            </div>
            <!-- END Bottom Left Primary -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Top Left Primary -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary ribbon-left">
                    <div class="ribbon-box">
                        $28
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fab fa-3x fa-html5 text-gray"></i>
                        </p>
                        <h4 class="mb-0">Learn HTML5</h4>
                    </div>
                </div>
            </div>
            <!-- END Top Left Primary -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Bottom Right Success -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-success">
                    <div class="ribbon-box">
                        $32
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fab fa-3x fa-css3 text-gray"></i>
                        </p>
                        <h4 class="mb-0">Discover CSS3</h4>
                    </div>
                </div>
            </div>
            <!-- END Bottom Right Success -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Default Position Info -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-info">
                    <div class="ribbon-box">
                        $32
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fab fa-3x fa-css3 text-gray"></i>
                        </p>
                        <h4 class="mb-0">Discover CSS3</h4>
                    </div>
                </div>
            </div>
            <!-- END Default Position Info -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Bottom Left Warning -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-warning">
                    <div class="ribbon-box">
                        $32
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fab fa-3x fa-css3 text-gray"></i>
                        </p>
                        <h4 class="mb-0">Discover CSS3</h4>
                    </div>
                </div>
            </div>
            <!-- END Bottom Left Warning -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Top Left Primary Danger -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-danger">
                    <div class="ribbon-box">
                        $32
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fab fa-3x fa-css3 text-gray"></i>
                        </p>
                        <h4 class="mb-0">Discover CSS3</h4>
                    </div>
                </div>
            </div>
            <!-- END Top Left Primary Danger -->
        </div>
        <div class="col-md-6">
            <!-- Glass on Background Color -->
            <div class="block">
                <div class="block-content block-content-full bg-primary ribbon ribbon-glass">
                    <div class="ribbon-box">
                        <i class="fa fa-check mr-1"></i> Crystal
                    </div>
                    <div class="text-center py-6">
                        <h4 class="text-white mb-0">Awesome Color</h4>
                    </div>
                </div>
            </div>
            <!-- END Glass on Background Color -->
        </div>
        <div class="col-md-6">
            <!-- Glass on Background Image -->
            <div class="block block-rounded">
                <div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo25.jpg');">
                    <div class="block-content block-content-full bg-black-50 ribbon ribbon-glass">
                        <div class="ribbon-box">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="text-center py-6">
                            <h4 class="font-w600 text-white mb-0">Awesome Image</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Glass on Background Image -->
        </div>
    </div>
    <!-- END Simple Ribbon -->

    <!-- Bookmark Ribbon -->
    <h2 class="content-heading">Bookmark Ribbon</h2>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <!-- Default Position -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary ribbon-bookmark">
                    <div class="ribbon-box">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fa fa-3x fa-cog text-gray"></i>
                        </p>
                        <h4 class="mb-0">Settings</h4>
                    </div>
                </div>
            </div>
            <!-- END Default Position -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Bottom Right -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary ribbon-bottom ribbon-bookmark">
                    <div class="ribbon-box">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fa fa-3x fa-cog text-gray"></i>
                        </p>
                        <h4 class="mb-0">Settings</h4>
                    </div>
                </div>
            </div>
            <!-- END Bottom Right -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Bottom Left -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary ribbon-left ribbon-bottom ribbon-bookmark">
                    <div class="ribbon-box">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fa fa-3x fa-cog text-gray"></i>
                        </p>
                        <h4 class="mb-0">Settings</h4>
                    </div>
                </div>
            </div>
            <!-- END Bottom Left -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Top Left -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-left ribbon-bookmark ribbon-primary">
                    <div class="ribbon-box">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fa fa-3x fa-cog text-gray"></i>
                        </p>
                        <h4 class="mb-0">Settings</h4>
                    </div>
                </div>
            </div>
            <!-- END Top Left -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Success Color -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-success">
                    <div class="ribbon-box">
                        <i class="fa fa-fw fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fa fa-3x fa-wrench text-gray"></i>
                        </p>
                        <h4 class="mb-0">Options</h4>
                    </div>
                </div>
            </div>
            <!-- END Success Color -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Info Color -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-info">
                    <div class="ribbon-box">
                        <i class="fa fa-fw fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fa fa-3x fa-wrench text-gray"></i>
                        </p>
                        <h4 class="mb-0">Options</h4>
                    </div>
                </div>
            </div>
            <!-- END Info Color -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Warning Color -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-warning">
                    <div class="ribbon-box">
                        <i class="fa fa-fw fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fa fa-3x fa-wrench text-gray"></i>
                        </p>
                        <h4 class="mb-0">Options</h4>
                    </div>
                </div>
            </div>
            <!-- END Warning Color -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Danger Color -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-bookmark ribbon-danger">
                    <div class="ribbon-box">
                        <i class="fa fa-fw fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="fa fa-3x fa-wrench text-gray"></i>
                        </p>
                        <h4 class="mb-0">Options</h4>
                    </div>
                </div>
            </div>
            <!-- END Danger Color -->
        </div>
        <div class="col-md-6">
            <!-- Glass on Background Color -->
            <div class="block">
                <div class="block-content block-content-full bg-primary ribbon ribbon-bookmark ribbon-glass">
                    <div class="ribbon-box">
                        <i class="fa fa-check mr-1"></i> Crystal
                    </div>
                    <div class="text-center py-6">
                        <h4 class="text-white mb-0">Awesome Color</h4>
                    </div>
                </div>
            </div>
            <!-- END Glass on Background Color -->
        </div>
        <div class="col-md-6">
            <!-- Glass on Background Image -->
            <div class="block block-rounded">
                <div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo25.jpg');">
                    <div class="block-content block-content-full bg-black-50 ribbon ribbon-bookmark ribbon-glass">
                        <div class="ribbon-box">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="text-center py-6">
                            <h4 class="font-w600 text-white mb-0">Awesome Image</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Glass on Background Image -->
        </div>
    </div>
    <!-- END Bookmark Ribbon -->

    <!-- Modern Ribbon -->
    <h2 class="content-heading">Modern Ribbon</h2>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <!-- Default Position -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary ribbon-modern">
                    <div class="ribbon-box">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-copy text-gray"></i>
                        </p>
                        <h4 class="mb-0">Files</h4>
                    </div>
                </div>
            </div>
            <!-- END Default Position -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Bottom Right -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary ribbon-bottom ribbon-modern">
                    <div class="ribbon-box">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-copy text-gray"></i>
                        </p>
                        <h4 class="mb-0">Files</h4>
                    </div>
                </div>
            </div>
            <!-- END Bottom Right -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Bottom Left -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary ribbon-left ribbon-bottom ribbon-modern">
                    <div class="ribbon-box">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-copy text-gray"></i>
                        </p>
                        <h4 class="mb-0">Files</h4>
                    </div>
                </div>
            </div>
            <!-- END Bottom Left -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Top Left -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-primary ribbon-left ribbon-modern">
                    <div class="ribbon-box">
                        <i class="far fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-copy text-gray"></i>
                        </p>
                        <h4 class="mb-0">Files</h4>
                    </div>
                </div>
            </div>
            <!-- END Top Left -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Success Color -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-modern ribbon-success">
                    <div class="ribbon-box">
                        <i class="fa fa-fw fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-image text-gray"></i>
                        </p>
                        <h4 class="mb-0">Photos</h4>
                    </div>
                </div>
            </div>
            <!-- END Success Color -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Info Color -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-modern ribbon-info">
                    <div class="ribbon-box">
                        <i class="fa fa-fw fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-image text-gray"></i>
                        </p>
                        <h4 class="mb-0">Photos</h4>
                    </div>
                </div>
            </div>
            <!-- END Info Color -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Warning Color -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-modern ribbon-warning">
                    <div class="ribbon-box">
                        <i class="fa fa-fw fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-image text-gray"></i>
                        </p>
                        <h4 class="mb-0">Photos</h4>
                    </div>
                </div>
            </div>
            <!-- END Warning Color -->
        </div>
        <div class="col-md-6 col-xl-3">
            <!-- Danger Color -->
            <div class="block">
                <div class="block-content block-content-full ribbon ribbon-modern ribbon-danger">
                    <div class="ribbon-box">
                        <i class="fa fa-fw fa-heart"></i>
                    </div>
                    <div class="text-center py-4">
                        <p>
                            <i class="far fa-3x fa-image text-gray"></i>
                        </p>
                        <h4 class="mb-0">Photos</h4>
                    </div>
                </div>
            </div>
            <!-- END Danger Color -->
        </div>
        <div class="col-md-6">
            <!-- Glass on Background Color -->
            <div class="block">
                <div class="block-content block-content-full bg-primary ribbon ribbon-modern ribbon-glass">
                    <div class="ribbon-box">
                        <i class="fa fa-check mr-1"></i> Crystal
                    </div>
                    <div class="text-center py-6">
                        <h4 class="text-white mb-0">Awesome Color</h4>
                    </div>
                </div>
            </div>
            <!-- END Glass on Background Color -->
        </div>
        <div class="col-md-6">
            <!-- Glass on Background Image -->
            <div class="block block-rounded">
                <div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo25.jpg');">
                    <div class="block-content block-content-full bg-black-50 ribbon ribbon-modern ribbon-bottom ribbon-glass">
                        <div class="ribbon-box">
                            <i class="fa fa-check"></i>
                        </div>
                        <div class="text-center py-6">
                            <h4 class="font-w600 text-white mb-0">Awesome Image</h4>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Glass on Background Image -->
        </div>
    </div>
    <!-- END Modern Ribbon -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
