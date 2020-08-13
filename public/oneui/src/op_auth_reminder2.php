<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="w-100">
        <!-- Reminder Section -->
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
                                Password Reminder
                            </h1>
                            <h2 class="h6 font-w400 text-muted mb-3">
                                Please provide your account’s email and we will send you your password.
                            </h2>
                        </div>
                        <!-- END Header -->

                        <!-- Reminder Form -->
                        <!-- jQuery Validation (.js-validation-reminder class is initialized in js/pages/op_auth_reminder.min.js which was auto compiled from _es6/pages/op_auth_reminder.js) -->
                        <!-- For more info and examples you can check out https://github.com/jzaefferer/jquery-validation -->
                        <form class="js-validation-reminder" action="be_pages_auth_all.php" method="POST">
                            <div class="form-group py-3">
                                <input type="text" class="form-control form-control-lg form-control-alt" id="reminder-credential" name="reminder-credential" placeholder="Username or Email">
                            </div>
                            <div class="form-group row justify-content-center">
                                <div class="col-md-6 col-xl-5">
                                    <button type="submit" class="btn btn-block btn-primary">
                                        <i class="fa fa-fw fa-envelope mr-1"></i> Send Mail
                                    </button>
                                </div>
                            </div>
                        </form>
                        <!-- END Reminder Form -->

                        <div class="text-center">
                            <a class="font-size-sm" href="op_auth_signin2.php">Login?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END Reminder Section -->

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
<?php $one->get_js('js/pages/op_auth_reminder.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
