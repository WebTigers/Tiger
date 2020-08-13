<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Authentication <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">All pages in one spot!</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Authentication</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">All</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Original -->
    <h2 class="content-heading">Original</h2>
    <div class="row">
        <div class="col-md-6">
            <!-- Sign In -->
            <a class="block block-link-shadow" href="op_auth_signin.php">
                <div class="block-content text-center">
                    <div class="py-5">
                        <div class="mb-3">
                            <i class="fa fa-sign-in-alt fa-2x text-default"></i>
                        </div>
                        <p class="font-size-lg">Sign In<p>
                    </div>
                </div>
            </a>
            <!-- END Sign In -->
        </div>
        <div class="col-md-6">
            <!-- Sign Up -->
            <a class="block block-link-shadow" href="op_auth_signup.php">
                <div class="block-content text-center">
                    <div class="py-5">
                        <div class="mb-3">
                            <i class="fa fa-user-plus fa-2x text-success"></i>
                        </div>
                        <p class="font-size-lg">Sign Up<p>
                    </div>
                </div>
            </a>
            <!-- END Sign Up -->
        </div>
        <div class="col-md-6">
            <!-- Lock Screen -->
            <a class="block block-link-shadow" href="op_auth_lock.php">
                <div class="block-content text-center">
                    <div class="py-5">
                        <div class="mb-3">
                            <i class="fa fa-lock fa-2x text-city"></i>
                        </div>
                        <p class="font-size-lg">Lock Screen<p>
                    </div>
                </div>
            </a>
            <!-- END Lock Screen -->
        </div>
        <div class="col-md-6">
            <!-- Password Reminder -->
            <a class="block block-link-shadow" href="op_auth_reminder.php">
                <div class="block-content text-center">
                    <div class="py-5">
                        <div class="mb-3">
                            <i class="fa fa-life-ring fa-2x text-modern"></i>
                        </div>
                        <p class="font-size-lg">Password Reminder<p>
                    </div>
                </div>
            </a>
            <!-- END Password Reminder -->
        </div>
    </div>
    <!-- END Original -->

    <!-- Alternative -->
    <h2 class="content-heading">Alternative</h2>
    <div class="row">
        <div class="col-md-6">
            <!-- Sign In -->
            <a class="block block-link-shadow" href="op_auth_signin2.php">
                <div class="block-content text-center">
                    <div class="py-5">
                        <div class="mb-3">
                            <i class="fa fa-sign-in-alt fa-2x text-default"></i>
                        </div>
                        <p class="font-size-lg">Sign In 2<p>
                    </div>
                </div>
            </a>
            <!-- END Sign In -->
        </div>
        <div class="col-md-6">
            <!-- Sign Up -->
            <a class="block block-link-shadow" href="op_auth_signup2.php">
                <div class="block-content text-center">
                    <div class="py-5">
                        <div class="mb-3">
                            <i class="fa fa-user-plus fa-2x text-success"></i>
                        </div>
                        <p class="font-size-lg">Sign Up 2<p>
                    </div>
                </div>
            </a>
            <!-- END Sign Up -->
        </div>
        <div class="col-md-6">
            <!-- Lock Screen -->
            <a class="block block-link-shadow" href="op_auth_lock2.php">
                <div class="block-content text-center">
                    <div class="py-5">
                        <div class="mb-3">
                            <i class="fa fa-lock fa-2x text-city"></i>
                        </div>
                        <p class="font-size-lg">Lock Screen 2<p>
                    </div>
                </div>
            </a>
            <!-- END Lock Screen -->
        </div>
        <div class="col-md-6">
            <!-- Password Reminder -->
            <a class="block block-link-shadow" href="op_auth_reminder2.php">
                <div class="block-content text-center">
                    <div class="py-5">
                        <div class="mb-3">
                            <i class="fa fa-life-ring fa-2x text-modern"></i>
                        </div>
                        <p class="font-size-lg">Password Reminder 2<p>
                    </div>
                </div>
            </a>
            <!-- END Password Reminder -->
        </div>
    </div>
    <!-- END Alternative -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
