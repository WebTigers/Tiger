<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="w-100">
        <!-- Sign In Section -->
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
                                Sign In
                            </h1>
                            <h2 class="h6 font-w400 text-muted mb-3">
                                A perfect match for your project
                            </h2>
                        </div>
                        <!-- END Header -->

                        <!-- Sign In Form -->
                        <!-- jQuery Validation (.js-validation-signin class is initialized in js/pages/op_auth_signin.min.js which was auto compiled from _es6/pages/op_auth_signin.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-signin" action="be_pages_auth_all.php" method="POST">
                            <div class="py-3">
                                <div class="form-group">
                                    <input type="text" class="form-control form-control-lg form-control-alt" id="login-username" name="login-username" placeholder="Username">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-lg form-control-alt" id="login-password" name="login-password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <div class="d-md-flex align-items-md-center justify-content-md-between">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="login-remember" name="login-remember">
                                            <label class="custom-control-label font-w400" for="login-remember">Remember Me</label>
                                        </div>
                                        <div class="py-2">
                                            <a class="font-size-sm" href="op_auth_reminder2.php">Forgot Password?</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row justify-content-center mb-0">
                                <div class="col-md-6 col-xl-5">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        <i class="fa fa-fw fa-sign-in-alt mr-1"></i> Sign In
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- END Sign In Form -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Sign In Section -->

        <!-- Footer -->
        <div class="font-size-sm text-center text-muted py-3">
            <strong><?php echo $one->name . ' ' . $one->version; ?></strong> &copy; <span data-toggle="year-copy"></span>
        </div>
        <!-- END Footer -->
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/op_auth_signin.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
