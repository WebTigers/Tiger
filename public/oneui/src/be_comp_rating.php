<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/raty-js/jquery.raty.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Rating <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Adding rating functionality to your pages has never been easier.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Rating</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<!-- jQuery Raty demo functionality is initialized in js/pages/be_comp_rating.min.js which was auto compiled from _es6/pages/be_comp_rating.js -->
<!-- For more info and examples you can check out https://github.com/wbotelhos/raty -->
<div class="content">
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">jQuery Raty</h3>
        </div>
        <div class="block-content">
            <div class="row items-push-2x">
                <div class="col-md-6">
                    <!-- Simple -->
                    <h4 class="border-bottom pb-2">Simple</h4>
                    <p class="font-size-sm text-muted mb-2">
                        Setting up rating is just a class away
                    </p>
                    <div class="js-rating"></div>
                    <!-- END Simple -->
                </div>
                <div class="col-md-6">
                    <!-- Predefined Score -->
                    <h4 class="border-bottom pb-2">Predefined Score</h4>
                    <p class="font-size-sm text-muted mb-2">
                        You can easily set a default score
                    </p>
                    <div class="js-rating" data-score="3"></div>
                    <!-- END Predefined Score -->
                </div>
                <div class="col-md-6">
                    <!-- More Stars -->
                    <h4 class="border-bottom pb-2">More Stars</h4>
                    <p class="font-size-sm text-muted mb-2">
                        You can easily set the number of stars
                    </p>
                    <div class="js-rating push" data-score="5" data-number="10"></div>
                    <!-- END More Stars -->
                </div>
                <div class="col-md-6">
                    <!-- Reset Button -->
                    <h4 class="border-bottom pb-2">Reset Button</h4>
                    <p class="font-size-sm text-muted mb-2">
                        You can also add a reset button to your rating
                    </p>
                    <div class="js-rating push" data-cancel="true" data-score="3"></div>
                    <!-- END Reset Button -->
                </div>
                <div class="col-md-6">
                    <!-- Hint Text -->
                    <h4 class="border-bottom pb-2">Hint Text</h4>
                    <p class="font-size-sm text-muted mb-2">
                        You can use a hint text when hovering the icons
                    </p>
                    <div class="js-rating" data-cancel="true" data-score="3" data-target=".js-rating-hint-text"></div>
                    <div class="push">
                        Hint: <span class="js-rating-hint-text font-w600">..</span>
                    </div>
                    <!-- END Hint Text -->
                </div>
                <div class="col-md-6">
                    <!-- Color Variations -->
                    <h4 class="border-bottom pb-2">Color Variations</h4>
                    <p class="font-size-sm text-muted mb-2">
                        You can set the colors to what ever you like
                    </p>
                    <div class="push">
                        <div class="js-rating" data-score="3" data-star-on="fa fa-fw fa-star text-primary"></div>
                    </div>
                    <div class="push">
                        <div class="js-rating" data-score="3" data-star-on="fa fa-fw fa-star text-success"></div>
                    </div>
                    <div class="push">
                        <div class="js-rating" data-score="3" data-star-on="fa fa-fw fa-star text-danger"></div>
                    </div>
                    <!-- END Color Variations -->
                </div>
                <div class="col-md-6">
                    <!-- Icon Variations -->
                    <h4 class="border-bottom pb-2">Icon Variations</h4>
                    <p class="font-size-sm text-muted mb-2">
                        You can also change the default icons to something else
                    </p>
                    <div class="push">
                        <div class="js-rating" data-score="3" data-star-on="si si-star mr-1 text-success" data-star-off="si si-star mr-1 text-muted"></div>
                    </div>
                    <div class="push">
                        <div class="js-rating" data-score="3" data-star-on="fa fa-fw fa-coffee text-info" data-star-off="fa fa-fw fa-thumbs-up text-muted"></div>
                    </div>
                    <div class="push mb-md-0">
                        <div class="js-rating" data-score="3" data-star-on="fa fa-fw fa-check text-primary" data-star-off="fa fa-fw fa-check text-muted"></div>
                    </div>
                    <!-- END Color Variations -->
                </div>
                <div class="col-md-6">
                    <!-- Sizes Variations -->
                    <h4 class="border-bottom pb-2">Sizes Variations</h4>
                    <p class="font-size-sm text-muted mb-2">
                        Changing the size of the icons is also possible
                    </p>
                    <div class="push">
                        <div class="js-rating" data-score="3" data-star-on="fa fa-fw fa-rocket font-size-sm text-success" data-star-off="fa fa-fw fa-rocket font-size-sm text-muted"></div>
                    </div>
                    <div class="push">
                        <div class="js-rating" data-score="3" data-star-on="fa fa-fw fa-2x fa-heart text-danger" data-star-off="fa fa-fw fa-2x fa-heart text-muted"></div>
                    </div>
                    <div>
                        <div class="js-rating" data-score="3" data-star-on="fa fa-fw fa-3x fa-star text-warning" data-star-off="fa fa-fw fa-3x fa-star text-muted"></div>
                    </div>
                    <!-- END Sizes Variations -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/raty-js/jquery.raty.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_comp_rating.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
