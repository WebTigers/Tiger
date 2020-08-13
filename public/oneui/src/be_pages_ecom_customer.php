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
    <!-- Quick Actions -->
    <div class="row">
        <div class="col-6">
            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-h2 text-dark">
                        <i class="fa fa-pencil-alt"></i>
                    </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="font-w600 font-size-sm text-muted mb-0">
                        Edit Customer
                    </p>
                </div>
            </a>
        </div>
        <div class="col-6">
            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-h2 text-danger">
                        <i class="fa fa-times"></i>
                    </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="font-w600 font-size-sm text-danger mb-0">
                        Remove Customer
                    </p>
                </div>
            </a>
        </div>
    </div>
    <!-- END Quick Actions -->

    <!-- User Info -->
    <div class="block">
        <div class="block-content text-center">
            <div class="py-4">
                <div class="mb-3">
                    <?php $one->get_avatar(13); ?>
                </div>
                <h1 class="font-size-lg mb-0">
                    John Parker <i class="fa fa-star text-warning" data-toggle="tooltip" title="Premium Member"></i>
                </h1>
                <p class="font-size-sm text-muted">UI Designer</p>
            </div>
        </div>
        <div class="block-content bg-body-light text-center">
            <div class="row items-push text-uppercase">
                <div class="col-6 col-md-3">
                    <div class="font-w600 text-dark mb-1">Orders</div>
                    <a class="link-fx font-size-h3 text-primary" href="javascript:void(0)">5</a>
                </div>
                <div class="col-6 col-md-3">
                    <div class="font-w600 text-dark mb-1">Orders Value</div>
                    <a class="link-fx font-size-h3 text-primary" href="javascript:void(0)">$3.580,00</a>
                </div>
                <div class="col-6 col-md-3">
                    <div class="font-w600 text-dark mb-1">Cart</div>
                    <a class="link-fx font-size-h3 text-primary" href="javascript:void(0)">4</a>
                </div>
                <div class="col-6 col-md-3">
                    <div class="font-w600 text-dark mb-1">Referred</div>
                    <a class="link-fx font-size-h3 text-primary" href="javascript:void(0)">3</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END User Info -->

    <!-- Addresses -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Addresses (2)</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-lg-6">
                    <!-- Billing Address -->
                    <div class="block block-bordered">
                        <div class="block-header border-bottom">
                            <h3 class="block-title">Billing Address</h3>
                        </div>
                        <div class="block-content">
                            <div class="font-size-h4 mb-1">John Parker</div>
                            <address class="font-size-sm">
                                Sunrise Str 620<br>
                                Melbourne<br>
                                Australia, 11-587<br><br>
                                <i class="fa fa-phone"></i> (999) 888-55555<br>
                                <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">company@example.com</a>
                            </address>
                        </div>
                    </div>
                    <!-- END Billing Address -->
                </div>
                <div class="col-lg-6">
                    <!-- Shipping Address -->
                    <div class="block block-bordered">
                        <div class="block-header border-bottom">
                            <h3 class="block-title">Shipping Address</h3>
                        </div>
                        <div class="block-content">
                            <div class="font-size-h4 mb-1">John Parker</div>
                            <address class="font-size-sm">
                                Sunrise Str 620<br>
                                Melbourne<br>
                                Australia, 11-587<br><br>
                                <i class="fa fa-phone"></i> (999) 888-55555<br>
                                <i class="fa fa-envelope-o"></i> <a href="javascript:void(0)">company@example.com</a>
                            </address>
                        </div>
                    </div>
                    <!-- END Shipping Address -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Addresses -->

    <!-- Shopping Cart -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Shopping Cart (4)</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">ID</th>
                            <th class="d-none d-md-table-cell">Product</th>
                            <th class="d-none d-sm-table-cell text-center">Added</th>
                            <th>Status</th>
                            <th class="d-none d-sm-table-cell text-right">Value</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php
                        $badges['0']['class']   = "badge-success";
                        $badges['0']['text']    = "Available";
                        $badges['1']['class']   = "badge-danger";
                        $badges['1']['text']    = "Out of Stock";
                        ?>
                        <?php for ($i = 4; $i > 0; $i--) { ?>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="be_pages_ecom_product_edit.php">
                                    <strong>PID.015<?php echo $i; ?></strong>
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell font-size-sm">
                                <a href="be_pages_ecom_product_edit.php">Product #<?php echo $i; ?></a>
                            </td>
                            <td class="d-none d-sm-table-cell text-center font-size-sm"><?php echo sprintf('%02d', rand(1, 28)) . '/' . sprintf('%02d', rand(1, 12)); ?>/2019</td>
                            <td>
                                <span class="badge<?php $rand = rand(0, 1); echo ($badges[$rand]['class']) ? " " . $badges[$rand]['class'] : ""; ?>"><?php echo $badges[$rand]['text']; ?></span>
                            </td>
                            <td class="text-right d-none d-sm-table-cell font-size-sm">
                                <strong>$<?php echo rand(10, 99); ?>,00</strong>
                            </td>
                            <td class="text-center font-size-sm">
                                <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.php" data-toggle="tooltip" title="View">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Shopping Cart -->

    <!-- Past Orders -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Past Orders (5)</h3>
        </div>
        <div class="block-content">
            <div class="table-responsive">
                <table class="table table-borderless table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">ID</th>
                            <th class="d-none d-md-table-cell text-center">Products</th>
                            <th class="d-none d-sm-table-cell text-center">Submitted</th>
                            <th>Status</th>
                            <th class="d-none d-sm-table-cell text-right">Value</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php for ($i = 5; $i > 0; $i--) { ?>
                        <tr>
                            <td class="text-center font-size-sm">
                                <a class="font-w600" href="be_pages_ecom_order.php">
                                    <strong>ORD.062<?php echo $i; ?></strong>
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell text-center font-size-sm">
                                <a href="javascript:void(0)"><?php echo rand(1, 9); ?></a>
                            </td>
                            <td class="d-none d-sm-table-cell text-center font-size-sm"><?php echo sprintf('%02d', rand(1, 28)) . '/' . sprintf('%02d', rand(1, 12)); ?>/2019</td>
                            <td>
                                <span class="badge badge-success">Delivered</span>
                            </td>
                            <td class="text-right d-none d-sm-table-cell font-size-sm">
                                <strong>$<?php echo rand(29, 299); ?>,00</strong>
                            </td>
                            <td class="text-center font-size-sm">
                                <a class="btn btn-sm btn-alt-secondary" href="be_pages_ecom_product_edit.php" data-toggle="tooltip" title="View">
                                    <i class="fa fa-fw fa-eye"></i>
                                </a>
                                <a class="btn btn-sm btn-alt-danger" href="javascript:void(0)" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-fw fa-times text-danger"></i>
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Past Orders -->

    <!-- Referred Members -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Referred Members (3)</h3>
        </div>
        <div class="block-content">
            <div class="row row-deck">
                <div class="col-md-4">
                    <!-- Referred User -->
                    <a class="block block-bordered block-link-shadow" href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="font-w600 mb-1"><?php $one->get_name('female'); ?></div>
                                <div class="font-size-sm text-muted">4 Orders</div>
                            </div>
                            <div class="ml-3">
                                <?php $one->get_avatar(0, 'female'); ?>    
                            </div>
                        </div>
                    </a>
                    <!-- END Referred User -->
                </div>
                <div class="col-md-4">
                    <!-- Referred User -->
                    <a class="block block-bordered block-link-shadow" href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="font-w600 mb-1"><?php $one->get_name('male'); ?></div>
                                <div class="font-size-sm text-muted">5 Orders</div>
                            </div>
                            <div class="ml-3">
                                <?php $one->get_avatar(0, 'male'); ?>    
                            </div>
                        </div>
                    </a>
                    <!-- END Referred User -->
                </div>
                <div class="col-md-4">
                    <!-- Referred User -->
                    <a class="block block-bordered block-link-shadow" href="javascript:void(0)">
                        <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                            <div>
                                <div class="font-w600 mb-1"><?php $one->get_name('female'); ?></div>
                                <div class="font-size-sm text-muted">3 Orders</div>
                            </div>
                            <div class="ml-3">
                                <?php $one->get_avatar(0, 'female'); ?>    
                            </div>
                        </div>
                    </a>
                    <!-- END Referred User -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Referred Members -->

    <!-- Private Notes -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Private Notes</h3>
        </div>
        <div class="block-content">
            <p class="alert alert-info font-size-sm">
                <i class="fa fa-fw fa-info mr-1"></i> This note will not be displayed to the customer.
            </p>
            <form action="be_pages_ecom_customer.php" onsubmit="return false;">
                <div class="form-group">
                    <label for="one-ecom-customer-note">Note</label>
                    <textarea class="form-control" id="one-ecom-customer-note" name="one-ecom-customer-note" rows="4" placeholder="Maybe a special request?"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-alt-success">Add Note</button>
                </div>
            </form>
        </div>
    </div>
    <!-- END Private Notes -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
