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
                Block Options <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Adding controls in your blocks.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Blocks</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Options</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <h2 class="content-heading">
        Interactive Options
        <small>
            <a href="be_blocks_api.php">Check out Blocks API</a>
        </small>
    </h2>

    <!-- Interactive Options -->
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                            <i class="si si-pin"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                            <i class="si si-close"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                            <i class="si si-close"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="pinned_toggle">
                            <i class="si si-pin"></i>
                        </button>
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- END Interactive Options -->

    <h2 class="content-heading">Alternative Options Examples</h2>

    <!-- Custom Buttons in Options -->
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option">
                            <i class="far fa-fw fa-bell"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="far fa-fw fa-arrow-alt-circle-left"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="far fa-fw fa-arrow-alt-circle-right"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="far fa-fw fa-trash-alt"></i>
                        </button>
                        <div class="dropdown">
                            <button type="button" class="btn-block-option dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</button>
                            <div class="dropdown-menu dropdown-menu-right font-size-sm">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="far fa-fw fa-bell mr-1"></i> News
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="dropdown">
                            <button type="button" class="btn-block-option dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings</button>
                            <div class="dropdown-menu font-size-sm">
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="far fa-fw fa-bell mr-1"></i> News
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                </a>
                                <div role="separator" class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                </a>
                            </div>
                        </div>
                        <button type="button" class="btn-block-option">
                            <i class="far fa-fw fa-trash-alt"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="far fa-fw fa-arrow-alt-circle-left"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="far fa-fw fa-arrow-alt-circle-right"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="far fa-fw fa-bell"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- END Custom Buttons in Options -->

    <!-- Bootstrap Buttons in Options -->
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-primary">Edit</button>
                        <button type="button" class="btn btn-sm btn-danger">Delete</button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-danger">Delete</button>
                        <button type="button" class="btn btn-sm btn-primary">Edit</button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-alt-primary">Edit</button>
                        <button type="button" class="btn btn-sm btn-alt-danger">Delete</button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-alt-danger">Delete</button>
                        <button type="button" class="btn btn-sm btn-alt-primary">Edit</button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Cancel</button>
                        <button type="button" class="btn btn-sm btn-outline-primary">Ok</button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <button type="button" class="btn btn-sm btn-outline-primary">Ok</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Cancel</button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- END Bootstrap Buttons in Options -->

    <!-- Text in Options -->
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">Text 1</div>
                        <div class="block-options-item">Text 2</div>
                        <div class="block-options-item">Text 3</div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">Text 1</div>
                        <div class="block-options-item">Text 2</div>
                        <div class="block-options-item">Text 3</div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item text-danger">Special!</div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item text-success">Looking Good!</div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- END Text in Options -->

    <!-- Alerts in Options -->
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <div class="alert alert-warning py-2 mb-0">
                                <i class="fa fa-exclamation-triangle mr-1"></i> This is an alert!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <div class="alert alert-warning py-2 mb-0">
                                This is an alert! <i class="fa fa-exclamation-triangle ml-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <div class="alert alert-info py-2 mb-0">
                                <i class="fa fa-info-circle mr-1"></i> Info
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <div class="alert alert-info py-2 mb-0">
                                Info! <i class="fa fa-info-circle ml-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <div class="alert alert-success py-2 mb-0">
                                <i class="fa fa-check-circle mr-1"></i> Success
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <div class="alert alert-success py-2 mb-0">
                                Success! <i class="fa fa-check-circle ml-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <div class="alert alert-danger py-2 mb-0">
                                <i class="fa fa-times-circle mr-1"></i> Failure
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <div class="alert alert-danger py-2 mb-0">
                                Failure! <i class="fa fa-times-circle ml-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- END Alerts in Options -->

    <!-- Badges in Options -->
    <div class="row">
        <div class="col-md-6">
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <span class="badge badge-primary">15</span>
                        </div>
                        <div class="block-options-item">
                            <span class="badge badge-success">Yes!</span>
                        </div>
                        <div class="block-options-item">
                            <span class="badge badge-warning">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        </div>
                        <div class="block-options-item">
                            <span class="badge badge-danger badge-pill">Pill Badge</span>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="block">
                <div class="block-header block-header-rtl">
                    <h3 class="block-title">Title <small>Subtitle</small></h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <span class="badge badge-danger badge-pill">Pill Badge</span>
                        </div>
                        <div class="block-options-item">
                            <span class="badge badge-warning">
                                <i class="fa fa-exclamation-triangle"></i>
                            </span>
                        </div>
                        <div class="block-options-item">
                            <span class="badge badge-success">Yes!</span>
                        </div>
                        <div class="block-options-item">
                            <span class="badge badge-primary">15</span>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium'); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- END Badges in Options -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
