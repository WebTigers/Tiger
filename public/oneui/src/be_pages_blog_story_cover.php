<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/magnific-popup/magnific-popup.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero Content -->
<div class="bg-image" style="min-height: 600px; background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo23@2x.jpg');"></div>
<!-- END Hero Content -->

<!-- Page Content -->
<div class="bg-white">
    <div class="content content-boxed">
        <div class="text-center font-size-sm push">
            <h1 class="text-black mt-3 invisible" data-toggle="appear" data-class="animated fadeIn">Travel the world and feel alive.</h1>
            <span class="d-inline-block py-2 px-4 bg-body-light rounded">
                <a class="link-effect font-w600" href="be_pages_generic_profile.php">John Doe</a> on July 16, 2019 &bull; <em>5 min</em>
            </span>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <!-- Story -->
                <article class="story">
                    <?php $one->get_text('medium', 1); ?>

                    <!-- Magnific Popup (.js-gallery class is initialized in Helpers.magnific()) -->
                    <!-- For more info and examples you can check out http://dimsemenov.com/plugins/magnific-popup/ -->
                    <div class="row gutters-tiny items-push js-gallery push img-fluid-100">
                        <div class="col-6 animated fadeIn">
                            <a class="img-link img-link-simple img-link-zoom-in img-lightbox" href="<?php echo $one->assets_folder; ?>/media/photos/photo21@2x.jpg">
                                <?php $one->get_photo(21, false, 'img-fluid'); ?>
                            </a>
                        </div>
                        <div class="col-6 animated fadeIn">
                            <a class="img-link img-link-simple img-link-zoom-in img-lightbox" href="<?php echo $one->assets_folder; ?>/media/photos/photo22@2x.jpg">
                                <?php $one->get_photo(22, false, 'img-fluid'); ?>
                            </a>
                        </div>
                    </div>
                    <!-- END Gallery -->

                    <?php $one->get_text('medium'); ?>

                    <h3 class="font-w400 text-black mt-5 mb-3">Experiences</h3>
                    <?php $one->get_text('large'); ?>

                    <h3 class="font-w400 text-black mt-5 mb-3">Exploring</h3>
                    <?php $one->get_text('medium'); ?>

                    <!-- Magnific Popup (.js-gallery class is initialized in Helpers.magnific()) -->
                    <!-- For more info and examples you can check out http://dimsemenov.com/plugins/magnific-popup/ -->
                    <div class="row gutters-tiny items-push js-gallery push img-fluid-100">
                        <div class="col-12 animated fadeIn">
                            <a class="img-link img-link-simple img-link-zoom-in img-lightbox" href="<?php echo $one->assets_folder; ?>/media/photos/photo23@2x.jpg">
                                <?php $one->get_photo(23, true, 'img-fluid'); ?>
                            </a>
                        </div>
                        <div class="col-6 animated fadeIn">
                            <a class="img-link img-link-simple img-link-zoom-in img-lightbox" href="<?php echo $one->assets_folder; ?>/media/photos/photo24@2x.jpg">
                                <?php $one->get_photo(24, false, 'img-fluid'); ?>
                            </a>
                        </div>
                        <div class="col-6 animated fadeIn">
                            <a class="img-link img-link-simple img-link-zoom-in img-lightbox" href="<?php echo $one->assets_folder; ?>/media/photos/photo14@2x.jpg">
                                <?php $one->get_photo(14, false, 'img-fluid'); ?>
                            </a>
                        </div>
                    </div>
                    <!-- END Gallery -->

                    <?php $one->get_text('medium'); ?>

                    <h3 class="font-w400 text-black mt-5 mb-3">Memories</h3>
                    <?php $one->get_text('medium'); ?>
                </article>
                <!-- END Story -->

                <!-- Actions -->
                <div class="mt-5 d-flex justify-content-between push">
                    <a class="btn btn-success" href="javascript:void(0)">
                        <i class="fa fa-heart mr-1"></i> Recommend
                    </a>
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-light" data-toggle="tooltip" title="Like Story">
                            <i class="fa fa-thumbs-up"></i>
                        </button>
                        <div class="btn-group">
                            <button type="button" class="btn btn-light dropdown-toggle" id="dropdown-blog-story" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-share-alt mr-1"></i> Share
                            </button>
                            <div class="dropdown-menu dropdown-menu-right font-size-sm" aria-labelledby="dropdown-blog-story">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fab fa-fw fa-facebook mr-1"></i> Facebook
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fab fa-fw fa-twitter mr-1"></i> Twitter
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fab fa-fw fa-google-plus mr-1"></i> Google+
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fab fa-fw fa-linkedin mr-1"></i> LinkedIn
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Actions -->
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

<!-- Get Started -->
<div class="bg-body">
    <div class="content content-full">
        <div class="my-5 text-center">
            <h3 class="h4 mb-4 invisible" data-toggle="appear">Do you like our stories? Sign up today and get access to over <strong>10.000</strong> travel stories!</h3>
            <a class="btn btn-rounded btn-success px-4 py-2 invisible" data-toggle="appear" data-class="animated bounceIn" href="javascript:void(0)">Get Started Today</a>
        </div>
    </div>
</div>
<!-- END Get Started -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/magnific-popup/jquery.magnific-popup.min.js'); ?>

<!-- Page JS Helpers (Magnific Popup Plugin) -->
<script>jQuery(function(){ One.helpers('magnific-popup'); });</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
