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
                Tabs <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Generate tabbed interfaces with ease.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Elements</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Tabs</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<!-- Bootstrap Tabs (data-toggle="tabs" is initialized in Helpers.coreBootstrapTabs()) -->
<div class="content">
    <!-- Block Tabs -->
    <h2 class="content-heading">Block Tabs</h2>
    <div class="row">
        <div class="col-lg-6">
            <!-- Block Tabs Default Style -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabs-static-home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabs-static-profile">Profile</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="#btabs-static-settings">
                            <i class="si si-settings"></i>
                        </a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-static-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabs-static-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabs-static-settings" role="tabpanel">
                        <h4 class="font-w400">Settings Content</h4>
                        <p>...</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs Default Style -->

            <!-- Block Tabs Alternative Style -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabs-alt-static-home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabs-alt-static-profile">Profile</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="#btabs-alt-static-settings"><i class="si si-settings"></i></a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-alt-static-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabs-alt-static-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabs-alt-static-settings" role="tabpanel">
                        <h4 class="font-w400">Settings Content</h4>
                        <p>...</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs Alternative Style -->
        </div>
        <div class="col-lg-6">
            <!-- Block Tabs Default Style (Right) -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block justify-content-end" data-toggle="tabs" role="tablist">
                    <li class="nav-item mr-auto">
                        <a class="nav-link" href="#btabs-static2-settings"><i class="si si-settings"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabs-static2-profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabs-static2-home">Home</a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-static2-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabs-static2-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabs-static2-settings" role="tabpanel">
                        <h4 class="font-w400">Settings Content</h4>
                        <p>...</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs Default Style (Right) -->

            <!-- Block Tabs Alternative Style (Right) -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-alt justify-content-end" data-toggle="tabs" role="tablist">
                    <li class="nav-item mr-auto">
                        <a class="nav-link" href="#btabs-alt-static2-settings"><i class="si si-settings"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabs-alt-static2-profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabs-alt-static2-home">Home</a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabs-alt-static2-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabs-alt-static2-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabs-alt-static2-settings" role="tabpanel">
                        <h4 class="font-w400">Settings Content</h4>
                        <p>...</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs Alternative Style (Right) -->
        </div>
    </div>
    <!-- END Block Tabs -->

    <!-- Block Tabs With Options -->
    <h2 class="content-heading">Block Tabs With Options</h2>
    <div class="row">
        <div class="col-lg-6">
            <!-- Block Tabs With Options Default Style -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabswo-static-home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabswo-static-profile">Profile</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <div class="block-options pl-3 pr-2">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                                <i class="si si-close"></i>
                            </button>
                        </div>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabswo-static-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabswo-static-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>...</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs With Options Default Style -->

            <!-- Block Tabs With Button Options Default Style -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block align-items-center" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabswob-static-home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabswob-static-profile">Profile</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <div class="btn-group btn-group-sm pr-2">
                            <button type="button" class="btn btn-primary">
                                <i class="fa fa-fw fa-undo"></i>
                            </button>
                            <button type="button" class="btn btn-primary">
                                <i class="fa fa-fw fa-redo"></i>
                            </button>
                            <button type="button" class="btn btn-primary">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-primary dropdown-toggle" id="btnGroupTabs1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More
                                </button>
                                <div class="dropdown-menu dropdown-menu-right font-size-sm" aria-labelledby="btnGroupTabs1">
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="fa fa-fw fa-bell mr-1"></i> News
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
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabswob-static-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabswob-static-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>...</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs With Button Options Default Style -->
        </div>
        <div class="col-lg-6">
            <!-- Block Tabs With Options Default Style (Right) -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block justify-content-end align-items-center" data-toggle="tabs" role="tablist">
                    <li class="nav-item mr-auto">
                        <div class="block-options pl-2 pr-3">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="close">
                                <i class="si si-close"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabswo-static2-profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabswo-static2-home">Home</a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabswo-static2-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabswo-static2-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>...</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs With Options Default Style (Right) -->

            <!-- Block Tabs With Button Options Default Style (Right) -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block justify-content-end align-items-center" data-toggle="tabs" role="tablist">
                    <li class="nav-item mr-auto">
                        <div class="btn-group btn-group-sm pl-2">
                            <div class="btn-group btn-group-sm" role="group">
                                <button type="button" class="btn btn-primary dropdown-toggle" id="btnGroupTabs2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    More
                                </button>
                                <div class="dropdown-menu font-size-sm" aria-labelledby="btnGroupTabs2">
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="fa fa-fw fa-bell mr-1"></i> News
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
                            <button type="button" class="btn btn-primary">
                                <i class="fa fa-fw fa-undo"></i>
                            </button>
                            <button type="button" class="btn btn-primary">
                                <i class="fa fa-fw fa-redo"></i>
                            </button>
                            <button type="button" class="btn btn-primary">
                                <i class="fa fa-fw fa-pencil-alt"></i>
                            </button>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabswob-static-profile2">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabswob-static-home2">Home</a>
                    </li>
                </ul>
                <div class="block-content tab-content">
                    <div class="tab-pane active" id="btabswob-static-home2" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>...</p>
                    </div>
                    <div class="tab-pane" id="btabswob-static-profile2" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>...</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs With Button Options Default Style (Right) -->
        </div>
    </div>
    <!-- END Block Tabs With Options -->

    <!-- Block Tabs Content Animation -->
    <h2 class="content-heading">Tabs with Animation</h2>
    <div class="row">
        <div class="col-lg-6">
            <!-- Block Tabs Animated Fade -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabs-animated-fade-home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabs-animated-fade-profile">Profile</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="#btabs-animated-fade-settings">
                            <i class="si si-settings"></i>
                        </a>
                    </li>
                </ul>
                <div class="block-content tab-content overflow-hidden">
                    <div class="tab-pane fade show active" id="btabs-animated-fade-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>Content fades in..</p>
                    </div>
                    <div class="tab-pane fade" id="btabs-animated-fade-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>Content fades in..</p>
                    </div>
                    <div class="tab-pane fade" id="btabs-animated-fade-settings" role="tabpanel">
                        <h4 class="font-w400">Settings Content</h4>
                        <p>Content fades in..</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs Animated Fade -->

            <!-- Block Tabs Animated Slide Left -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabs-animated-slideleft-home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabs-animated-slideleft-profile">Profile</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="#btabs-animated-slideleft-settings">
                            <i class="si si-settings"></i>
                        </a>
                    </li>
                </ul>
                <div class="block-content tab-content overflow-hidden">
                    <div class="tab-pane fade fade-left show active" id="btabs-animated-slideleft-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>Content slides in to the left..</p>
                    </div>
                    <div class="tab-pane fade fade-left" id="btabs-animated-slideleft-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>Content slides in to the left..</p>
                    </div>
                    <div class="tab-pane fade fade-left" id="btabs-animated-slideleft-settings" role="tabpanel">
                        <h4 class="font-w400">Settings Content</h4>
                        <p>Content slides in to the left..</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs Animated Slide Left -->
        </div>
        <div class="col-lg-6">
            <!-- Block Tabs Animated Slide Up -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabs-animated-slideup-home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabs-animated-slideup-profile">Profile</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="#btabs-animated-slideup-settings">
                            <i class="si si-settings"></i>
                        </a>
                    </li>
                </ul>
                <div class="block-content tab-content overflow-hidden">
                    <div class="tab-pane fade fade-up show active" id="btabs-animated-slideup-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>Content slides up..</p>
                    </div>
                    <div class="tab-pane fade fade-up" id="btabs-animated-slideup-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>Content slides up..</p>
                    </div>
                    <div class="tab-pane fade fade-up" id="btabs-animated-slideup-settings" role="tabpanel">
                        <h4 class="font-w400">Settings Content</h4>
                        <p>Content slides up..</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs Animated Slide Up -->

            <!-- Block Tabs Animated Slide Right -->
            <div class="block">
                <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#btabs-animated-slideright-home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#btabs-animated-slideright-profile">Profile</a>
                    </li>
                    <li class="nav-item ml-auto">
                        <a class="nav-link" href="#btabs-animated-slideright-settings">
                            <i class="si si-settings"></i>
                        </a>
                    </li>
                </ul>
                <div class="block-content tab-content overflow-hidden">
                    <div class="tab-pane fade fade-right show active" id="btabs-animated-slideright-home" role="tabpanel">
                        <h4 class="font-w400">Home Content</h4>
                        <p>Content slides in to the right..</p>
                    </div>
                    <div class="tab-pane fade fade-right" id="btabs-animated-slideright-profile" role="tabpanel">
                        <h4 class="font-w400">Profile Content</h4>
                        <p>Content slides in to the right..</p>
                    </div>
                    <div class="tab-pane fade fade-right" id="btabs-animated-slideright-settings" role="tabpanel">
                        <h4 class="font-w400">Settings Content</h4>
                        <p>Content slides in to the right..</p>
                    </div>
                </div>
            </div>
            <!-- END Block Tabs Animated Slide Right -->
        </div>
    </div>
    <!-- END Block Tabs Content Animation -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
