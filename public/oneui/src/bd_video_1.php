<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend_boxed/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>
<?php include 'inc/backend_boxed/views/inc_navigation.php'; ?>

<!-- Page Content -->
<div class="content">
    <!-- Hero -->
    <!-- jQuery Vide for video backgrounds, for more examples you can check out https://github.com/VodkaBears/Vide -->
    <div class="block block-rounded overflow-hidden bg-video" data-vide-bg="<?php echo $one->assets_folder; ?>/media/videos/hero_sunrise" data-vide-options="posterType: jpg">
        <div class="block-content block-content-full bg-primary-op">
            <div class="py-5 text-center">
                <h1 class="text-white mb-2">
                    Dashboard
                </h1>
                <h2 class="h4 text-white-75 font-w400 text-muted mb-0">
                    Welcome to your app, everything looks great!
                </h2>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Dummy content -->
    <div class="row">
        <div class="col-sm-4">
            <div class="block block-rounded">
                <div class="block-content">
                    <p class="text-center py-6">...</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="block block-rounded">
                <div class="block-content">
                    <p class="text-center py-6">...</p>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="block block-rounded">
                <div class="block-content">
                    <p class="text-center py-6">...</p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="block block-rounded">
                <div class="block-content">
                    <p class="text-center py-6">...</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="block block-rounded">
                <div class="block-content">
                    <p class="text-center py-6">...</p>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="block block-rounded">
                <div class="block-content">
                    <p class="text-center py-6">...</p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="block block-rounded">
                <div class="block-content">
                    <p class="text-center py-6">...</p>
                </div>
            </div>
        </div>
    </div>
    <!-- END Dummy content -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/vide/jquery.vide.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
