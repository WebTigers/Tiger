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
                Alerts <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Inform your users about important events happenning in your app.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Elements</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Alerts</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-xl-6">
            <!-- Simple -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Simple</h3>
                </div>
                <div class="block-content">
                    <p class="font-size-sm text-muted">
                        Use the colors which better fit the type of message you want to pass
                    </p>
                    <div class="alert alert-primary alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">This is a primary message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                    </div>
                    <div class="alert alert-secondary alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">This is a secondary message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                    </div>
                    <div class="alert alert-success alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">This is a successful message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                    </div>
                    <div class="alert alert-info alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">This is an informational message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                    </div>
                    <div class="alert alert-warning alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">This is a warning message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                    </div>
                    <div class="alert alert-danger alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">This is an error message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                    </div>
                    <div class="alert alert-dark alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">This is a dark alert message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                    </div>
                    <div class="alert alert-light alert-dismissable" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="mb-0">This is a light alert message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                    </div>
                </div>
            </div>
            <!-- END Simple -->
        </div>
        <div class="col-xl-6">
            <!-- With Icons -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">With Icons</h3>
                </div>
                <div class="block-content">
                    <p class="font-size-sm text-muted">
                        Choose an icon of your preference and easily add it to an alert message
                    </p>
                    <div class="alert alert-primary d-flex align-items-center" role="alert">
                        <div class="flex-00-auto">
                            <i class="fa fa-fw fa-globe"></i>
                        </div>
                        <div class="flex-fill ml-3">
                            <p class="mb-0">This is a primary message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                        </div>
                    </div>
                    <div class="alert alert-secondary d-flex align-items-center" role="alert">
                        <div class="flex-00-auto">
                            <i class="fa fa-fw fa-university"></i>
                        </div>
                        <div class="flex-fill ml-3">
                            <p class="mb-0">This is a secondary message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                        </div>
                    </div>
                    <div class="alert alert-success d-flex align-items-center" role="alert">
                        <div class="flex-00-auto">
                            <i class="fa fa-fw fa-check"></i>
                        </div>
                        <div class="flex-fill ml-3">
                            <p class="mb-0">This is a successful message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                        </div>
                    </div>
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <div class="flex-00-auto">
                            <i class="fa fa-fw fa-info-circle"></i>
                        </div>
                        <div class="flex-fill ml-3">
                            <p class="mb-0">This is an informational message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                        </div>
                    </div>
                    <div class="alert alert-warning d-flex align-items-center justify-content-between" role="alert">
                        <div class="flex-fill mr-3">
                            <p class="mb-0">This is a warning message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                        </div>
                        <div class="flex-00-auto">
                            <i class="fa fa-fw fa-exclamation-circle"></i>
                        </div>
                    </div>
                    <div class="alert alert-danger d-flex align-items-center justify-content-between" role="alert">
                        <div class="flex-fill mr-3">
                            <p class="mb-0">This is an error message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                        </div>
                        <div class="flex-00-auto">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </div>
                    </div>
                    <div class="alert alert-dark d-flex align-items-center justify-content-between" role="alert">
                        <div class="flex-fill mr-3">
                            <p class="mb-0">This is a dark alert message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                        </div>
                        <div class="flex-00-auto">
                            <i class="fa fa-fw fa-camera-retro"></i>
                        </div>
                    </div>
                    <div class="alert alert-light d-flex align-items-center justify-content-between" role="alert">
                        <div class="flex-fill mr-3">
                            <p class="mb-0">This is a light alert message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                        </div>
                        <div class="flex-00-auto">
                            <i class="fab fa-fw fa-bitcoin"></i>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END With Icons -->
        </div>
        <div class="col-12">
            <!-- With Titles -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">With Titles</h3>
                </div>
                <div class="block-content">
                    <p class="text-muted">
                        You can also add titles to your alert messages
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-primary alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="alert-heading font-w300 my-2">Primary</h3>
                                <p class="mb-0">This is a primary message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                            </div>
                            <div class="alert alert-secondary alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="alert-heading font-w300 my-2">Secondary</h3>
                                <p class="mb-0">This is a secondary message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                            </div>
                            <div class="alert alert-success alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="alert-heading font-w300 my-2">Success</h3>
                                <p class="mb-0">This is a successful message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                            </div>
                            <div class="alert alert-info alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="alert-heading font-w300 my-2">Information</h3>
                                <p class="mb-0">This is an informational message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-warning alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="alert-heading font-w300 my-2">Warning</h3>
                                <p class="mb-0">This is a warning message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                            </div>
                            <div class="alert alert-danger alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="alert-heading font-w300 my-2">Error</h3>
                                <p class="mb-0">This is an error message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                            </div>
                            <div class="alert alert-dark alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="alert-heading font-w300 my-2">Dark</h3>
                                <p class="mb-0">This is a dark alert message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                            </div>
                            <div class="alert alert-light alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h3 class="alert-heading font-w300 my-2">Light</h3>
                                <p class="mb-0">This is a light alert message with a <a class="alert-link" href="javascript:void(0)">link</a>!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END With Titles -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
