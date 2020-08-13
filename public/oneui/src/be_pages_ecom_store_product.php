<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php
// Page specific configuration
$one->l_m_content = 'boxed';
?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/magnific-popup/magnific-popup.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/various/ecom_product6.png');">
    <div class="bg-primary-dark-op">
        <div class="content content-full text-center py-6">
            <h1 class="h2 text-white mb-2">Super Badges Pack</h1>
            <h2 class="h4 font-w400 text-white-75 mb-0">1000s of high quality badges.</h2>
       </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Toggle Side Content -->
    <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
    <div class="d-xl-none push">
        <div class="row gutters-tiny">
            <div class="col-6">
                <button type="button" class="btn btn-light btn-block" data-toggle="class-toggle" data-target=".js-ecom-div-nav" data-class="d-none">
                    <i class="fa fa-fw fa-bars text-muted mr-1"></i> Navigation
                </button>
            </div>
            <div class="col-6">
                <button type="button" class="btn btn-light btn-block" data-toggle="class-toggle" data-target=".js-ecom-div-cart" data-class="d-none">
                    <i class="fa fa-fw fa-shopping-cart text-muted mr-1"></i> Cart (3)
                </button>
            </div>
        </div>
    </div>
    <!-- END Toggle Side Content -->

    <div class="row">
        <div class="col-xl-4 order-xl-1">
            <!-- Categories -->
            <div class="block js-ecom-div-nav d-none d-xl-block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-fw fa-boxes text-muted mr-1"></i> Categories
                    </h3>
                </div>
                <div class="block-content">
                    <ul class="nav nav-pills flex-column push">
                        <li class="nav-item mb-1">
                            <a class="nav-link active d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Icons <span class="badge badge-pill badge-secondary ml-1">7k</span>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Apps <span class="badge badge-pill badge-secondary ml-1">2k</span>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Games <span class="badge badge-pill badge-secondary ml-1">3k</span>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Graphics <span class="badge badge-pill badge-secondary ml-1">18k</span>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Services <span class="badge badge-pill badge-secondary ml-1">2k</span>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                UI Kits <span class="badge badge-pill badge-secondary ml-1">12k</span>
                            </a>
                        </li>
                        <li class="nav-item mb-1">
                            <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
                                Themes <span class="badge badge-pill badge-secondary ml-1">6k</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- END Categories -->

            <!-- Shopping Cart -->
            <div class="block js-ecom-div-cart d-none d-xl-block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="fa fa-fw fa-shopping-cart text-muted mr-1"></i> Shopping Cart (3)
                    </h3>
                </div>
                <div class="block-content">
                    <table class="table table-borderless table-hover table-vcenter">
                        <tbody>
                            <tr>
                                <td class="text-center">
                                    <a class="text-danger" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                                </td>
                                <td style="width: 60px;">
                                    <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product1.png" alt="">
                                </td>
                                <td>
                                    <a class="h5" href="be_pages_ecom_store_product.php">Iconic</a>
                                    <div class="font-size-sm text-muted">Beautifully crafted icon set</div>
                                </td>
                                <td class="text-right">
                                    <div class="font-w600 text-success">$9</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <a class="text-danger" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                                </td>
                                <td style="width: 60px;">
                                    <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product2.png" alt="">
                                </td>
                                <td>
                                    <a class="h5" href="be_pages_ecom_store_product.php">Mailday</a>
                                    <div class="font-size-sm text-muted">Pro email templates</div>
                                </td>
                                <td class="text-right">
                                    <div class="font-w600 text-success">$16</div>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <a class="text-danger" href="javascript:void(0)"><i class="fa fa-times"></i></a>
                                </td>
                                <td style="width: 60px;">
                                    <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product3.png" alt="">
                                </td>
                                <td>
                                    <a class="h5" href="be_pages_ecom_store_product.php">Office Suite</a>
                                    <div class="font-size-sm text-muted">The best productivity apps</div>
                                </td>
                                <td class="text-right">
                                    <div class="font-w600 text-success">$75</div>
                                </td>
                            </tr>
                            <tr class="bg-success-light">
                                <td class="text-right" colspan="3">
                                    <span class="h4 font-w600">Total</span>
                                </td>
                                <td class="text-right">
                                    <span class="h4 font-w600 text-success">$100</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="block-content block-content-full bg-body-light text-right">
                    <a class="btn btn-sm btn-primary" href="be_pages_ecom_store_checkout.php">
                        <i class="fa fa-check mr-1"></i> Complete Checkout
                    </a>
                </div>
            </div>
            <!-- END Shopping Cart -->
        </div>
        <div class="col-xl-8 order-xl-0">
            <!-- Product -->
            <div class="block">
                <div class="block-content">
                    <!-- Vitals -->
                    <div class="row items-push">
                        <div class="col-md-6">
                            <!-- Images -->
                            <!-- Magnific Popup (.js-gallery class is initialized in Helpers.magnific()) -->
                            <!-- For more info and examples you can check out http://dimsemenov.com/plugins/magnific-popup/ -->
                            <div class="row gutters-tiny js-gallery img-fluid-100">
                                <div class="col-12 mb-3">
                                    <a class="img-link img-link-zoom-in img-lightbox" href="<?php echo $one->assets_folder; ?>/media/various/ecom_product6.png">
                                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product6.png" alt="">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a class="img-link img-link-zoom-in img-lightbox" href="<?php echo $one->assets_folder; ?>/media/various/ecom_product6_a.png">
                                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product6_a.png" alt="">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a class="img-link img-link-zoom-in img-lightbox" href="<?php echo $one->assets_folder; ?>/media/various/ecom_product6_b.png">
                                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product6_b.png" alt="">
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a class="img-link img-link-zoom-in img-lightbox" href="<?php echo $one->assets_folder; ?>/media/various/ecom_product6_c.png">
                                        <img class="img-fluid" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product6_c.png" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- END Images -->
                        </div>
                        <div class="col-md-6">
                            <!-- Info -->
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="font-size-sm font-w600 text-success">IN STOCK</div>
                                    <div class="font-size-sm text-muted">200 Available</div>
                                </div>
                                <div class="font-size-h2 font-w700">
                                    $58
                                </div>
                            </div>
                            <form class="d-flex justify-content-between my-3 border-top border-bottom" action="be_pages_ecom_store_product.php" method="post" onsubmit="return false;">
                                <div class="py-3">
                                    <select class="form-control form-control-sm" id="ecom-license" name="ecom-license" size="1">
                                        <option value="0" disabled selected>LICENSE</option>
                                        <option value="simple">Simple</option>
                                        <option value="multiple">Multiple</option>
                                    </select>
                                </div>
                                <div class="py-3">
                                    <button type="submit" class="btn btn-sm btn-light">
                                        <i class="fa fa-plus text-success mr-1"></i> Add to Cart
                                    </button>
                                </div>
                            </form>
                            <?php echo $one->get_text('small'); ?>
                            <!-- END Info -->
                        </div>
                    </div>
                    <!-- END Vitals -->

                    <!-- Author -->
                    <div class="block block-rounded block-bordered">
                        <div class="block-content block-content-full d-flex justify-content-between align-items-center">
                            <div>
                                <div class="mb-2">
                                    By <a class="font-w600" href="javascript:void(0)">Emma Cooper</a>
                                </div>
                                <div>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-fw fa-plus text-success"></i>
                                    </a>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-fw fa-envelope text-muted"></i>
                                    </a>
                                </div>
                            </div>
                            <?php $one->get_avatar(2); ?>
                        </div>
                    </div>
                    <!-- END Author -->

                    <!-- Extra Info Tabs -->
                    <!-- Bootstrap Tabs (data-toggle="tabs" is initialized in Helpers.coreBootstrapTabs()) -->
                    <div class="block">
                        <ul class="nav nav-tabs nav-tabs-alt align-items-center" data-toggle="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#ecom-product-info">Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#ecom-product-comments">Comments</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#ecom-product-reviews">Reviews</a>
                            </li>
                        </ul>
                        <div class="block-content tab-content">
                            <!-- Info -->
                            <div class="tab-pane pull-x active" id="ecom-product-info" role="tabpanel">
                                <table class="table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th colspan="2">File Formats</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%;">Sketch</td>
                                            <td>
                                                <i class="fa fa-check text-success"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PSD</td>
                                            <td>
                                                <i class="fa fa-check text-success"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>PDF</td>
                                            <td>
                                                <i class="fa fa-times text-danger"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>AI</td>
                                            <td>
                                                <i class="fa fa-check text-success"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>EPS</td>
                                            <td>
                                                <i class="fa fa-check text-success"></i>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-borderless">
                                    <thead>
                                        <tr>
                                            <th colspan="2">Extra</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%;">
                                                <i class="fa fa-fw fa-calendar text-muted mr-1"></i> Date
                                            </td>
                                            <td>January 15, 2019</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fa fa-fw fa-anchor text-muted mr-1"></i> File Size
                                            </td>
                                            <td>265.36 MB</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fa fa-fw fa-vector-square text-muted mr-1"></i> Vector
                                            </td>
                                            <td>
                                                <i class="fa fa-fw fa-check text-success"></i>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <i class="fa fa-fw fa-expand text-muted mr-1"></i> Dimensions
                                            </td>
                                            <td>
                                                <div class="mb-2">16 x 16 px</div>
                                                <div class="mb-2">32 x 32 px</div>
                                                <div class="mb-2">64 x 64 px</div>
                                                <div class="mb-2">128 x 128 px</div>
                                                <div>256 x 256 px</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- END Info -->

                            <!-- Comments -->
                            <div class="tab-pane pull-x font-size-sm" id="ecom-product-comments" role="tabpanel">
                                <div class="media push">
                                    <a class="mr-3" href="javascript:void(0)">
                                        <?php echo $one->get_avatar(3, '', 32); ?>
                                    </a>
                                    <div class="media-body">
                                        <a class="font-w600" href="javascript:void(0)"><?php echo $one->get_name('female'); ?></a>
                                        <mark class="font-w600 text-danger">Purchased</mark>
                                        <p class="my-1">High quality, thanks so much for sharing!</p>
                                        <a class="mr-1" href="javascript:void(0)">Like</a>
                                        <a class="mr-1" href="javascript:void(0)">Reply</a>
                                        <span class="text-muted"><em>12 min ago</em></span>
                                        <div class="media mt-3">
                                            <a class="mr-3" href="javascript:void(0)">
                                                <?php echo $one->get_avatar(2, '', 32); ?>
                                            </a>
                                            <div class="media-body">
                                                <a class="font-w600" href="javascript:void(0)">Emma Cooper</a>
                                                <mark class="font-w600 text-success">Author</mark>
                                                <p class="my-1">Thanks so much!!</p>
                                                <a class="mr-1" href="javascript:void(0)">Like</a>
                                                <a class="mr-1" href="javascript:void(0)">Reply</a>
                                                <span class="text-muted"><em>20 min ago</em></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="media push">
                                    <a class="mr-3" href="javascript:void(0)">
                                        <?php echo $one->get_avatar(12, '', 32); ?>
                                    </a>
                                    <div class="media-body">
                                        <a class="font-w600" href="javascript:void(0)"><?php echo $one->get_name('male'); ?></a>
                                        <mark class="font-w600 text-danger">Purchased</mark>
                                        <p class="my-1">Great work, thank you!</p>
                                        <a class="mr-1" href="javascript:void(0)">Like</a>
                                        <a class="mr-1" href="javascript:void(0)">Reply</a>
                                        <span class="text-muted"><em>30 min ago</em></span>
                                        <div class="media mt-3">
                                            <a class="mr-3" href="javascript:void(0)">
                                                <?php echo $one->get_avatar(2, '', 32); ?>
                                            </a>
                                            <div class="media-body">
                                                <a class="font-w600" href="javascript:void(0)">Emma Cooper</a>
                                                <mark class="font-w600 text-success">Author</mark>
                                                <p class="my-1">Thanks so much!!</p>
                                                <a class="mr-1" href="javascript:void(0)">Like</a>
                                                <a class="mr-1" href="javascript:void(0)">Reply</a>
                                                <span class="text-muted"><em>20 min ago</em></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="media push">
                                    <a class="mr-3" href="javascript:void(0)">
                                        <?php echo $one->get_avatar(14, '', 32); ?>
                                    </a>
                                    <div class="media-body">
                                        <a class="font-w600" href="javascript:void(0)"><?php echo $one->get_name('male'); ?></a>
                                        <p class="my-1">Really nice!</p>
                                        <a class="mr-1" href="javascript:void(0)">Like</a>
                                        <a class="mr-1" href="javascript:void(0)">Reply</a>
                                        <span class="text-muted"><em>42 min ago</em></span>
                                        <div class="media mt-3">
                                            <a class="mr-3" href="javascript:void(0)">
                                                <?php echo $one->get_avatar(2, '', 32); ?>
                                            </a>
                                            <div class="media-body">
                                                <a class="font-w600" href="javascript:void(0)">Emma Cooper</a>
                                                <mark class="font-w600 text-success">Author</mark>
                                                <p class="my-1">Thanks so much!!</p>
                                                <a class="mr-1" href="javascript:void(0)">Like</a>
                                                <a class="mr-1" href="javascript:void(0)">Reply</a>
                                                <span class="text-muted"><em>20 min ago</em></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <form action="be_pages_ecom_store_product.php" method="POST" onsubmit="return false;">
                                    <input type="text" class="form-control form-control-alt" placeholder="Write a comment..">
                                </form>
                            </div>
                            <!-- END Comments -->

                            <!-- Reviews -->
                            <div class="tab-pane pull-x font-size-sm" id="ecom-product-reviews" role="tabpanel">
                                <!-- Average Rating -->
                                <div class="block block-rounded bg-body-light">
                                    <div class="block-content text-center">
                                        <p class="text-warning mb-2">
                                            <i class="fa fa-star fa-2x"></i>
                                            <i class="fa fa-star fa-2x"></i>
                                            <i class="fa fa-star fa-2x"></i>
                                            <i class="fa fa-star fa-2x"></i>
                                            <i class="fa fa-star fa-2x"></i>
                                        </p>
                                        <p>
                                            <strong>5.0</strong>/5.0 out of <strong>5</strong> Ratings
                                        </p>
                                    </div>
                                </div>
                                <!-- END Average Rating -->

                                <!-- Ratings -->
                                <div class="media push">
                                    <a class="mr-3" href="javascript:void(0)">
                                        <?php echo $one->get_avatar(0, 'male', 32); ?>
                                    </a>
                                    <div class="media-body">
                                        <span class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <a class="font-w600" href="javascript:void(0)"><?php echo $one->get_name('male'); ?></a>
                                        <p class="my-1">Awesome Quality!</p>
                                        <span class="text-muted"><em>2 hours ago</em></span>
                                    </div>
                                </div>
                                <div class="media push">
                                    <a class="mr-3" href="javascript:void(0)">
                                        <?php echo $one->get_avatar(0, 'female', 32); ?>
                                    </a>
                                    <div class="media-body">
                                        <span class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <a class="font-w600" href="javascript:void(0)"><?php echo $one->get_name('female'); ?></a>
                                        <p class="my-1">So cool badges!</p>
                                        <span class="text-muted"><em>5 hours ago</em></span>
                                    </div>
                                </div>
                                <div class="media push">
                                    <a class="mr-3" href="javascript:void(0)">
                                        <?php echo $one->get_avatar(0, 'male', 32); ?>
                                    </a>
                                    <div class="media-body">
                                        <span class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <a class="font-w600" href="javascript:void(0)"><?php echo $one->get_name('male'); ?></a>
                                        <p class="my-1">They look great, thank you!</p>
                                        <span class="text-muted"><em>15 hours ago</em></span>
                                    </div>
                                </div>
                                <div class="media push">
                                    <a class="mr-3" href="javascript:void(0)">
                                        <?php echo $one->get_avatar(0, 'male', 32); ?>
                                    </a>
                                    <div class="media-body">
                                        <span class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <a class="font-w600" href="javascript:void(0)"><?php echo $one->get_name('male'); ?></a>
                                        <p class="my-1">Badges for life!</p>
                                        <span class="text-muted"><em>20 hours ago</em></span>
                                    </div>
                                </div>
                                <div class="media push">
                                    <a class="mr-3" href="javascript:void(0)">
                                        <?php echo $one->get_avatar(0, 'female', 32); ?>
                                    </a>
                                    <div class="media-body">
                                        <span class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </span>
                                        <a class="font-w600" href="javascript:void(0)"><?php echo $one->get_name('female'); ?></a>
                                        <p class="my-1">So good, keep it up!</p>
                                        <span class="text-muted"><em>22 hours ago</em></span>
                                    </div>
                                </div>
                                <!-- END Ratings -->
                            </div>
                            <!-- END Reviews -->
                        </div>
                    </div>
                    <!-- END Extra Info Tabs -->
                </div>
            </div>
            <!-- END Product -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/magnific-popup/jquery.magnific-popup.min.js'); ?>

<!-- Page JS Helpers (Magnific Popup Plugin) -->
<script>jQuery(function(){ One.helpers('magnific-popup'); });</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
