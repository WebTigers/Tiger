<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/slick-carousel/slick.css'); ?>
<?php $one->get_css('js/plugins/slick-carousel/slick-theme.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Sliders <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Draggable with mouse and touch, flexible and mobile friendly content sliders.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Sliders</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<!-- Slick Slider (.js-slider class is initialized in Helpers.slick()) -->
<!-- For more info and examples you can check out http://kenwheeler.github.io/slick/ -->
<!--
    Extra Classes:

    'slick-nav-white'    for white navigation buttons
    'slick-nav-black'    for black navigation buttons
    'slick-nav-hover'    for navigation buttons visible on hover

    'slick-dotted-white' for white dots
    'slick-dotted-inner' for overlaying dots inside the slides

-->
<div class="content">
    <!-- Avatar Sliders -->
    <h2 class="content-heading">Avatar Sliders</h2>
    <div class="row">
        <div class="col-md-8">
            <!-- Slider with Multiple Slides/Avatars -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">
                        Multiple Avatars
                    </h3>
                </div>
                <div class="block-content">
                    <div class="js-slider text-center" data-autoplay="true" data-dots="true" data-arrows="true" data-slides-to-show="3">
                        <div class="py-3">
                            <?php $one->get_avatar(4); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('female'); ?></div>
                            <div class="font-size-sm text-muted">Graphic Designer</div>
                        </div>
                        <div class="py-3">
                            <?php $one->get_avatar(5); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('female'); ?></div>
                            <div class="font-size-sm text-muted">Photographer</div>
                        </div>
                        <div class="py-3">
                            <?php $one->get_avatar(6); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('female'); ?></div>
                            <div class="font-size-sm text-muted">Web Developer</div>
                        </div>
                        <div class="py-3">
                            <?php $one->get_avatar(1); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('female'); ?></div>
                            <div class="font-size-sm text-muted">Web Designer</div>
                        </div>
                        <div class="py-3">
                            <?php $one->get_avatar(2); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('female'); ?></div>
                            <div class="font-size-sm text-muted">Font Designer</div>
                        </div>
                        <div class="py-3">
                            <?php $one->get_avatar(3); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('female'); ?></div>
                            <div class="font-size-sm text-muted">Artist</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Slider with Multiple Slides/Avatars -->
        </div>
        <div class="col-md-4">
            <!-- Slider with Avatars -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Single Avatar</h3>
                </div>
                <div class="block-content">
                    <div class="js-slider text-center" data-dots="true" data-arrows="true">
                        <div class="py-3">
                            <?php $one->get_avatar(14); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('male'); ?></div>
                            <div class="font-size-sm text-muted">Graphic Designer</div>
                        </div>
                        <div class="py-3">
                            <?php $one->get_avatar(12); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('male'); ?></div>
                            <div class="font-size-sm text-muted">Photographer</div>
                        </div>
                        <div class="py-3">
                            <?php $one->get_avatar(13); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('male'); ?></div>
                            <div class="font-size-sm text-muted">Web Developer</div>
                        </div>
                        <div class="py-3">
                            <?php $one->get_avatar(9); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('male'); ?></div>
                            <div class="font-size-sm text-muted">Web Designer</div>
                        </div>
                        <div class="py-3">
                            <?php $one->get_avatar(10); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('male'); ?></div>
                            <div class="font-size-sm text-muted">Font Designer</div>
                        </div>
                        <div class="py-3">
                            <?php $one->get_avatar(11); ?>
                            <div class="mt-2 font-w600"><?php $one->get_name('male'); ?></div>
                            <div class="font-size-sm text-muted">Artist</div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Slider with Avatars -->
        </div>
    </div>
    <!-- END Avatar Sliders -->

    <!-- Content Sliders -->
    <h2 class="content-heading">Content Sliders</h2>
    <div class="row">
        <div class="col-md-4">
            <!-- Tiles Slider 1 -->
            <div class="js-slider" data-dots="true">
                <div class="block text-center mb-0">
                    <div class="block-content py-5 bg-info">
                        <i class="fab fa-twitter-square fa-5x text-black-50"></i>
                        <div class="font-size-h3 font-w600 mt-3 text-white">26.4k</div>
                        <div class="text-white-75">Followers</div>
                    </div>
                </div>
                <div class="block text-center mb-0">
                    <div class="block-content py-5 bg-danger">
                        <i class="fab fa-youtube-square fa-5x text-black-50"></i>
                        <div class="font-size-h3 font-w600 mt-3 text-white">12000</div>
                        <div class="text-white-75">Video Views</div>
                    </div>
                </div>
                <div class="block text-center mb-0">
                    <div class="block-content py-5 bg-primary">
                        <i class="fab fa-facebook-square fa-5x text-black-50"></i>
                        <div class="font-size-h3 font-w600 mt-3 text-white">8.5k</div>
                        <div class="text-white-75">Likes</div>
                    </div>
                </div>
            </div>
            <!-- END Tiles Slider 1 -->
        </div>
        <div class="col-md-4">
            <!-- Tiles Slider 2 -->
            <div class="js-slider slick-nav-hover" data-dots="true" data-arrows="true">
                <div class="block text-center mb-0">
                    <div class="block-content py-5">
                        <i class="fab fa-windows fa-5x text-gray-dark"></i>
                        <div class="font-size-h3 font-w600 mt-3">10</div>
                        <div class="text-muted">version</div>
                    </div>
                </div>
                <div class="block text-center mb-0">
                    <div class="block-content py-5">
                        <i class="fa fa-gamepad fa-5x text-primary"></i>
                        <div class="font-size-h3 font-w600 mt-3">320</div>
                        <div class="text-muted">Games</div>
                    </div>
                </div>
                <div class="block text-center mb-0">
                    <div class="block-content py-5">
                        <i class="fab fa-android fa-5x text-danger"></i>
                        <div class="font-size-h3 font-w600 mt-3">10</div>
                        <div class="text-muted">Smartphones</div>
                    </div>
                </div>
            </div>
            <!-- END Tiles Slider 2 -->
        </div>
        <div class="col-md-4">
            <!-- Tiles Slider 3 -->
            <div class="js-slider slick-nav-hover" data-dots="true" data-autoplay="true" data-arrows="true">
                <div class="block text-center mb-0">
                    <div class="block-content py-5">
                        <i class="fa fa-inbox fa-5x text-success"></i>
                        <div class="font-size-h3 font-w600 mt-3">12</div>
                        <div class="text-muted">New messages</div>
                    </div>
                </div>
                <div class="block text-center mb-0">
                    <div class="block-content py-5">
                        <i class="fa fa-file-alt fa-5x text-warning"></i>
                        <div class="font-size-h3 font-w600 mt-3">12</div>
                        <div class="text-muted">Files</div>
                    </div>
                </div>
                <div class="block text-center bg-white mb-0">
                    <div class="block-content py-5">
                        <i class="fa fa-server fa-5x text-danger"></i>
                        <div class="font-size-h3 font-w600 mt-3">26</div>
                        <div class="text-muted">Websites</div>
                    </div>
                </div>
            </div>
            <!-- END Tiles Slider 3 -->
        </div>
    </div>
    <!-- END Content Sliders -->

    <!-- Image Sliders -->
    <h2 class="content-heading">Image Sliders</h2>
    <div class="row">
        <div class="col-md-6">
            <!-- Slider with dots -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Dots</h3>
                </div>
                <div class="js-slider" data-dots="true">
                    <div>
                        <?php $one->get_photo(2, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(3, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(4, true, 'img-fluid'); ?>
                    </div>
                </div>
                <!-- END Slider with dots -->
            </div>
            <!-- END Dots -->
        </div>
        <div class="col-md-6">
            <!-- Slider with dots and white hover arrows -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Dots &amp; White Hover Arrows</h3>
                </div>
                <div class="js-slider slick-nav-white slick-nav-hover" data-dots="true" data-arrows="true">
                    <div>
                        <?php $one->get_photo(7, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(8, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(9, true, 'img-fluid'); ?>
                    </div>
                </div>
            </div>
            <!-- END Slider with dots and white hover arrows -->
        </div>
        <div class="col-md-6">
            <!-- Slider with inner dots and black arrows -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Inner Dots &amp; Black Arrows</h3>
                </div>
                <div class="js-slider slick-nav-black slick-dotted-inner slick-dotted-white" data-dots="true" data-arrows="true">
                    <div>
                        <?php $one->get_photo(21, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(22, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(23, true, 'img-fluid'); ?>
                    </div>
                </div>
            </div>
            <!-- END Slider with inner dots and black arrows -->
        </div>
        <div class="col-md-6">
            <!-- Slider with autoplay and white inner dots -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">
                        <i class="fa fa-play fa-fw text-primary"></i> Autoplay &amp; White Inner Dots
                    </h3>
                </div>
                <div class="js-slider slick-dotted-inner slick-dotted-white" data-dots="true" data-autoplay="true" data-autoplay-speed="3000">
                    <div>
                        <?php $one->get_photo(13, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(14, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(24, true, 'img-fluid'); ?>
                    </div>
                </div>
            </div>
            <!-- END Slider with autoplay and white inner dots -->
        </div>
        <div class="col-md-12">
            <!-- Slider with multiple images and center mode -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">
                        <i class="fa fa-play fa-fw text-primary"></i> Multiple Images &amp; Center Mode
                    </h3>
                </div>
                <div class="js-slider slick-nav-black slick-nav-hover" data-dots="true" data-arrows="true" data-slides-to-show="3" data-center-mode="true" data-autoplay="true" data-autoplay-speed="3000">
                    <div>
                        <?php $one->get_photo(15, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(16, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(17, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(18, true, 'img-fluid'); ?>
                    </div>
                    <div>
                        <?php $one->get_photo(19, true, 'img-fluid'); ?>
                    </div>
                </div>
            </div>
            <!-- END Slider with multiple images and center mode -->
        </div>
    </div>
    <!-- END Image Sliders -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/slick-carousel/slick.min.js'); ?>

<!-- Page JS Helpers (Slick Slider Plugin) -->
<script>jQuery(function(){ One.helpers('slick'); });</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
