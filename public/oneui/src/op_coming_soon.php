<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo6@2x.jpg');">
    <div class="hero bg-primary-dark-op">
        <div class="hero-inner bg-black-50">
            <div class="content content-full">
                <div class="row justify-content-center">
                    <div class="col-md-6 py-3 text-center">
                        <div class="push">
                            <a class="link-fx font-w700 font-size-h1" href="index.php">
                                <span class="text-white">OneUI</span>
                            </a>
                            <p class="font-size-sm text-white-75">Stay tuned! We are working on it and it is coming soon!</p>
                        </div>

                        <!-- Countdown.js (class is initialized in js/pages/op_coming_soon.js) which was auto compiled from _es6/pages/op_coming_soon.js -->
                        <!-- For more info and examples you can check out https://github.com/hilios/jQuery.countdown -->
                        <div class="js-countdown"></div>

                        <form class="push" action="op_coming_soon.php" method="POST" onsubmit="return false;">
                            <div class="form-group row justify-content-center">
                                <div class="col-md-10 col-xl-6">
                                    <div class="input-group mb-2">
                                        <input type="email" class="form-control border-0" placeholder="Enter your email..">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-primary">Subscribe</button>
                                        </div>
                                    </div>
                                    <div class="font-size-sm text-white-50">
                                        Don't worry, we hate spam.
                                    </div>
                                </div>
                            </div>
                        </form>
                        <a class="btn btn-sm btn-light" href="be_pages_generic_blank.php">
                            <i class="fa fa-arrow-left mr-1"></i> Go Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/jquery-countdown/jquery.countdown.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/op_coming_soon.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>