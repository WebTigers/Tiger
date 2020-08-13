<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php
// Page specific configuration
$one->l_m_content = 'boxed';
?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

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

    <div class="row push">
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
                            <a class="nav-link d-flex justify-content-between align-items-center" href="javascript:void(0)">
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
            <!-- Sort and Show Filters -->
            <div class="d-flex justify-content-between">
                <div class="mb-3">
                    <select id="ecom-results-show" name="ecom-results-show" class="form-control form-control-sm" size="1">
                        <option value="0" disabled selected>SHOW</option>
                        <option value="9">9</option>
                        <option value="18">18</option>
                        <option value="36">36</option>
                        <option value="72">72</option>
                    </select>
                </div>
                <div class="mb-3">
                    <select id="ecom-results-sort" name="ecom-results-sort" class="form-control form-control-sm" size="1">
                        <option value="0" disabled selected>SORT BY</option>
                        <option value="1">Popularity</option>
                        <option value="2">Name (A to Z)</option>
                        <option value="3">Name (Z to A)</option>
                        <option value="4">Price (Lowest to Highest)</option>
                        <option value="5">Price (Highest to Lowest)</option>
                        <option value="6">Sales (Lowest to Highest)</option>
                        <option value="7">Sales (Highest to Lowest)</option>
                    </select>
                </div>
            </div>
            <!-- END Sort and Show Filters -->

            <!-- Products -->
            <div class="row row-deck">
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
                <div class="col-md-6 col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product12.png" alt="">
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
                                        <span class="text-white">(745)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$22</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">e-Music</a>
                            </div>
                            <p class="font-size-sm text-muted">Music streaming service</p>
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
                <div class="col-md-6 col-xl-4">
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
                <div class="col-md-6 col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product4.png" alt="">
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
                                        <span class="text-white">(69)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$15</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">Steam Games</a>
                            </div>
                            <p class="font-size-sm text-muted">3-in-1 Adventure Pack</p>
                        </div>
                    </div>
                </div>
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
                <div class="col-md-6 col-xl-4">
                    <div class="block">
                        <div class="options-container">
                            <img class="img-fluid options-item" src="<?php echo $one->assets_folder; ?>/media/various/ecom_product8.png" alt="">
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
                                        <span class="text-white">(490)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="block-content">
                            <div class="mb-2">
                                <div class="h4 font-w600 text-success float-right ml-1">$17</div>
                                <a class="h4" href="be_pages_ecom_store_product.php">Antivir</a>
                            </div>
                            <p class="font-size-sm text-muted">Antivirus protection for all</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
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
                <a class="btn btn-sm btn-secondary" href="be_pages_ecom_store_products.php">
                    Next Page <i class="fa fa-arrow-right ml-1"></i>
                </a>
            </div>
            <!-- END Products -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
