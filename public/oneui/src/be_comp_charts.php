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
                Charts <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Showcase your important data in a meaningful and empowering way.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Charts</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Chart.js Charts are initialized in js/pages/be_comp_charts.min.js which was auto compiled from _es6/pages/be_comp_charts.js -->
    <!-- For more info and examples you can check out http://www.chartjs.org/docs/ -->
    <h2 class="content-heading">Chart.js</h2>
    <div class="row">
        <div class="col-xl-6">
            <!-- Lines Chart -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Lines</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <div class="py-3">
                        <!-- Lines Chart Container -->
                        <canvas class="js-chartjs-lines"></canvas>
                    </div>
                </div>
            </div>
            <!-- END Lines Chart -->
        </div>
        <div class="col-xl-6">
            <!-- Bars Chart -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Bars</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <div class="py-3">
                        <!-- Bars Chart Container -->
                        <canvas class="js-chartjs-bars"></canvas>
                    </div>
                </div>
            </div>
            <!-- END Bars Chart -->
        </div>
        <div class="col-xl-6">
            <!-- Radar Chart -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Radar</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <div class="py-3">
                        <!-- Radar Chart Container -->
                        <canvas class="js-chartjs-radar"></canvas>
                    </div>
                </div>
            </div>
            <!-- END Radar Chart -->
        </div>
        <div class="col-xl-6">
            <!-- Polar Area Chart -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Polar Area</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <div class="py-3">
                        <!-- Polar Area Chart Container -->
                        <canvas class="js-chartjs-polar"></canvas>
                    </div>
                </div>
            </div>
            <!-- END Polar Area Chart -->
        </div>
        <div class="col-xl-6">
            <!-- Pie Chart -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Pie</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <div class="py-3">
                        <!-- Pie Chart Container -->
                        <canvas class="js-chartjs-pie"></canvas>
                    </div>
                </div>
            </div>
            <!-- END Pie Chart -->
        </div>
        <div class="col-xl-6">
            <!-- Donut Chart -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Donut</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full text-center">
                    <div class="py-3">
                        <!-- Donut Chart Container -->
                        <canvas class="js-chartjs-donut"></canvas>
                    </div>
                </div>
            </div>
            <!-- END Donut Chart -->
        </div>
    </div>
    <!-- END Chart.js Charts -->

    <!-- Sparkline Charts (.js-sparkline class is initialized in Helpers.sparkline() -->
    <!-- For more info and examples you can check out http://omnipotent.net/jquery.sparkline/#s-about -->
    <h2 class="content-heading">Sparkline</h2>
    <div class="row">
        <div class="col-xl-6">
            <!-- Bars -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Bars</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row text-center invisible" data-toggle="appear">
                        <div class="col-6 col-md-4 py-3">
                            <!-- Sparkline Bar 1 Container -->
                            <span class="js-sparkline" data-type="bar"
                                                        data-points="[4,3,2,4,5,7,8,4]"
                                                        data-bar-color="#fadb7d"
                                                        data-tooltip-suffix="Tickets"></span>
                            <div class="mt-2">
                                <i class="fa fa-ticket-alt mr-1 text-black-50"></i> Tickets
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Sparkline Bar 2 Container -->
                            <span class="js-sparkline" data-type="bar"
                                                        data-points="[980,1210,1350,900,500,700,1500,1485]"
                                                        data-bar-color="#abe37d"
                                                        data-tooltip-prefix="$"></span>
                            <div class="mt-2">
                                <i class="fa fa-chart-line mr-1 text-black-50"></i> Earnings
                            </div>
                        </div>
                        <div class="col-12 col-md-4 py-3">
                            <!-- Sparkline Bar 3 Container -->
                            <span class="js-sparkline" data-type="bar"
                                                        data-points="[8,11,9,8,7,5,10,12]"
                                                        data-bar-color="#faad7d"
                                                        data-tooltip-suffix="Sales"></span>
                            <div class="mt-2">
                                <i class="fa fa-briefcase mr-1 text-black-50"></i> Sales
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Bars -->
        </div>
        <div class="col-xl-6">
            <!-- Lines -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Lines</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row text-center invisible" data-toggle="appear">
                        <div class="col-6 col-md-4 py-3">
                            <!-- Sparkline Line 1 Container -->
                            <span class="js-sparkline" data-type="line"
                                                        data-points="[4,3,2,4,5,7,8,4]"
                                                        data-line-color="#fadb7d"
                                                        data-fill-color="#fadb7d"
                                                        data-tooltip-suffix="Tickets"></span>
                            <div class="mt-2">
                                <i class="fa fa-ticket-alt mr-1 text-black-50"></i> Tickets
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Sparkline Line 2 Container -->
                            <span class="js-sparkline" data-type="line"
                                                        data-points="[980,1210,1350,900,500,700,1500,1485]"
                                                        data-line-color="#abe37d"
                                                        data-fill-color="#abe37d"
                                                        data-tooltip-prefix="$"></span>
                            <div class="mt-2">
                                <i class="fa fa-chart-line mr-1 text-black-50"></i> Earnings
                            </div>
                        </div>
                        <div class="col-12 col-md-4 py-3">
                            <!-- Sparkline Line 3 Container -->
                            <span class="js-sparkline" data-type="line"
                                                        data-points="[8,11,9,8,7,5,10,12]"
                                                        data-line-color="#faad7d"
                                                        data-fill-color="#faad7d"
                                                        data-tooltip-suffix="Sales"></span>
                            <div class="mt-2">
                                <i class="fa fa-briefcase mr-1 text-black-50"></i> Sales
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Lines -->
        </div>
        <div class="col-xl-6">
            <!-- Pie -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Pie</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row text-center invisible" data-toggle="appear">
                        <div class="col-6 col-md-4 py-3">
                            <!-- Sparkline Pie 1 Container -->
                            <span class="js-sparkline" data-type="pie"
                                                        data-points="[4,3,2,4]"
                                                        data-width="50px"
                                                        data-height="50px"
                                                        data-tooltip-suffix="Tickets"></span>
                            <div class="mt-2">
                                <i class="fa fa-ticket-alt mr-1 text-black-50"></i> Tickets
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Sparkline Pie 2 Container -->
                            <span class="js-sparkline" data-type="pie"
                                                        data-points="[980,1210,1350,900]"
                                                        data-width="50px"
                                                        data-height="50px"
                                                        data-tooltip-prefix="$"></span>
                            <div class="mt-2">
                                <i class="fa fa-chart-line mr-1 text-black-50"></i> Earnings
                            </div>
                        </div>
                        <div class="col-12 col-md-4 py-3">
                            <!-- Sparkline Pie 3 Container -->
                            <span class="js-sparkline" data-type="pie"
                                                        data-points="[8,11,9,8]"
                                                        data-width="50px"
                                                        data-height="50px"
                                                        data-tooltip-suffix="Sales"></span>
                            <div class="mt-2">
                                <i class="fa fa-briefcase mr-1 text-black-50"></i> Sales
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Pie -->
        </div>
        <div class="col-xl-6">
            <!-- Tristate -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Tristate</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row text-center invisible" data-toggle="appear">
                        <div class="col-6 col-md-4 py-3">
                            <!-- Sparkline Tristate 1 Container -->
                            <span class="js-sparkline" data-type="tristate" data-height="80px" data-bar-width="8" data-bar-spacing="6" data-pos-bar-color="#abe37d" data-neg-bar-color="#faad7d" data-points="[-1,1,0,1,1,-1,0,1]"></span>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Sparkline Tristate 2 Container -->
                            <span class="js-sparkline" data-type="tristate" data-height="80px" data-bar-width="8" data-bar-spacing="6" data-pos-bar-color="#abe37d" data-neg-bar-color="#faad7d" data-points="[1,1,0,1,-1,-1,1,-1]"></span>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Sparkline Tristate 3 Container -->
                            <span class="js-sparkline" data-type="tristate" data-height="80px" data-bar-width="8" data-bar-spacing="6" data-pos-bar-color="#abe37d" data-neg-bar-color="#faad7d" data-points="[1,-1,0,-1,-1,0,0,1]"></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Tristate -->
        </div>
    </div>
    <!-- END Sparkline Charts -->

    <!-- Easy Pie Chart (.js-pie-chart class is initialized in Helpers.easyPieChart()) -->
    <!-- For more info and examples you can check out http://rendro.github.io/easy-pie-chart/ -->
    <!-- Randomize Values Buttons functionality is initialized in js/pages/be_comp_charts.min.js which was auto compiled from _es6/pages/be_comp_charts.js -->
    <h2 class="content-heading">Easy Pie Chart</h2>
    <div class="row">
        <div class="col-xl-6">
            <!-- Simple -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Simple</h3>
                    <div class="block-options">
                        <button type="button" class="js-pie-randomize btn-block-option" data-toggle="tooltip" title="Randomize">
                            <i class="fa fa-random"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row text-center invisible" data-toggle="appear">
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="80" data-line-width="3" data-size="100" data-bar-color="#abe37d" data-track-color="#eeeeee" data-scale-color="#dddddd">
                                <span>80<br><small class="text-muted">/100</small></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="45" data-line-width="3" data-size="100" data-bar-color="#fadb7d" data-track-color="#eeeeee" data-scale-color="#dddddd">
                                <span>45%</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="25" data-line-width="3" data-size="100" data-bar-color="#faad7d" data-track-color="#eeeeee" data-scale-color="#dddddd">
                                <span>25.00<br><small class="text-muted">/100mb</small></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="80" data-line-width="3" data-size="100" data-bar-color="#abe37d" data-track-color="#eeeeee">
                                <span>80<br><small class="text-muted">/100</small></span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="45" data-line-width="3" data-size="100" data-bar-color="#fadb7d" data-track-color="#eeeeee">
                                <span>45%</span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="25" data-line-width="3" data-size="100" data-bar-color="#faad7d" data-track-color="#eeeeee">
                                <span>25.00<br><small class="text-muted">/100mb</small></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Simple -->
        </div>
        <div class="col-xl-6">
            <!-- Avatar -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Avatar</h3>
                    <div class="block-options">
                        <button type="button" class="js-pie-randomize btn-block-option" data-toggle="tooltip" title="Randomize">
                            <i class="fa fa-random"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content block-content-full">
                    <div class="row text-center invisible" data-toggle="appear">
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="80" data-line-width="3" data-size="100" data-bar-color="#abe37d" data-track-color="#eeeeee" data-scale-color="#dddddd">
                                <span>
                                    <?php $one->get_avatar(); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="45" data-line-width="3" data-size="100" data-bar-color="#fadb7d" data-track-color="#eeeeee" data-scale-color="#dddddd">
                                <span>
                                    <?php $one->get_avatar(); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="25" data-line-width="3" data-size="100" data-bar-color="#faad7d" data-track-color="#eeeeee" data-scale-color="#dddddd">
                                <span>
                                    <?php $one->get_avatar(); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="80" data-line-width="3" data-size="100" data-bar-color="#abe37d" data-track-color="#eeeeee">
                                <span>
                                    <?php $one->get_avatar(); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="45" data-line-width="3" data-size="100" data-bar-color="#fadb7d" data-track-color="#eeeeee">
                                <span>
                                    <?php $one->get_avatar(); ?>
                                </span>
                            </div>
                        </div>
                        <div class="col-6 col-md-4 py-3">
                            <!-- Pie Chart Container -->
                            <div class="js-pie-chart pie-chart" data-percent="25" data-line-width="3" data-size="100" data-bar-color="#faad7d" data-track-color="#eeeeee">
                                <span>
                                    <?php $one->get_avatar(); ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Avatar -->
        </div>
    </div>
    <!-- END Easy Pie Chart -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/easy-pie-chart/jquery.easypiechart.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-sparkline/jquery.sparkline.min.js'); ?>
<?php $one->get_js('js/plugins/chart.js/Chart.bundle.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_comp_charts.min.js'); ?>

<!-- Page JS Helpers (Easy Pie Chart + jQuery Sparkline Plugins) -->
<script>jQuery(function(){ One.helpers(['easy-pie-chart', 'sparkline']); });</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
