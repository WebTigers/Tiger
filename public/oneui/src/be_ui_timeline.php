<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/magnific-popup/magnific-popup.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Timeline <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">UI component that just works and looks great.</small>
            </h1>
            <div class="flex-sm-00-auto ml-sm-3">
                <!-- Toggle Timeline Mode -->
                <button class="btn btn-sm btn-primary" data-toggle="class-toggle" data-target=".timeline" data-class="timeline-centered">
                    <i class="fa fa-arrows-alt-h mr-1"></i> Toggle Timeline Mode
                </button>
            </div>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Timeline -->
    <!--
        Available classes for timeline list:

        'timeline'                                      A normal timeline with icons to the left in all screens
        'timeline timeline-centered timeline-alt'       A centered timeline with odd events to the left and even events to the right (screen width > 1200px)
        'timeline timeline-centered'                    A centered timeline with all events to the left. You can add the class 'timeline-event-alt'
                                                        to 'timeline-event' elements to position them to the right (screen width > 1200px) (useful, if you
                                                        would like to have multiple events to the left or to the right section)
    -->
    <ul class="timeline timeline-alt">
        <!-- Photos Event -->
        <li class="timeline-event">
            <div class="timeline-event-icon bg-success">
                <i class="fa fa-images"></i>
            </div>
            <div class="timeline-event-block block invisible" data-toggle="appear">
                <div class="block-header block-header-default">
                    <h3 class="block-title">New Gallery</h3>
                    <div class="block-options">
                        <div class="timeline-event-time block-options-item font-size-sm font-w600">
                            just now
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row items-push js-gallery img-fluid-100">
                        <?php for ($i = 11; $i < 19; $i++) { ?>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <a class="img-link img-link-simple img-link-zoom-in img-lightbox" href="<?php echo $one->assets_folder; ?>/media/photos/photo<?php echo $i; ?>@2x.jpg">
                                <?php $one->get_photo($i, false, 'img-fluid'); ?>
                            </a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </li>
        <!-- END Photos Event -->

        <!-- Twitter Event -->
        <li class="timeline-event">
            <div class="timeline-event-icon bg-info">
                <i class="fab fa-twitter"></i>
            </div>
            <div class="timeline-event-block block invisible" data-toggle="appear">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Update</h3>
                    <div class="block-options">
                        <div class="timeline-event-time block-options-item font-size-sm font-w600">
                            10 min ago
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <div class="media font-size-sm">
                        <a class="img-link mr-2" href="javascript:void(0)">
                            <?php $one->get_avatar(0, 'female', 48, true); ?>
                        </a>
                        <div class="media-body">
                            <p>
                                <a class="font-w600" href="javascript:void(0)"><?php echo $one->get_name('female'); ?></a>
                                Vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam tincidunt sollicitudin sem nec ultrices. Sed at mi velit.
                            </p>
                            <p>
                                <a class="text-dark mr-2" href="javascript:void(0)">
                                    <i class="fa fa-reply fa-fw text-muted"></i> Reply
                                </a>
                                <a class="text-dark mr-2" href="javascript:void(0)">
                                    <i class="fa fa-redo fa-fw text-muted"></i> Retweet
                                </a>
                                <a class="text-dark mr-2" href="javascript:void(0)">
                                    <i class="fa fa-heart fa-fw text-muted"></i> Like
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <!-- END Twitter Event -->

        <!-- Facebook Event -->
        <li class="timeline-event">
            <div class="timeline-event-icon bg-default">
                <i class="fab fa-facebook-f"></i>
            </div>
            <div class="timeline-event-block block invisible" data-toggle="appear">
                <div class="block-header block-header-default">
                    <h3 class="block-title">New Friends</h3>
                    <div class="block-options">
                        <div class="timeline-event-time block-options-item font-size-sm font-w600">
                            42 min ago
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row">
                        <div class="col-md-6">
                            <ul class="nav-items push">
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-left">
                                            <?php $one->get_avatar(0, 'female', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('female'); ?></div>
                                            <div class="font-size-sm text-muted">3 min ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-left">
                                            <?php $one->get_avatar(0, 'male', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('male'); ?></div>
                                            <div class="font-w400 font-size-sm text-muted">5 min ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-left">
                                            <?php $one->get_avatar(0, 'female', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-danger"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('female'); ?></div>
                                            <div class="font-w400 font-size-sm text-muted">16 min ago</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul class="nav-items push">
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-left">
                                            <?php $one->get_avatar(0, 'female', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('female'); ?></div>
                                            <div class="font-size-sm text-muted">23 min ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-left">
                                            <?php $one->get_avatar(0, 'male', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-success"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('male'); ?></div>
                                            <div class="font-w400 font-size-sm text-muted">23 min ago</div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a class="media py-2" href="javascript:void(0)">
                                        <div class="mr-3 ml-2 overlay-container overlay-left">
                                            <?php $one->get_avatar(0, 'female', 48); ?>
                                            <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-danger"></span>
                                        </div>
                                        <div class="media-body">
                                            <div class="font-w600"><?php $one->get_name('female'); ?></div>
                                            <div class="font-w400 font-size-sm text-muted">35 min ago</div>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <!-- END Facebook Event -->

        <!-- Photos Event -->
        <li class="timeline-event">
            <div class="timeline-event-icon bg-danger">
                <i class="fa fa-calendar"></i>
            </div>
            <div class="timeline-event-block block invisible" data-toggle="appear">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Meeting</h3>
                    <div class="block-options">
                        <div class="timeline-event-time block-options-item font-size-sm font-w600">
                            3 hrs ago
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <div class="media font-size-sm push">
                        <a class="img-link mr-2" href="javascript:void(0)">
                            <i class="fa fa-utensils fa-fw fa-3x text-danger-light"></i>
                        </a>
                        <div class="media-body">
                            <p>
                                You have a meal meeting scheduled with <a class="font-w600" href="javascript:void(0)"><?php echo $one->get_name('male'); ?></a> today at 16:18.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <!-- END Photos Event -->

        <!-- System Event -->
        <li class="timeline-event">
            <div class="timeline-event-icon bg-dark">
                <i class="fa fa-cogs"></i>
            </div>
            <div class="timeline-event-block block invisible" data-toggle="appear">
                <div class="block-header block-header-default">
                    <h3 class="block-title">System</h3>
                    <div class="block-options">
                        <div class="timeline-event-time block-options-item font-size-sm font-w600">
                            1 day ago
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <div class="alert alert-success d-flex align-items-center justify-content-between" role="alert">
                        <div class="flex-fill mr-3">
                            <p class="mb-0">OneUI successfully <a class="alert-link" href="javascript:void(0)">updated</a> to v<?php echo $one->version; ?>!</p>
                        </div>
                        <div class="flex-00-auto">
                            <i class="fa fa-fw fa-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </li>
        <!-- END System Event -->

        <!-- Article -->
        <li class="timeline-event">
            <div class="timeline-event-icon bg-smooth">
                <i class="far fa-file-alt"></i>
            </div>
            <div class="timeline-event-block block invisible" data-toggle="appear">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Article</h3>
                    <div class="block-options">
                        <div class="timeline-event-time block-options-item font-size-sm font-w600">
                            2 days ago
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('small', 2); ?>
                    <a class="btn btn-sm btn-light push" href="javascript:void(0)">Read More..</a>
                </div>
            </div>
        </li>
        <!-- END Article -->
    </ul>
    <!-- END Timeline -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/magnific-popup/jquery.magnific-popup.min.js'); ?>

<!-- Page JS Helpers (Magnific Popup Plugin) -->
<script>jQuery(function(){ One.helpers('magnific-popup'); });</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
