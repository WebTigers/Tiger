<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php
// Page specific configuration
$one->l_m_content = 'boxed';
?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo3@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full text-center py-6">
            <h1 class="h2 text-white mb-2">Welcome to our Digital Store!</h1>
            <h2 class="h4 font-w400 text-white-75 mb-0">Feel free to explore over 50.000 products.</h2>
       </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Toggle Side Content -->
    <!-- Class Toggle, functionality initialized in Helpers.coreToggleClass() -->
    <div class="d-xl-none push">
        <button type="button" class="btn btn-light btn-block" data-toggle="class-toggle" data-target=".js-ecom-div-cart" data-class="d-none">
            <i class="fa fa-fw fa-shopping-cart text-muted mr-1"></i> Cart (3)
        </button>
    </div>
    <!-- END Toggle Side Content -->

    <div class="row push">
        <div class="col-xl-4 order-xl-1">
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
            <!-- New Arrivals -->
            <h2 class="content-heading">New Arrivals</h2>
            <div class="row row-deck">
                <div class="col-md-6 col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product1.png" alt="">
                            <div class="options-overlay bg-black-75">
                                <div class="options-overlay-content">
                                    <a class="btn btn-sm btn-light" href="be_pages_ecom_store_product.php">
                                        View
                                    </a>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-plus text-success mr-1"></i> Add to cart
                                    </a>
                                    <div class="text-warning mt-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-alt"></i>
                                        <span class="text-white">(35)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$9</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">Iconic</a>
                            </div>
                            <p class="font-size-sm text-muted">Beautifully crafted icon set</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product2.png" alt="">
                            <div class="options-overlay bg-black-75">
                                <div class="options-overlay-content">
                                    <a class="btn btn-sm btn-light" href="be_pages_ecom_store_product.php">
                                        View
                                    </a>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-plus text-success mr-1"></i> Add to cart
                                    </a>
                                    <div class="text-warning mt-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <span class="text-white">(48)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$16</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">Mailday</a>
                            </div>
                            <p class="font-size-sm text-muted">Pro email templates</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product3.png" alt="">
                            <div class="options-overlay bg-black-75">
                                <div class="options-overlay-content">
                                    <a class="btn btn-sm btn-light" href="be_pages_ecom_store_product.php">
                                        View
                                    </a>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-plus text-success mr-1"></i> Add to cart
                                    </a>
                                    <div class="text-warning mt-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-alt"></i>
                                        <span class="text-white">(19)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$75</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">Office Suite</a>
                            </div>
                            <p class="font-size-sm text-muted">The best productivity apps</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <a class="font-size-sm font-w600 link-fx" href="be_pages_ecom_store_products.php">View More New Arrivals..</a>
            </div>
            <!-- END New Arrivals -->

            <!-- Best Sellers -->
            <h2 class="content-heading">Best Sellers</h2>
            <div class="row row-deck">
                <div class="col-md-6 col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product5.png" alt="">
                            <div class="options-overlay bg-black-75">
                                <div class="options-overlay-content">
                                    <a class="btn btn-sm btn-light" href="be_pages_ecom_store_product.php">
                                        View
                                    </a>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-plus text-success mr-1"></i> Add to cart
                                    </a>
                                    <div class="text-warning mt-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <span class="text-white">(690)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$44</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">Video UI Kit</a>
                            </div>
                            <p class="font-size-sm text-muted">Media components that work</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product6.png" alt="">
                            <div class="options-overlay bg-black-75">
                                <div class="options-overlay-content">
                                    <a class="btn btn-sm btn-light" href="be_pages_ecom_store_product.php">
                                        View
                                    </a>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-plus text-success mr-1"></i> Add to cart
                                    </a>
                                    <div class="text-warning mt-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <span class="text-white">(480)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$58</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">Super Badges Pack</a>
                            </div>
                            <p class="font-size-sm text-muted">1000s of high quality badges</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product7.png" alt="">
                            <div class="options-overlay bg-black-75">
                                <div class="options-overlay-content">
                                    <a class="btn btn-sm btn-light" href="be_pages_ecom_store_product.php">
                                        View
                                    </a>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-plus text-success mr-1"></i> Add to cart
                                    </a>
                                    <div class="text-warning mt-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-alt"></i>
                                        <span class="text-white">(520)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$65</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">RPG Game Pack</a>
                            </div>
                            <p class="font-size-sm text-muted">10-in-1 Anniversary Pack</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <a class="font-size-sm font-w600 link-fx" href="be_pages_ecom_store_products.php">View More Best Sellers..</a>
            </div>
            <!-- END Best Sellers -->

            <!-- Best Rated -->
            <h2 class="content-heading">Best Rated</h2>
            <div class="row row-deck">
                <div class="col-md-6 col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product9.png" alt="">
                            <div class="options-overlay bg-black-75">
                                <div class="options-overlay-content">
                                    <a class="btn btn-sm btn-light" href="be_pages_ecom_store_product.php">
                                        View
                                    </a>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-plus text-success mr-1"></i> Add to cart
                                    </a>
                                    <div class="text-warning mt-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <span class="text-white">(1050)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$18</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">MapNow</a>
                            </div>
                            <p class="font-size-sm text-muted">Map service for your app</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product10.png" alt="">
                            <div class="options-overlay bg-black-75">
                                <div class="options-overlay-content">
                                    <a class="btn btn-sm btn-light" href="be_pages_ecom_store_product.php">
                                        View
                                    </a>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-plus text-success mr-1"></i> Add to cart
                                    </a>
                                    <div class="text-warning mt-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <span class="text-white">(998)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$44</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">Calendious</a>
                            </div>
                            <p class="font-size-sm text-muted">Management for freelancers</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product11.png" alt="">
                            <div class="options-overlay bg-black-75">
                                <div class="options-overlay-content">
                                    <a class="btn btn-sm btn-light" href="be_pages_ecom_store_product.php">
                                        View
                                    </a>
                                    <a class="btn btn-sm btn-light" href="javascript:void(0)">
                                        <i class="fa fa-plus text-success mr-1"></i> Add to cart
                                    </a>
                                    <div class="text-warning mt-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <span class="text-white">(870)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$35</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">Todo App</a>
                            </div>
                            <p class="font-size-sm text-muted">All your tasks in one place</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-right">
                <a class="font-size-sm font-w600 link-fx" href="be_pages_ecom_store_products.php">View More Best Rated..</a>
            </div>
            <!-- END Best Rated -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<!-- Explore Store -->
<div class="bg-body-dark">
    <div class="content content-full">
        <div class="my-5 text-center">
            <h3 class="h4 mb-4 invisible" data-toggle="appear">
                Over <strong>50.000</strong> digital products!
            </h3>
            <a class="btn btn-rounded btn-success px-4 py-2 invisible" data-toggle="appear" data-class="animated bounceIn" href="be_pages_ecom_store_products.php">
                Explore Store <i class="fa fa-arrow-right ml-1"></i>
            </a>
        </div>
    </div>
</div>
<!-- END Explore Store -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
