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
                Tooltips <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Attach optional info to an element.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Elements</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Tooltips</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Tooltip (data-toggle="tooltip" and .js-tooltip class are initialized in Helpers.coreBootstrapTooltip()) -->
    <!-- For advanced Tooltip usage you can check out https://getbootstrap.com/docs/4.3/components/tooltips/ -->

    <!-- Default -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Default</h3>
        </div>
        <div class="block-content">
            <p class="font-size-sm text-muted">
                Show tooltips on hover
            </p>
            <div class="row items-push text-center">
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="tooltip" data-placement="top" title="Top Tooltip">Top</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="tooltip" data-placement="right" title="Right Tooltip">Right</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="tooltip" data-placement="bottom" title="Bottom Tooltip">Bottom</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="tooltip" data-placement="left" title="Left Tooltip">Left</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Default -->

    <!-- Click Triggered -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Click Triggered</h3>
        </div>
        <div class="block-content">
            <p class="font-size-sm text-muted">
                Show your tooltips on click
            </p>
            <div class="row items-push text-center">
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-trigger="click" data-placement="top" title="Top Tooltip">Top</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-trigger="click" data-placement="right" title="Right Tooltip">Right</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-trigger="click" data-placement="bottom" title="Bottom Tooltip">Bottom</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-trigger="click" data-placement="left" title="Left Tooltip">Left</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Click Triggered -->

    <!-- Animation -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Animation</h3>
        </div>
        <div class="block-content">
            <p class="font-size-sm text-muted">
                Show tooltips on hover
            </p>
            <div class="row items-push text-center">
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-animation="true" data-placement="top" title="Top Tooltip">Top</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-animation="true" data-placement="right" title="Right Tooltip">Right</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-animation="true" data-placement="bottom" title="Bottom Tooltip">Bottom</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-animation="true" data-placement="left" title="Left Tooltip">Left</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Animation -->

    <!-- HTML -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">HTML</h3>
        </div>
        <div class="block-content">
            <p class="font-size-sm text-muted">
                You can add HTML in your tooltips as well
            </p>
            <div class="row items-push text-center">
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-html="true" data-placement="top" title="<img class='img-avatar' src='assets/media/avatars/avatar10.jpg' alt=''>">Top</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-html="true" data-placement="right" title="<img class='img-avatar' src='assets/media/avatars/avatar2.jpg' alt=''>">Right</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-html="true" data-placement="bottom" title="<img class='img-avatar' src='assets/media/avatars/avatar5.jpg' alt=''>">Bottom</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="tooltip" data-html="true" data-placement="left" title="<img class='img-avatar' src='assets/media/avatars/avatar16.jpg' alt=''>">Left</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END HTML -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
