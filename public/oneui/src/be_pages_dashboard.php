<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-image overflow-hidden" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo3@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-narrow content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center mt-5 mb-2 text-center text-sm-left">
                <div class="flex-sm-fill">
                    <h1 class="font-w600 text-white mb-0 invisible" data-toggle="appear">Dashboard</h1>
                    <h2 class="h4 font-w400 text-white-75 mb-0 invisible" data-toggle="appear" data-timeout="250">Welcome Administrator</h2>
                </div>
                <div class="flex-sm-00-auto mt-3 mt-sm-0 ml-sm-3">
                    <span class="d-inline-block invisible" data-toggle="appear" data-timeout="350">
                        <a class="btn btn-primary px-4 py-2" data-toggle="click-ripple" href="javascript:void(0)">
                            <i class="fa fa-plus mr-1"></i> New Project
                        </a>
                    </span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-narrow">
    <!-- Stats -->
    <div class="row">
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Visitors</div>
                    <div class="font-size-h2 font-w400 text-dark">120,580</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Sales</div>
                    <div class="font-size-h2 font-w400 text-dark">150</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Earnings</div>
                    <div class="font-size-h2 font-w400 text-dark">$3,200</div>
                </div>
            </a>
        </div>
        <div class="col-6 col-md-3 col-lg-6 col-xl-3">
            <a class="block block-rounded block-link-pop border-left border-primary border-4x" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-sm font-w600 text-uppercase text-muted">Avg Sale</div>
                    <div class="font-size-h2 font-w400 text-dark">$21</div>
                </div>
            </a>
        </div>
    </div>
    <!-- END Stats -->

    <!-- Dashboard Charts -->
    <div class="row">
        <div class="col-lg-6">
            <div class="block block-rounded block-mode-loading-oneui">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Earnings in $</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content p-0 text-center">
                    <!-- Chart.js is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _es6/pages/be_pages_dashboard.js) -->
                    <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                    <div class="pt-3" style="height: 360px;"><canvas class="js-chartjs-dashboard-earnings"></canvas></div>
                </div>
                <div class="block-content">
                    <div class="row items-push text-center py-3">
                        <div class="col-6 col-xl-3">
                            <i class="fa fa-wallet fa-2x text-muted"></i>
                            <div class="text-muted mt-3">$148,000</div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <i class="fa fa-angle-double-up fa-2x text-muted"></i>
                            <div class="text-muted mt-3">+9% Earnings</div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <i class="fa fa-ticket-alt fa-2x text-muted"></i>
                            <div class="text-muted mt-3">+20% Tickets</div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <i class="fa fa-users fa-2x text-muted"></i>
                            <div class="text-muted mt-3">+46% Clients</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="block block-rounded block-mode-loading-oneui">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Sales</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content p-0 text-center">
                    <!-- Chart.js is initialized in js/pages/be_pages_dashboard.min.js which was auto compiled from _es6/pages/be_pages_dashboard.js) -->
                    <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
                    <div class="pt-3" style="height: 360px;"><canvas class="js-chartjs-dashboard-sales"></canvas></div>
                </div>
                <div class="block-content">
                    <div class="row items-push text-center py-3">
                        <div class="col-6 col-xl-3">
                            <i class="fab fa-wordpress fa-2x text-muted"></i>
                            <div class="text-muted mt-3">+20% Themes</div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <i class="fa fa-font fa-2x text-muted"></i>
                            <div class="text-muted mt-3">+25% Fonts</div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <i class="fa fa-archive fa-2x text-muted"></i>
                            <div class="text-muted mt-3">-10% Icons</div>
                        </div>
                        <div class="col-6 col-xl-3">
                            <i class="fa fa-paint-brush fa-2x text-muted"></i>
                            <div class="text-muted mt-3">+8% Graphics</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Dashboard Charts -->

    <!-- Customers and Latest Orders -->
    <div class="row row-deck">
        <!-- Latest Customers -->
        <div class="col-lg-6">
            <div class="block block-mode-loading-oneui">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Latest Customers</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                        <thead>
                            <tr class="text-uppercase">
                                <th class="font-w700" style="width: 80px;">ID</th>
                                <th class="d-none d-sm-table-cell font-w700 text-center" style="width: 100px;">Photo</th>
                                <th class="font-w700">Name</th>
                                <th class="d-none d-sm-table-cell font-w700 text-center" style="width: 80px;">Orders</th>
                                <th class="font-w700 text-center" style="width: 60px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="font-w600">#01368</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <?php $one->get_avatar(0, 'male', 32); ?>
                                </td>
                                <td class="font-w600">
                                    <?php $one->get_name('male'); ?>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <a class="link-fx font-w600" href="javascript:void(0)">5</a>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#01368</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <?php $one->get_avatar(0, 'female', 32); ?>
                                </td>
                                <td class="font-w600">
                                    <?php $one->get_name('female'); ?>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <a class="link-fx font-w600" href="javascript:void(0)">14</a>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#01368</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <?php $one->get_avatar(0, 'male', 32); ?>
                                </td>
                                <td class="font-w600">
                                    <?php $one->get_name('male'); ?>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <a class="link-fx font-w600" href="javascript:void(0)">15</a>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#01368</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <?php $one->get_avatar(0, 'female', 32); ?>
                                </td>
                                <td class="font-w600">
                                    <?php $one->get_name('female'); ?>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <a class="link-fx font-w600" href="javascript:void(0)">36</a>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#01368</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <?php $one->get_avatar(0, 'male', 32); ?>
                                </td>
                                <td class="font-w600">
                                    <?php $one->get_name('male'); ?>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <a class="link-fx font-w600" href="javascript:void(0)">3</a>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#01368</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <?php $one->get_avatar(0, 'female', 32); ?>
                                </td>
                                <td class="font-w600">
                                    <?php $one->get_name('female'); ?>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <a class="link-fx font-w600" href="javascript:void(0)">1</a>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#01368</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <?php $one->get_avatar(0, 'male', 32); ?>
                                </td>
                                <td class="font-w600">
                                    <?php $one->get_name('male'); ?>
                                </td>
                                <td class="d-none d-sm-table-cell text-center">
                                    <a class="link-fx font-w600" href="javascript:void(0)">12</a>
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Latest Customers -->

        <!-- Latest Orders -->
        <div class="col-lg-6">
            <div class="block block-mode-loading-oneui">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Latest Orders</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                        <button type="button" class="btn-block-option">
                            <i class="si si-settings"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <table class="table table-striped table-hover table-borderless table-vcenter font-size-sm mb-0">
                        <thead>
                            <tr class="text-uppercase">
                                <th class="font-w700">ID</th>
                                <th class="d-none d-sm-table-cell font-w700">Date</th>
                                <th class="font-w700">State</th>
                                <th class="d-none d-sm-table-cell font-w700 text-right" style="width: 120px;">Price</th>
                                <th class="font-w700 text-center" style="width: 60px;"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <span class="font-w600">#07835</span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="font-size-sm text-muted">today</span>
                                </td>
                                <td>
                                    <span class="font-w600 text-warning">Pending..</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    $999,99
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Manage">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#07834</span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="font-size-sm text-muted">today</span>
                                </td>
                                <td>
                                    <span class="font-w600 text-warning">Pending..</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    $2.299,00
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Manage">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#07833</span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="font-size-sm text-muted">today</span>
                                </td>
                                <td>
                                    <span class="font-w600 text-success">Completed</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    $1200,00
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Manage">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#07832</span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="font-size-sm text-muted">today</span>
                                </td>
                                <td>
                                    <span class="font-w600 text-danger">Cancelled</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    $399,00
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Manage">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#07831</span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="font-size-sm text-muted">yesterday</span>
                                </td>
                                <td>
                                    <span class="font-w600 text-success">Completed</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    $349,00
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Manage">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#07830</span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="font-size-sm text-muted">yesterday</span>
                                </td>
                                <td>
                                    <span class="font-w600 text-success">Completed</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    $999,00
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Manage">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#07829</span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="font-size-sm text-muted">yesterday</span>
                                </td>
                                <td>
                                    <span class="font-w600 text-success">Completed</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    $39,99
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Manage">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#07828</span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="font-size-sm text-muted">yesterday</span>
                                </td>
                                <td>
                                    <span class="font-w600 text-success">Completed</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    $499,00
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Manage">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <span class="font-w600">#07827</span>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <span class="font-size-sm text-muted">yesterday</span>
                                </td>
                                <td>
                                    <span class="font-w600 text-success">Completed</span>
                                </td>
                                <td class="d-none d-sm-table-cell text-right">
                                    $325,00
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" data-toggle="tooltip" data-placement="left" title="Manage">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END Latest Orders -->
    </div>
    <!-- END Customers and Latest Orders -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/chart.js/Chart.bundle.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_pages_dashboard.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
