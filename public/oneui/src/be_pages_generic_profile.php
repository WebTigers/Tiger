<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo8@2x.jpg');">
    <div class="bg-black-50">
        <div class="content content-full text-center">
            <div class="my-3">
                <?php $one->get_avatar(13, '', false, true); ?>
            </div>
            <h1 class="h2 text-white mb-0">John Parker</h1>
            <span class="text-white-75">UI Designer</span>
       </div>
    </div>
</div>
<!-- END Hero -->

<!-- Stats -->
<div class="bg-white border-bottom">
    <div class="content content-boxed">
        <div class="row items-push text-center">
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase">Sales</div>
                <a class="link-fx font-size-h3" href="javascript:void(0)">17980</a>
            </div>
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase">Products</div>
                <a class="link-fx font-size-h3" href="javascript:void(0)">27</a>
            </div>
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase">Followers</div>
                <a class="link-fx font-size-h3" href="javascript:void(0)">1360</a>
            </div>
            <div class="col-6 col-md-3">
                <div class="font-size-sm font-w600 text-muted text-uppercase mb-2">739 Ratings</div>
                <span class="text-warning">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star-half"></i>
                </span>
                <span class="font-size-sm text-muted">(4.9)</span>
            </div>
        </div>
    </div>
</div>
<!-- END Stats -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <div class="col-md-7 col-xl-8">
            <!-- Updates -->
            <ul class="timeline timeline-alt py-0">
                <li class="timeline-event">
                    <div class="timeline-event-icon bg-default">
                        <i class="fab fa-facebook-f"></i>
                    </div>
                    <div class="timeline-event-block block invisible" data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title">Facebook</h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">
                                    just now
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <p class="font-w600 mb-2">
                                + 290 Page Likes
                            </p>
                            <p>
                                This is great, keep it up!
                            </p>
                        </div>
                    </div>
                </li>
                <li class="timeline-event">
                    <div class="timeline-event-icon bg-modern">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="timeline-event-block block invisible" data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title">Products</h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">
                                    4 hrs ago
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <p class="font-w600 mb-2">
                                3 New Products were added!
                            </p>
                            <div class="d-flex">
                                <a class="item item-rounded bg-info mr-2" href="javascript:void(0)">
                                    <i class="si si-rocket fa-2x text-white-75"></i>
                                </a>
                                <a class="item item-rounded bg-amethyst mr-2" href="javascript:void(0)">
                                    <i class="si si-calendar fa-2x text-white-75"></i>
                                </a>
                                <a class="item item-rounded bg-city mr-2" href="javascript:void(0)">
                                    <i class="si si-speedometer fa-2x text-white-75"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="timeline-event">
                    <div class="timeline-event-icon bg-info">
                        <i class="fab fa-twitter"></i>
                    </div>
                    <div class="timeline-event-block block invisible" data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title">Twitter</h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">
                                    12 hrs ago
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <p class="font-w600 mb-2">
                                + 1150 Followers
                            </p>
                            <p>
                                You’re getting more and more followers, keep it up!
                            </p>
                        </div>
                    </div>
                </li>
                <li class="timeline-event">
                    <div class="timeline-event-icon bg-smooth">
                        <i class="fa fa-database"></i>
                    </div>
                    <div class="timeline-event-block block invisible" data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title">Backup</h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">
                                    1 day ago
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <p class="font-w600 mb-2">
                                Database backup completed!
                            </p>
                            <p>
                                Download the <a href="javascript:void(0)">latest backup</a>.
                            </p>
                        </div>
                    </div>
                </li>
                <li class="timeline-event">
                    <div class="timeline-event-icon bg-dark">
                        <i class="fa fa-cog"></i>
                    </div>
                    <div class="timeline-event-block block invisible" data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title">System</h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">
                                    1 week ago
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <p class="font-w600 mb-2">
                                App updated to v2.02
                            </p>
                            <p>
                                Check the complete changelog at the <a href="javascript:void(0)">activity page</a>.
                            </p>
                        </div>
                    </div>
                </li>
                <li class="timeline-event">
                    <div class="timeline-event-icon bg-modern">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <div class="timeline-event-block block invisible" data-toggle="appear">
                        <div class="block-header">
                            <h3 class="block-title">Products</h3>
                            <div class="block-options">
                                <div class="timeline-event-time block-options-item font-size-sm">
                                    2 months ago
                                </div>
                            </div>
                        </div>
                        <div class="block-content block-content-full">
                            <p class="font-w600 mb-2">
                                1 New Product was added!
                            </p>
                            <a class="item item-rounded bg-muted" href="javascript:void(0)">
                                <i class="si si-wallet fa-2x text-white-75"></i>
                            </a>
                        </div>
                    </div>
                </li>
            </ul>
            <!-- END Updates -->
        </div>
        <div class="col-md-5 col-xl-4">
            <!-- Products -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-briefcase text-muted mr-1"></i> Products
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="media d-flex align-items-center push">
                        <div class="mr-3">
                            <a class="item item-rounded bg-info" href="javascript:void(0)">
                                <i class="si si-rocket fa-2x text-white-75"></i>
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="font-w600">MyPanel</div>
                            <div class="font-size-sm">Responsive App Template</div>
                        </div>
                    </div>
                    <div class="media d-flex align-items-center push">
                        <div class="mr-3">
                            <a class="item item-rounded bg-amethyst" href="javascript:void(0)">
                                <i class="si si-calendar fa-2x text-white-75"></i>
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="font-w600">Project Time</div>
                            <div class="font-size-sm">Web Application</div>
                        </div>
                    </div>
                    <div class="media d-flex align-items-center push">
                        <div class="mr-3">
                            <a class="item item-rounded bg-city" href="javascript:void(0)">
                                <i class="si si-speedometer fa-2x text-white-75"></i>
                            </a>
                        </div>
                        <div class="media-body">
                            <div class="font-w600">iDashboard</div>
                            <div class="font-size-sm">Bootstrap Admin Template</div>
                        </div>
                    </div>
                    <div class="text-center push">
                        <button type="button" class="btn btn-sm btn-light">View More..</button>
                    </div>
                </div>
            </div>
            <!-- END Products -->

            <!-- Ratings -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-pencil-alt text-muted mr-1"></i> Ratings
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="font-size-sm push">
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <a class="font-w600" href=""><?php $one->get_name(); ?></a>
                                <span class="text-muted">(5/5)</span>
                            </div>
                            <div class="text-warning">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="mb-0">Flawless design execution! I'm really impressed with the product, it really helped me build my app so fast! Thank you!</p>
                    </div>
                    <div class="font-size-sm push">
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <a class="font-w600" href=""><?php $one->get_name(); ?></a>
                                <span class="text-muted">(5/5)</span>
                            </div>
                            <div class="text-warning">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="mb-0">Great value for money and awesome support! Would buy again and again! Thanks!</p>
                    </div>
                    <div class="font-size-sm push">
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <a class="font-w600" href=""><?php $one->get_name(); ?></a>
                                <span class="text-muted">(5/5)</span>
                            </div>
                            <div class="text-warning">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </div>
                        </div>
                        <p class="mb-0">Working great in all my devices, quality and quantity in a great package! Thank you!</p>
                    </div>
                    <div class="text-center push">
                        <button type="button" class="btn btn-sm btn-light">Read More..</button>
                    </div>
                </div>
            </div>
            <!-- END Ratings -->

            <!-- Followers -->
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-share-alt text-muted mr-1"></i> Followers
                    </h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                            <i class="si si-refresh"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <ul class="nav-items font-size-sm">
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
                                    <span class="overlay-item item item-tiny item-circle border border-2x border-white bg-warning"></span>
                                </div>
                                <div class="media-body">
                                    <div class="font-w600"><?php $one->get_name('female'); ?></div>
                                    <div class="font-w400 text-muted">Web Designer</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                    <div class="text-center push">
                        <button type="button" class="btn btn-sm btn-light">Load More..</button>
                    </div>
                </div>
            </div>
            <!-- END Followers -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
