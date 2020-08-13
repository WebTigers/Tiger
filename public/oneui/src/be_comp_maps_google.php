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
                Google Maps <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Seamlessly Google Maps integration that will enhance your web application.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Components</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Google Maps</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<!-- Maps and Search functionality is initialized in js/pages/be_comp_maps_google.min.js which was auto compiled from _es6/pages/be_comp_maps_google.js -->
<!-- For more info and examples you can check out https://hpneo.github.io/gmaps/ -->
<div class="content">
    <!-- Search Map -->
    <div class="block">
        <div class="block-content">
            <!-- Search Form -->
            <form class="js-form-search push">
                <div class="input-group">
                    <input type="text" class="js-search-address form-control form-control-lg form-control-alt" placeholder="Search.. (eg: Paris)">
                    <div class="input-group-append">
                        <span class="input-group-text border-0 bg-body">
                            <i class="fa fa-fw fa-search"></i>
                        </span>
                    </div>
                </div>
            </form>
            <!-- END Search Form -->
        </div>
        <!-- Search Map Container -->
        <div id="js-map-search" style="height: 600px;"></div>
    </div>
    <!-- END Search Map -->

    <!-- Satellite Map -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Satellite Map</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option">
                    <i class="si si-settings"></i>
                </button>
            </div>
        </div>
        <!-- Satellite Map Container -->
        <div id="js-map-sat" style="height: 600px;"></div>
    </div>
    <!-- END Satellite Map -->

    <!-- Terrain Map -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Terrain Map</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option">
                    <i class="si si-settings"></i>
                </button>
            </div>
        </div>
        <!-- Terrain Map Container -->
        <div id="js-map-ter" style="height: 600px;"></div>
    </div>
    <!-- END Terrain Map -->

    <!-- Overlay Map -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Overlay Map</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option">
                    <i class="si si-settings"></i>
                </button>
            </div>
        </div>
        <!-- Overlay Map Container -->
        <div id="js-map-overlay" style="height: 600px;"></div>
    </div>
    <!-- END Overlay Map -->

    <!-- Map Markers Map -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Map Markers Map</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option">
                    <i class="si si-settings"></i>
                </button>
            </div>
        </div>
        <!-- Markers Map Container -->
        <div id="js-map-markers" style="height: 600px;"></div>
    </div>
    <!-- END Map Markers Map -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<!-- Google Maps API Key (you will have to obtain a Google Maps API key to use Google Maps) -->
<!-- For more info please have a look at https://developers.google.com/maps/documentation/javascript/get-api-key#key -->
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $one->google_maps_api_key; ?>"></script>
<?php $one->get_js('js/plugins/gmaps/gmaps.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_comp_maps_google.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
