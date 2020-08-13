<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo34@2x.jpg');">
    <div class="hero-static bg-black-50">
        <div class="content">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-4">
                    <!-- Unlock Block -->
                    <div class="block block-themed mb-0">
                        <div class="block-header bg-danger">
                            <h3 class="block-title">Account Locked</h3>
                            <div class="block-options">
                                <a class="btn-block-option" href="op_auth_signin.php" data-toggle="tooltip" data-placement="left" title="Sign In with another account">
                                    <i class="fa fa-sign-in-alt"></i>
                                </a>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="p-sm-3 px-lg-4 py-lg-5 text-center">
                                <?php $one->get_avatar(10, '', 96); ?>
                                <p class="font-w600 my-2">
                                    user@example.com
                                </p>

                                <!-- Unlock Form -->
                                <!-- jQuery Validation (.js-validation-lock class is initialized in js/pages/op_auth_lock.min.js which was auto compiled from _es6/pages/op_auth_lock.js) -->
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
                    <!-- END Unlock Block -->
                </div>
            </div>
        </div>
        <div class="content content-full font-size-sm text-white text-center">
            <strong><?php echo $one->name . ' ' . $one->version; ?></strong> &copy; <span data-toggle="year-copy"></span>
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
