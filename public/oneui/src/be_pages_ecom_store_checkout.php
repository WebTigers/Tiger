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
            <h1 class="h2 text-white mb-2">
                <i class="fa fa-shopping-cart text-white-75 mr-1"></i> Checkout
            </h1>
            <h2 class="h4 font-w400 text-white-75 mb-0">We are almost there!</h2>
       </div>
    </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form action="be_pages_ecom_store_checkout.php" method="POST" onsubmit="return false;">
                <!-- Shopping Cart -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">1. Products</h3>
                    </div>
                    <div class="block-content block-content-full">
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
                </div>
                <!-- END Shopping Cart -->

                <!-- Create Account -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">2. Create Account</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="checkout-username">Username</label>
                                    <input type="text" class="form-control form-control-alt" id="checkout-username" name="checkout-username">
                                </div>
                                <div class="form-group">
                                    <label for="checkout-email">Email</label>
                                    <input type="email" class="form-control form-control-alt" id="checkout-email" name="checkout-email">
                                </div>
                                <div class="form-group">
                                    <label for="checkout-password">Password</label>
                                    <input type="password" class="form-control form-control-alt" id="checkout-password" name="checkout-password">
                                </div>
                                <div class="form-group">
                                    <label for="checkout-password-confirm">Confirm Password</label>
                                    <input type="password" class="form-control form-control-alt" id="checkout-password-confirm" name="checkout-password-confirm">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="checkout-firstname">Firstname</label>
                                    <input type="text" class="form-control form-control-alt" id="checkout-firstname" name="checkout-firstname">
                                </div>
                                <div class="form-group">
                                    <label for="checkout-lastname">Lastname</label>
                                    <input type="text" class="form-control form-control-alt" id="checkout-lastname" name="checkout-lastname">
                                </div>
                                <div class="form-group">
                                    <label for="checkout-country">Country</label>
                                    <input type="text" class="form-control form-control-alt" id="checkout-country" name="checkout-country">
                                </div>
                                <div class="form-group">
                                    <label for="checkout-city">City</label>
                                    <input type="text" class="form-control form-control-alt" id="checkout-city" name="checkout-city">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Create Account -->

                <!-- Payment -->
                <div class="block">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">3. Payment</h3>
                    </div>
                    <div class="block-content block-content-full">
                        <div class="mx-0 mx-md-6 mx-xl-8">
                            <div class="form-group">
                                <label for="checkout-cc-number">Number</label>
                                <input type="text" class="form-control form-control-alt" id="checkout-cc-number" name="checkout-cc-number" placeholder="**** **** **** ****">
                            </div>
                            <div class="form-group">
                                <label for="checkout-cc-name">Full Name</label>
                                <input type="text" class="form-control" id="checkout-cc-name" name="checkout-cc-name" placeholder="JOHN DOE">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="checkout-cc-expiry">MM/YYYY</label>
                                        <input type="text" class="form-control" id="checkout-cc-expiry" name="checkout-cc-expiry" placeholder="01/2019">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="checkout-cc-cvc">CVC</label>
                                        <input type="text" class="form-control" id="checkout-cc-cvc" name="checkout-cc-cvc" placeholder="***">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Payment -->

                <!-- Submit Form -->
                <div class="text-right push">
                    <button type="submit" class="btn btn-sm btn-primary">
                        <i class="fa fa-check mr-1"></i> Complete Order
                    </button>
                </div>
                <!-- END Submit Form -->
            </form>
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
