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
                Appear <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Animate elements and make them visible on scrolling.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Appear</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<!-- Appear ([data-toggle="appear"] is initialized in Helpers.coreAppear()) -->
<!-- For more info and examples you can check out https://github.com/bas2k/jquery.appear -->
<div class="content">
    <h2 class="content-heading">Basic</h2>
    <div class="row">
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-primary text-white mx-auto">
                            <i class="fa fa-2x fa-brush"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Create</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-success text-white mx-auto">
                            <i class="fab fa-2x fa-bitcoin"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Bitcoin</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-dark text-white mx-auto">
                            <i class="fab fa-2x fa-chrome"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Browser</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Appear -->

    <!-- Animation Classes -->
    <h2 class="content-heading">Animated <small>You can use the animation classes of your choice</small></h2>
    <div class="row">
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear" data-class="animated bounceIn">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-warning text-white mx-auto">
                            <i class="si fa-2x si-user"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Users</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear" data-class="animated flipInX">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-danger text-white mx-auto">
                            <i class="si fa-2x si-settings"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Settings</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear" data-class="animated flash">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-info text-white mx-auto">
                            <i class="si fa-2x fa-2x si-rocket"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Startup</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Animation Classes -->

    <!-- Offset -->
    <h2 class="content-heading">Offset <small>You can add an offset, to make the element appear sooner or later</small></h2>
    <div class="row">
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear" data-offset="-200">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-danger-light text-danger mx-auto">
                            <i class="si fa-2x si-lock"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Lock</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear" data-offset="200">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-warning-light text-warning mx-auto">
                            <i class="si fa-2x si-energy"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Energy</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear" data-offset="-400">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-info-light text-info mx-auto">
                            <i class="si fa-2x si-calendar"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Events</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Offset -->

    <!-- Timeouts -->
    <h2 class="content-heading">Timeouts <small>You can delay the animation, creating nice effects</small></h2>
    <div class="row">
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear" data-offset="-200">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-body text-primary mx-auto">
                            <i class="si fa-2x si-speedometer"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Dashboard</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear" data-offset="-200" data-timeout="200">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-body text-danger mx-auto">
                            <i class="si fa-2x si-printer"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Print</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="block invisible" data-toggle="appear" data-offset="-200" data-timeout="400">
                <div class="block-content block-content-full">
                    <div class="py-5 text-center">
                        <div class="item item-2x item-rounded bg-body text-success mx-auto">
                            <i class="si fa-2x si-envelope-open"></i>
                        </div>
                        <div class="font-size-h4 font-w600 pt-3 mb-0">Messages</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Timeouts -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
