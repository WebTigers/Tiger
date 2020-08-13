<?php
/**
 * backend/views/inc_side_overlay.php
 *
 * Author: pixelcave
 *
 * The side overlay of each page (Backend pages)
 *
 */
?>
<!-- Side Overlay-->
<aside id="side-overlay" class="font-size-sm">
    <!-- Side Header -->
    <div class="content-header border-bottom">
        <!-- User Avatar -->
        <a class="img-link mr-1" href="javascript:void(0)">
            <?php $one->get_avatar(10, '', 32); ?>
        </a>
        <!-- END User Avatar -->

        <!-- User Info -->
        <div class="ml-2">
            <a class="link-fx text-dark font-w600" href="javascript:void(0)">Adam McCoy</a>
        </div>
        <!-- END User Info -->

        <!-- Close Side Overlay -->
        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
        <a class="ml-auto btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_close">
            <i class="fa fa-fw fa-times text-danger"></i>
        </a>
        <!-- END Close Side Overlay -->
    </div>
    <!-- END Side Header -->

    <!-- Side Content -->
    <div class="content-side">
        <!-- Side Overlay Tabs -->
        <div class="block block-transparent pull-x pull-t">
            <ul class="nav nav-tabs nav-tabs-alt nav-justified" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#so-overview">
                        <i class="fa fa-fw fa-coffee text-gray mr-1"></i> Overview
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#so-sales">
                        <i class="fa fa-fw fa-chart-line text-gray mr-1"></i> Sales
                    </a>
                </li>
            </ul>
            <div class="block-content tab-content overflow-hidden">
                <!-- Overview Tab -->
                <div class="tab-pane pull-x fade fade-left show active" id="so-overview" role="tabpanel">
                    <!-- Activity -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Recent Activity</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <!-- Activity List -->
                            <ul class="nav-items mb-0">
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="si si-wallet text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">New sale ($15)</div>
                                            <div class="text-success">Admin Template</div>
                                            <small class="text-muted">3 min ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="si si-pencil text-info"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">You edited the file</div>
                                            <div class="text-info">
                                                <i class="fa fa-file-text"></i> Documentation.doc
                                            </div>
                                            <small class="text-muted">15 min ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="si si-close text-danger"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">Project deleted</div>
                                            <div class="text-danger">Line Icon Set</div>
                                            <small class="text-muted">4 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <!-- END Activity List -->
                        </div>
                    </div>
                    <!-- END Activity -->

                    <!-- Online Friends -->
                    <div class="block">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Online Friends</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                    <i class="si si-refresh"></i>
                                </button>
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <!-- Users Navigation -->
                            <ul class="nav-items mb-0">
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                            <?php $one->get_avatar(0, 'female', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('female'); ?></div>
                                            <div class="font-w400 text-muted">Copywriter</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                            <?php $one->get_avatar(0, 'male', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('male'); ?></div>
                                            <div class="font-w400 text-muted">Web Developer</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                            <?php $one->get_avatar(0, 'female', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('female'); ?></div>
                                            <div class="font-w400 text-muted">Web Designer</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                            <?php $one->get_avatar(0, 'female', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-warning"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('female'); ?></div>
                                            <div class="font-w400 text-muted">Photographer</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-bottom">
                                            <?php $one->get_avatar(0, 'male', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-warning"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('male'); ?></div>
                                            <div class="font-w400 text-muted">Graphic Designer</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                            <!-- END Users Navigation -->
                        </div>
                    </div>
                    <!-- END Online Friends -->

                    <!-- Quick Settings -->
                    <div class="block mb-0">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">Quick Settings</h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                            </div>
                        </div>
                        <div class="block-content">
                            <!-- Quick Settings Form -->
                            <form action="be_pages_dashboard.php" method="POST" onsubmit="return false;">
                                <div class="form-group">
                                    <p class="font-w600 mb-2">
                                        Online Status
                                    </p>
                                    <div class="custom-control custom-switch mb-1">
                                        <input type="checkbox" class="custom-control-input" id="so-settings-check1" name="so-settings-check1" checked>
                                        <label class="custom-control-label" for="so-settings-check1">Show your status to all</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p class="font-w600 mb-2">
                                        Auto Updates
                                    </p>
                                    <div class="custom-control custom-switch mb-1">
                                        <input type="checkbox" class="custom-control-input" id="so-settings-check2" name="so-settings-check2" checked>
                                        <label class="custom-control-label" for="so-settings-check2">Keep up to date</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p class="font-w600 mb-1">
                                        Application Alerts
                                    </p>
                                    <div class="custom-control custom-switch mb-1">
                                        <input type="checkbox" class="custom-control-input" id="so-settings-check3" name="so-settings-check3" checked>
                                        <label class="custom-control-label" for="so-settings-check3">Email Notifications</label>
                                    </div>
                                    <div class="custom-control custom-switch mb-1">
                                        <input type="checkbox" class="custom-control-input" id="so-settings-check4" name="so-settings-check4" checked>
                                        <label class="custom-control-label" for="so-settings-check4">SMS Notifications</label>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group">
                                    <p class="font-w600 mb-1">
                                        API
                                    </p>
                                    <div class="custom-control custom-switch mb-1">
                                        <input type="checkbox" class="custom-control-input" id="so-settings-check5" name="so-settings-check5" checked>
                                        <label class="custom-control-label" for="so-settings-check5">Enable access</label>
                                    </div>
                                </div>
                            </form>
                            <!-- END Quick Settings Form -->
                        </div>
                    </div>
                    <!-- END Quick Settings -->
                </div>
                <!-- END Overview Tab -->

                <!-- Sales Tab -->
                <div class="tab-pane pull-x fade fade-right" id="so-sales" role="tabpanel">
                    <div class="block mb-0">
                        <!-- Stats -->
                        <div class="block-content">
                            <div class="row items-push pull-t">
                                <div class="col-6">
                                    <div class="font-w700 text-uppercase">Sales</div>
                                    <a class="link-fx font-size-h3 font-w300" href="javascript:void(0)">22.030</a>
                                </div>
                                <div class="col-6">
                                    <div class="font-w700 text-uppercase">Balance</div>
                                    <a class="link-fx font-size-h3 font-w300" href="javascript:void(0)">$4.589,00</a>
                                </div>
                            </div>
                        </div>
                        <!-- END Stats -->

                        <!-- Today -->
                        <div class="block-content block-content-full block-content-sm bg-body-light">
                            <div class="row">
                                <div class="col-6">
                                    <span class="font-w600 text-uppercase">Today</span>
                                </div>
                                <div class="col-6 text-right">
                                    <span class="ext-muted">$996</span>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <ul class="nav-items push">
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">New sale! + $249</div>
                                            <small class="text-muted">3 min ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">New sale! + $129</div>
                                            <small class="text-muted">50 min ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">New sale! + $119</div>
                                            <small class="text-muted">2 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">New sale! + $499</div>
                                            <small class="text-muted">3 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- END Today -->

                        <!-- Yesterday -->
                        <div class="block-content block-content-full block-content-sm bg-body-light">
                            <div class="row">
                                <div class="col-6">
                                    <span class="font-w600 text-uppercase">Yesterday</span>
                                </div>
                                <div class="col-6 text-right">
                                    <span class="text-muted">$765</span>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <ul class="nav-items push">
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">New sale! + $249</div>
                                            <small class="text-muted">26 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-danger"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">Product Purchase - $50</div>
                                            <small class="text-muted">28 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">New sale! + $119</div>
                                            <small class="text-muted">29 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-danger"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">Paypal Withdrawal - $300</div>
                                            <small class="text-muted">37 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">New sale! + $129</div>
                                            <small class="text-muted">39 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">New sale! + $119</div>
                                            <small class="text-muted">45 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="text-dark media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2">
                                            <i class="fa fa-fw fa-circle text-success"></i>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600">New sale! + $499</div>
                                            <small class="text-muted">46 hours ago</small>
                                        </div>
                                    </a>
                                </li>
                            </ul>

                            <!-- More -->
                            <div class="text-center">
                                <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                    <i class="fa fa-arrow-down mr-1"></i> Load More..
                                </a>
                            </div>
                            <!-- END More -->
                        </div>
                        <!-- END Yesterday -->
                    </div>
                </div>
                <!-- END Sales Tab -->
            </div>
        </div>
        <!-- END Side Overlay Tabs -->
    </div>
    <!-- END Side Content -->
</aside>
<!-- END Side Overlay -->
