<?php
/**
 * backend/views/inc_header.php
 *
 * Author: pixelcave
 *
 * The header of each page (Backend pages)
 *
 */
?>

<!-- Header -->
<header id="page-header">
    <!-- Header Content -->
    <div class="content-header">
        <!-- Left Section -->
        <div class="d-flex align-items-center">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-dual mr-2 d-lg-none" data-toggle="layout" data-action="sidebar_toggle">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Toggle Mini Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button type="button" class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block" data-toggle="layout" data-action="sidebar_mini_toggle">
                <i class="fa fa-fw fa-ellipsis-v"></i>
            </button>
            <!-- END Toggle Mini Sidebar -->

            <!-- Apps Modal -->
            <!-- Opens the Apps modal found at the bottom of the page, after footer’s markup -->
            <button type="button" class="btn btn-sm btn-dual mr-2" data-toggle="modal" data-target="#one-modal-apps">
                <i class="si si-grid"></i>
            </button>
            <!-- END Apps Modal -->

            <!-- Open Search Section (visible on smaller screens) -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-dual d-sm-none" data-toggle="layout" data-action="header_search_on">
                <i class="si si-magnifier"></i>
            </button>
            <!-- END Open Search Section -->

            <!-- Search Form (visible on larger screens) -->
            <form class="d-none d-sm-inline-block" action="be_pages_generic_search.php" method="POST">
                <div class="input-group input-group-sm">
                    <input type="text" class="form-control form-control-alt" placeholder="Search.." id="page-header-search-input2" name="page-header-search-input2">
                    <div class="input-group-append">
                        <span class="input-group-text bg-body border-0">
                            <i class="si si-magnifier"></i>
                        </span>
                    </div>
                </div>
            </form>
            <!-- END Search Form -->
        </div>
        <!-- END Left Section -->

        <!-- Right Section -->
        <div class="d-flex align-items-center">
            <!-- User Dropdown -->
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded" src="<?php echo $one->assets_folder; ?>/media/avatars/avatar10.jpg" alt="Header Avatar" style="width: 18px;">
                    <span class="d-none d-sm-inline-block ml-1">Adam</span>
                    <i class="fa fa-fw fa-angle-down d-none d-sm-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-user-dropdown">
                    <div class="p-3 text-center bg-primary">
                        <?php $one->get_avatar(10, '', 48, true); ?>
                    </div>
                    <div class="p-2">
                        <h5 class="dropdown-header text-uppercase">User Options</h5>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="be_pages_generic_inbox.php">
                            <span>Inbox</span>
                            <span>
                                <span class="badge badge-pill badge-primary">3</span>
                                <i class="si si-envelope-open ml-1"></i>
                            </span>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="be_pages_generic_profile.php">
                            <span>Profile</span>
                            <span>
                                <span class="badge badge-pill badge-success">1</span>
                                <i class="si si-user ml-1"></i>
                            </span>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="javascript:void(0)">
                            <span>Settings</span>
                            <i class="si si-settings"></i>
                        </a>
                        <div role="separator" class="dropdown-divider"></div>
                        <h5 class="dropdown-header text-uppercase">Actions</h5>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="op_auth_lock.php">
                            <span>Lock Account</span>
                            <i class="si si-lock ml-1"></i>
                        </a>
                        <a class="dropdown-item d-flex align-items-center justify-content-between" href="op_auth_signin.php">
                            <span>Log Out</span>
                            <i class="si si-logout ml-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            <!-- END User Dropdown -->

            <!-- Notifications Dropdown -->
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn btn-sm btn-dual" id="page-header-notifications-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="si si-bell"></i>
                    <span class="badge badge-primary badge-pill">6</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0 border-0 font-size-sm" aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-2 bg-primary text-center">
                        <h5 class="dropdown-header text-uppercase text-white">Notifications</h5>
                    </div>
                    <ul class="nav-items mb-0">
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="mr-2 ml-3">
                                    <i class="fa fa-fw fa-check-circle text-success"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">You have a new follower</div>
                                    <small class="text-muted">15 min ago</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="mr-2 ml-3">
                                    <i class="fa fa-fw fa-plus-circle text-info"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">1 new sale, keep it up</div>
                                    <small class="text-muted">22 min ago</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="mr-2 ml-3">
                                    <i class="fa fa-fw fa-times-circle text-danger"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">Update failed, restart server</div>
                                    <small class="text-muted">26 min ago</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="mr-2 ml-3">
                                    <i class="fa fa-fw fa-plus-circle text-info"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">2 new sales, keep it up</div>
                                    <small class="text-muted">33 min ago</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="mr-2 ml-3">
                                    <i class="fa fa-fw fa-user-plus text-success"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">You have a new subscriber</div>
                                    <small class="text-muted">41 min ago</small>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a class="text-dark media py-2" href="javascript:void(0)">
                                <div class="mr-2 ml-3">
                                    <i class="fa fa-fw fa-check-circle text-success"></i>
                                </div>
                                <div class="media-body pr-2">
                                    <div class="font-w600">You have a new follower</div>
                                    <small class="text-muted">42 min ago</small>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="p-2 border-top">
                        <a class="btn btn-sm btn-light btn-block text-center" href="javascript:void(0)">
                            <i class="fa fa-fw fa-arrow-down mr-1"></i> Load More..
                        </a>
                    </div>
                </div>
            </div>
            <!-- END Notifications Dropdown -->

            <!-- Toggle Side Overlay -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
            <button type="button" class="btn btn-sm btn-dual ml-2" data-toggle="layout" data-action="side_overlay_toggle">
                <i class="fa fa-fw fa-list-ul fa-flip-horizontal"></i>
            </button>
            <!-- END Toggle Side Overlay -->
        </div>
        <!-- END Right Section -->
    </div>
    <!-- END Header Content -->

    <!-- Header Search -->
    <div id="page-header-search" class="overlay-header bg-white">
        <div class="content-header">
            <form class="w-100" action="be_pages_generic_search.php" method="POST">
                <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <button type="button" class="btn btn-danger" data-toggle="layout" data-action="header_search_off">
                            <i class="fa fa-fw fa-times-circle"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                </div>
            </form>
       </div>
    </div>
    <!-- END Header Search -->

    <!-- Header Loader -->
    <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
    <div id="page-header-loader" class="overlay-header bg-white">
        <div class="content-header">
            <div class="w-100 text-center">
                <i class="fa fa-fw fa-circle-notch fa-spin"></i>
            </div>
        </div>
    </div>
    <!-- END Header Loader -->
</header>
<!-- END Header -->
