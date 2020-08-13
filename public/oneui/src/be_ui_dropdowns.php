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
                Dropdowns <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Toggle contextual overlays for displaying lists of links and more.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Elements</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Dropdowns</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Normal -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Normal</h3>
        </div>
        <div class="block-content">
            <!-- Default Style -->
            <p class="font-size-sm text-muted">
                You can easily attach a dropdown to a default button and add various actions
            </p>
            <div class="row items-push mb-4">
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-primary dropdown-toggle" id="dropdown-default-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-primary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdown-default-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-secondary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-success dropdown-toggle" id="dropdown-default-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-success">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-info dropdown-toggle" id="dropdown-default-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-info">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-warning dropdown-toggle" id="dropdown-default-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-warning">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-danger dropdown-toggle" id="dropdown-default-danger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-danger">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-dark dropdown-toggle" id="dropdown-default-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-dark">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-light dropdown-toggle" id="dropdown-default-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-light">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Default Style -->

            <!-- Alternate Style -->
            <p class="font-size-sm text-muted">
                You can also add dropdowns to alternate styled buttons
            </p>
            <div class="row items-push mb-4">
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-alt-primary dropdown-toggle" id="dropdown-default-alt-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-alt-primary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-alt-secondary dropdown-toggle" id="dropdown-default-alt-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-alt-secondary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-alt-success dropdown-toggle" id="dropdown-default-alt-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-alt-success">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-alt-info dropdown-toggle" id="dropdown-default-alt-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-alt-info">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-alt-warning dropdown-toggle" id="dropdown-default-alt-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-alt-warning">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-alt-danger dropdown-toggle" id="dropdown-default-alt-danger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-alt-danger">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-alt-dark dropdown-toggle" id="dropdown-default-alt-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-alt-dark">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-alt-light dropdown-toggle" id="dropdown-default-alt-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-alt-light">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Alternate Style -->

            <!-- Outline Style -->
            <p class="font-size-sm text-muted">
                You can also add dropdowns to outline styled buttons
            </p>
            <div class="row items-push mb-4">
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" id="dropdown-default-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-outline-primary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" id="dropdown-default-outline-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-outline-secondary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-success dropdown-toggle" id="dropdown-default-outline-success" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-outline-success">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-info dropdown-toggle" id="dropdown-default-outline-info" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-outline-info">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-warning dropdown-toggle" id="dropdown-default-outline-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-outline-warning">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-danger dropdown-toggle" id="dropdown-default-outline-danger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-outline-danger">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-dark dropdown-toggle" id="dropdown-default-outline-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-outline-dark">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-4">
                    <div class="dropdown">
                        <button type="button" class="btn btn-outline-light dropdown-toggle" id="dropdown-default-outline-light" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-default-outline-light">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Outline Style -->
        </div>
    </div>
    <!-- END Normal -->

    <div class="row row-deck">
        <div class="col-md-6">
            <!-- Split Button Dropdowns -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Split Button Dropdowns</h3>
                </div>
                <div class="block-content">
                    <p class="font-size-sm text-muted">
                        Grouping your dropdowns with separate buttons is really easy
                    </p>
                    <div class="row items-push mb-4">
                        <div class="col-xl-4">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary">Action</button>
                                <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdown-split-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-split-primary">
                                    <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="btn-group">
                                <button type="button" class="btn btn-alt-danger">Action</button>
                                <button type="button" class="btn btn-alt-danger dropdown-toggle dropdown-toggle-split" id="dropdown-split-alt-danger" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-split-alt-danger">
                                    <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="btn-group">
                                <button type="button" class="btn btn-warning">Action</button>
                                <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" id="dropdown-split-warning" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-split-warning">
                                    <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)">Separated link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Split Button Dropdowns -->
        </div>
        <div class="col-md-6">
            <!-- Alignment -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Alignment</h3>
                </div>
                <div class="block-content">
                    <p class="font-size-sm text-muted">
                        You can align your dropmenus to the right of buttons
                    </p>
                    <div class="row items-push mb-4">
                        <div class="col-sm-6 text-right">
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" id="dropdown-align-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    From Right
                                </button>
                                <div class="dropdown-menu dropdown-menu-right font-size-sm" aria-labelledby="dropdown-align-primary">
                                    <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <div class="dropdown">
                                <button type="button" class="btn btn-alt-primary dropdown-toggle" id="dropdown-align-alt-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    From Right
                                </button>
                                <div class="dropdown-menu dropdown-menu-right font-size-sm" aria-labelledby="dropdown-align-alt-primary">
                                    <a class="dropdown-item" href="javascript:void(0)">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Alignment -->
        </div>
    </div>

    <!-- Rich Content -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Rich Content</h3>
        </div>
        <div class="block-content">
            <p class="font-size-sm text-muted">
                You can use any HTML content you want in your dropdowns such as forms
            </p>
            <div class="dropdown push">
                <button type="button" class="btn btn-primary dropdown-toggle" id="dropdown-content-rich-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Form in dropdown
                </button>
                <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-content-rich-primary">
                    <form class="p-2" action="be_ui_dropdowns.php" method="POST" onsubmit="return false;">
                        <div class="form-group">
                            <label for="dropdown-content-form-email">Email address</label>
                            <input type="email" class="form-control" id="dropdown-content-form-email" name="dropdown-content-form-email" placeholder="email@example.com">
                        </div>
                        <div class="form-group">
                            <label for="dropdown-content-form-password">Password</label>
                            <input type="password" class="form-control" id="dropdown-content-form-password" name="dropdown-content-form-password" placeholder="Password">
                        </div>
                        <button type="submit" class="btn btn-primary">Sign in</button>
                    </form>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-muted font-size-sm" href="javascript:void(0)">Sign up</a>
                    <a class="dropdown-item text-muted font-size-sm" href="javascript:void(0)">Forgot password?</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END Rich Content -->

    <!-- Position -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Position</h3>
        </div>
        <div class="block-content">
            <p class="font-size-sm text-muted">
                You can position your dropdown relative to your button
            </p>
            <div class="row items-push mb-4">
                <div class="col-md-4">
                    <!-- Dropup -->
                    <h3 class="h4">Dropup</h3>
                    <div class="dropdown dropup push">
                        <button type="button" class="btn btn-secondary dropdown-toggle" id="dropdown-dropup-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Up
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-dropup-secondary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                    <div class="dropdown dropup push">
                        <button type="button" class="btn btn-alt-secondary dropdown-toggle" id="dropdown-dropup-alt-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Up
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-dropup-alt-secondary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                    <div class="dropdown dropup">
                        <button type="button" class="btn btn-outline-secondary dropdown-toggle" id="dropdown-dropup-outline-secondary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Up
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-dropup-outline-secondary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                    <!-- END Dropup -->
                </div>
                <div class="col-md-4">
                    <!-- Dropright -->
                    <h3 class="h4">Dropright</h3>
                    <div class="dropdown dropright push">
                        <button type="button" class="btn btn-primary dropdown-toggle" id="dropdown-dropright-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Right
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-dropright-primary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                    <div class="dropdown dropright push">
                        <button type="button" class="btn btn-alt-primary dropdown-toggle" id="dropdown-dropright-alt-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Right
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-dropright-alt-primary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                    <div class="dropdown dropright">
                        <button type="button" class="btn btn-outline-primary dropdown-toggle" id="dropdown-dropright-outline-primary" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Right
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-dropright-outline-primary">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                    <!-- END Dropright -->
                </div>
                <div class="col-md-4 text-right">
                    <!-- Dropleft -->
                    <h3 class="h4">Dropleft</h3>
                    <div class="dropdown dropleft push">
                        <button type="button" class="btn btn-dark dropdown-toggle" id="dropdown-dropleft-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Left
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-dropleft-dark">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                    <div class="dropdown dropleft push">
                        <button type="button" class="btn btn-alt-dark dropdown-toggle" id="dropdown-dropleft-alt-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Left
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-dropleft-alt-dark">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                    <div class="dropdown dropleft">
                        <button type="button" class="btn btn-outline-dark dropdown-toggle" id="dropdown-dropleft-outline-dark" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Left
                        </button>
                        <div class="dropdown-menu font-size-sm" aria-labelledby="dropdown-dropleft-outline-dark">
                            <a class="dropdown-item" href="javascript:void(0)">Action</a>
                            <a class="dropdown-item" href="javascript:void(0)">Another action</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)">Something else here</a>
                        </div>
                    </div>
                    <!-- END Dropleft -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Position -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
