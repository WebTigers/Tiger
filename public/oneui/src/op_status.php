<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="hero-static d-flex align-items-center">
    <div class="w-100">
        <!-- Status Section -->
        <div class="bg-white">
            <div class="content content-full">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4 py-4">
                        <!-- Header -->
                        <div class="text-center mb-5">
                            <p class="mb-2">
                                <i class="fa fa-2x fa-circle-notch text-primary"></i>
                            </p>
                            <h1 class="h4 mb-1">
                                Status Page
                            </h1>
                            <h2 class="h6 font-w400 text-muted mb-3">
                                Check out how we are doing
                            </h2>
                        </div>
                        <!-- END Header -->

                        <!-- Services -->
                        <div class="d-flex justify-content-between">
                            <a class="btn btn-lg btn-secondary" href="be_pages_generic_blank.php">
                                <i class="fa fa-arrow-left mr-1"></i> Dashboard
                            </a>
                            <a class="btn btn-lg btn-success" href="javascript:void(0)">
                                <i class="fa fa-rss"></i> <span class="d-none d-sm-inline-block ml-1">Subscribe</span>
                            </a>
                        </div>
                        <hr>
                        <div class="alert alert-warning" role="alert">
                            <p class="mb-0">Payments are currently under maintenance, please stay tuned.</p>
                        </div>
                        <div class="alert alert-danger" role="alert">
                            <p class="mb-0">Our frontend is experiencing some issues but we are on it!</p>
                        </div>
                        <ul class="list-group push">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Backend
                                <span class="badge badge-pill badge-success">Operational</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Frontend
                                <span class="badge badge-pill badge-danger">Down</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                API
                                <span class="badge badge-pill badge-success">Operational</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Payments
                                <span class="badge badge-pill badge-warning">Maintenance</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Helpdesk
                                <span class="badge badge-pill badge-success">Operational</span>
                            </li>
                        </ul>
                        <!-- END Services -->
                    </div>
                </div>
            </div>
        </div>
        <!-- END Status Section -->

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
<?php require 'inc/_global/views/footer_end.php'; ?>
