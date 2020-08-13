<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo34@2x.jpg');">
    <div class="hero-static d-flex align-items-center">
        <div class="w-100">
            <!-- Unlock Section -->
            <div class="bg-white">
                <div class="content content-full">
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-lg-6 col-xl-4 py-4">
                            <!-- Header -->
                            <div class="text-center">
                                <p class="mb-2">
                                    <i class="fa fa-2x fa-circle-notch text-primary"></i>
                                </p>
                                <h1 class="h4 mb-1">
                                    Account Locked
                                </h1>
                                <h2 class="h6 font-w400 text-muted mb-5">
                                    Please enter your password to unlock your account
                                </h2>
                                <?php $one->get_avatar(10, '', 96); ?>
                                <p class="font-w600 text-center my-2">
                                    user@example.com
                                </p>
                            </div>
                            <!-- END Header -->

                            <!-- Unlock Form -->
                            <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-lock" action="be_pages_auth_all.php" method="POST">
                                <div class="form-group py-3">
                                    <input type="password" class="form-control form-control-lg form-control-alt" id="lock-password" name="lock-password" placeholder="Password..">
                                </div>
                                <div class="form-group row justify-content-center">
                                    <div class="col-md-6 col-xl-5">
                                        <button type="submit" class="btn btn-block btn-light">
                                            <i class="fa fa-fw fa-lock-open mr-1"></i> Unlock
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Unlock Form -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Unlock Section -->

            <!-- Footer -->
            <div class="font-size-sm text-center text-white py-3">
                <strong><?php echo $one->name . ' ' . $one->version; ?></strong> &copy; <span data-toggle="year-copy"></span>
            </div>
            <!-- END Footer -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/op_auth_lock.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
