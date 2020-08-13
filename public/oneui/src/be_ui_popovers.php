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
                Popovers <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Similar to the ones found in iOS.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Elements</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Popovers</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Bootstrap Popover (data-toggle="popover" and .js-popover class are initialized in Helpers.coreBootstrapPopover()) -->
    <!-- For advanced Popover usage you can check out https://getbootstrap.com/docs/4.3/components/popovers/ -->

    <!-- Default -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Default</h3>
        </div>
        <div class="block-content">
            <p class="font-size-sm text-muted">
                Show your popovers on hover
            </p>
            <div class="row items-push text-center">
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="popover" data-placement="top" title="Top Popover" data-content="This is example content. You can put a description or more info here.">Top</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="popover" data-placement="right" title="Right Popover" data-content="This is example content. You can put a description or more info here.">Right</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="popover" data-placement="bottom" title="Bottom Popover" data-content="This is example content. You can put a description or more info here.">Bottom</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-primary btn-block" data-toggle="popover" data-placement="left" title="Left Popover" data-content="This is example content. You can put a description or more info here.">Left</button>
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
                Show your popovers on click
            </p>
            <div class="row items-push text-center">
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-trigger="click" data-placement="top" title="Top Popover" data-content="This is example content. You can put a description or more info here.">Top</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-trigger="click" data-placement="right" title="Right Popover" data-content="This is example content. You can put a description or more info here.">Right</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-trigger="click" data-placement="bottom" title="Bottom Popover" data-content="This is example content. You can put a description or more info here.">Bottom</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-trigger="click" data-placement="left" title="Left Popover" data-content="This is example content. You can put a description or more info here.">Left</button>
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
                You can enable a fade animation to your popovers
            </p>
            <div class="row items-push text-center">
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-animation="true" data-placement="top" title="Top Popover" data-content="This is example content. You can put a description or more info here.">Top</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-animation="true" data-placement="right" title="Right Popover" data-content="This is example content. You can put a description or more info here.">Right</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-animation="true" data-placement="bottom" title="Bottom Popover" data-content="This is example content. You can put a description or more info here.">Bottom</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-animation="true" data-placement="left" title="Left Popover" data-content="This is example content. You can put a description or more info here.">Left</button>
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
                You can add HTML in your popovers as well
            </p>
            <div class="row items-push text-center">
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-html="true" data-placement="top" title="Popover Title" data-content="<div class='text-center'><img class='img-avatar' src='assets/media/avatars/avatar10.jpg' alt=''></div>">Top</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-html="true" data-placement="right" title="Popover Title" data-content="<div class='text-center'><img class='img-avatar' src='assets/media/avatars/avatar2.jpg' alt=''></div>">Right</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-html="true" data-placement="bottom" title="Popover Title" data-content="<div class='text-center'><img class='img-avatar' src='assets/media/avatars/avatar5.jpg' alt=''></div>">Bottom</button>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <button type="button" class="btn btn-sm btn-secondary btn-block" data-toggle="popover" data-html="true" data-placement="left" title="Popover Title" data-content="<div class='text-center'><img class='img-avatar' src='assets/media/avatars/avatar16.jpg' alt=''></div>">Left</button>
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
