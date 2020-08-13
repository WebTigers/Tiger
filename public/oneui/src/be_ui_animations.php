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
                Animations <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Rich animation library will bring your elements to life and engage your users.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Elements</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Animations</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Animation preview functionality is initialized in js/pages/be_ui_animations.min.js which was auto compiled from _es6/pages/be_ui_animations.js -->
    <!-- Attention Seekers -->
    <h2 class="content-heading">Attention Seekers</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounce">bounce</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="flash">flash</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="pulse">pulse</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rubberBand">rubberBand</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="shake">shake</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="swing">swing</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="tada">tada</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="wobble">wobble</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Attention Seekers -->

    <!-- Bouncing Entrances -->
    <h2 class="content-heading">Bouncing Entrances</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounceIn">bounceIn</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounceInDown">bounceInDown</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounceInLeft">bounceInLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounceInRight">bounceInRight</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounceInUp">bounceInUp</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Bouncing Entrances -->

    <!-- Bouncing Exits -->
    <h2 class="content-heading">Bouncing Exits</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounceOut">bounceOut</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounceOutDown">bounceOutDown</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounceOutLeft">bounceOutLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounceOutRight">bounceOutRight</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="bounceOutUp">bounceOutUp</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Bouncing Exits -->

    <!-- Fading Entrances -->
    <h2 class="content-heading">Fading Entrances</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeIn">fadeIn</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeInDown">fadeInDown</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeInDownBig">fadeInDownBig</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeInLeft">fadeInLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeInLeftBig">fadeInLeftBig</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeInRight">fadeInRight</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeInRightBig">fadeInRightBig</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeInUp">fadeInUp</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeInUpBig">fadeInUpBig</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Fading Entrances -->

    <!-- Fading Exits -->
    <h2 class="content-heading">Fading Exits</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeOut">fadeOut</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeOutDown">fadeOutDown</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeOutDownBig">fadeOutDownBig</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeOutLeft">fadeOutLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeOutLeftBig">fadeOutLeftBig</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeOutRight">fadeOutRight</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeOutRightBig">fadeOutRightBig</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeOutUp">fadeOutUp</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="fadeOutUpBig">fadeOutUpBig</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Fading Exits -->

    <!-- Flippers -->
    <h2 class="content-heading">Flippers</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="flip">flip</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="flipInX">flipInX</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="flipInY">flipInY</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="flipOutX">flipOutX</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="flipOutY">flipOutY</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Flippers -->

    <!-- Lightspeed -->
    <h2 class="content-heading">Lightspeed</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="lightSpeedIn">lightSpeedIn</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="lightSpeedOut">lightSpeedOut</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Lightspeed -->

    <!-- Rotating Entrances -->
    <h2 class="content-heading">Rotating Entrances</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rotateIn">rotateIn</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rotateInDownLeft">rotateInDownLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rotateInDownRight">rotateInDownRight</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rotateInUpLeft">rotateInUpLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rotateInUpRight">rotateInUpRight</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Rotating Entrances -->

    <!-- Rotating Exits -->
    <h2 class="content-heading">Rotating Exits</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rotateOut">rotateOut</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rotateOutDownLeft">rotateOutDownLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rotateOutDownRight">rotateOutDownRight</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rotateOutUpLeft">rotateOutUpLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rotateOutUpRight">rotateOutUpRight</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Rotating Exits -->

    <!-- Sliding Entrances -->
    <h2 class="content-heading">Sliding Entrances</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="slideInUp">slideInUp</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="slideInDown">slideInDown</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="slideInLeft">slideInLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="slideInRight">slideInRight</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Sliding Entrances -->

    <!-- Sliding Exits -->
    <h2 class="content-heading">Sliding Exits</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="slideOutUp">slideOutUp</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="slideOutDown">slideOutDown</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="slideOutLeft">slideOutLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="slideOutRight">slideOutRight</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Sliding Exits -->

    <!-- Zoom Entrances -->
    <h2 class="content-heading">Zoom Entrances</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="zoomIn">zoomIn</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="zoomInDown">zoomInDown</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="zoomInLeft">zoomInLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="zoomInRight">zoomInRight</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="zoomInUp">zoomInUp</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Zoom Entrances -->

    <!-- Zoom Exits -->
    <h2 class="content-heading">Zoom Exits</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="zoomOut">zoomOut</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="zoomOutDown">zoomOutDown</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="zoomOutLeft">zoomOutLeft</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="zoomOutRight">zoomOutRight</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="zoomOutUp">zoomOutUp</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Zoom Exits -->

    <!-- Specials -->
    <h2 class="content-heading">Specials</h2>
    <div class="block js-animation-section">
        <div class="block-header">
            <h2 class="block-title">Active CSS classes: <code>animated <span class="js-animation-preview"></span></code></h2>
        </div>
        <div class="block-content overflow-hidden">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row items-push">
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="hinge">hinge</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rollIn">rollIn</button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-block btn-light" data-animation-class="rollOut">rollOut</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 d-lg-flex align-items-lg-center justify-content-lg-center text-center pb-4">
                    <div class="js-animation-object">
                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/little-monster.png" alt="Cartoon" width="200">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Specials -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_ui_animations.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
