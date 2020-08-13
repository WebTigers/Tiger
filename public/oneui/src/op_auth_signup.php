<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="hero-static">
    <div class="content">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <!-- Sign Up Block -->
                <div class="block block-themed block-fx-shadow mb-0">
                    <div class="block-header bg-success">
                        <h3 class="block-title">Create Account</h3>
                        <div class="block-options">
                            <a class="btn-block-option font-size-sm" href="javascript:void(0)" data-toggle="modal" data-target="#one-signup-terms">View Terms</a>
                            <a class="btn-block-option" href="op_auth_signin.php" data-toggle="tooltip" data-placement="left" title="Sign In">
                                <i class="fa fa-sign-in-alt"></i>
                            </a>
                        </div>
                    </div>
                    <div class="block-content">
                        <div class="p-sm-3 px-lg-4 py-lg-5">
                            <h1 class="mb-2">OneUI</h1>
                            <p>Please fill the following details to create a new account.</p>

                            <!-- Sign Up Form -->
                            <!-- jQuery Validation (.js-validation-signup class is initialized in js/pages/op_auth_signup.min.js which was auto compiled from _es6/pages/op_auth_signup.js) -->
                            <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                            <form class="js-validation-signup" action="be_pages_auth_all.php" method="POST">
                                <div class="py-3">
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-lg form-control-alt" id="signup-username" name="signup-username" placeholder="Username">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-lg form-control-alt" id="signup-email" name="signup-email" placeholder="Email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg form-control-alt" id="signup-password" name="signup-password" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-lg form-control-alt" id="signup-password-confirm" name="signup-password-confirm" placeholder="Password Confirm">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="signup-terms" name="signup-terms">
                                            <label class="custom-control-label font-w400" for="signup-terms">I agree to Terms &amp; Conditions</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-6 col-xl-5">
                                        <button type="submit" class="btn btn-block btn-success">
                                            <i class="fa fa-fw fa-plus mr-1"></i> Sign Up
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <!-- END Sign Up Form -->
                        </div>
                    </div>
                </div>
                <!-- END Sign Up Block -->
            </div>
        </div>
    </div>
    <div class="content content-full font-size-sm text-muted text-center">
        <strong><?php echo $one->name . ' ' . $one->version; ?></strong> &copy; <span data-toggle="year-copy"></span>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>

<!-- Terms Modal -->
<div class="modal fade" id="one-signup-terms" tabindex="-1" role="dialog" aria-labelledby="one-signup-terms" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-popout" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Terms &amp; Conditions</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('small', 5); ?>
                </div>
                <div class="block-content block-content-full text-right border-top">
                    <button type="button" class="btn btn-sm btn-link mr-2" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">I Agree</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Terms Modal -->

<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/op_auth_signup.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
