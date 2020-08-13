<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/magnific-popup/magnific-popup.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Gallery <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Clean and easy way to showcase your images. Powered by Magnific plugin.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Gallery</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<!-- Magnific Popup (.js-gallery class is initialized in Helpers.magnific()) -->
<!-- For more info and examples you can check out http://dimsemenov.com/plugins/magnific-popup/ -->
<div class="content">
    <!-- Simple Gallery -->
    <h2 class="content-heading">Simple</h2>
    <div class="row items-push js-gallery img-fluid-100">
        <?php for ($i = 2; $i < 18; $i++) { ?>
        <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
            <a class="img-link img-link-zoom-in img-thumb img-lightbox" href="<?php echo $one->assets_folder; ?>/media/photos/photo<?php echo $i; ?>@2x.jpg">
                <?php $one->get_photo($i, false, 'img-fluid'); ?>
            </a>
        </div>
        <?php } ?>
    </div>
    <!-- END Simple Gallery -->

    <!-- Advanced Gallery -->
    <h2 class="content-heading">Advanced</h2>
    <div class="row gutters-tiny items-push js-gallery push">
        <?php for ($i = 17; $i > 1; $i--) { ?>
        <div class="col-md-6 col-lg-4 col-xl-3 animated fadeIn">
            <div class="options-container fx-item-rotate-r">
                <?php $one->get_photo($i, false, 'img-fluid options-item'); ?>
                <div class="options-overlay bg-black-75">
                    <div class="options-overlay-content">
                        <h3 class="h4 font-w400 text-white mb-1">Image Caption</h3>
                        <h4 class="h6 font-w400 text-white-75 mb-3">Some extra info</h4>
                        <a class="btn btn-sm btn-primary img-lightbox" href="<?php echo $one->assets_folder; ?>/media/photos/photo<?php echo $i; ?>@2x.jpg">
                            <i class="fa fa-search-plus mr-1"></i> View
                        </a>
                        <a class="btn btn-sm btn-secondary" href="javascript:void(0)">
                            <i class="fa fa-pencil-alt mr-1"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    <!-- END Advanced Gallery -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/magnific-popup/jquery.magnific-popup.min.js'); ?>

<!-- Page JS Helpers (Magnific Popup Plugin) -->
<script>jQuery(function(){ One.helpers('magnific-popup'); });</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
