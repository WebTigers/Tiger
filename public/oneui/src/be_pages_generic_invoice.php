<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light d-print-none">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Invoice <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Clean and professional design.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Generic</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Invoice</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">
    <!-- Invoice -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">#INV0625</h3>
            <div class="block-options">
                <!-- Print Page functionality is initialized in Helpers.print() -->
                <button type="button" class="btn-block-option" onclick="One.helpers('print');">
                    <i class="si si-printer mr-1"></i> Print Invoice
                </button>
            </div>
        </div>
        <div class="block-content">
            <div class="p-sm-4 p-xl-7">
                <!-- Invoice Info -->
                <div class="row mb-4">
                    <!-- Company Info -->
                    <div class="col-6 font-size-sm">
                        <p class="h3">Company</p>
                        <address>
                            Street Address<br>
                            State, City<br>
                            Region, Postal Code<br>
                            ltd@example.com
                        </address>
                    </div>
                    <!-- END Company Info -->

                    <!-- Client Info -->
                    <div class="col-6 text-right font-size-sm">
                        <p class="h3">Client</p>
                        <address>
                            Street Address<br>
                            State, City<br>
                            Region, Postal Code<br>
                            ctr@example.com
                        </address>
                    </div>
                    <!-- END Client Info -->
                </div>
                <!-- END Invoice Info -->

                <!-- Table -->
                <div class="table-responsive push">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 60px;"></th>
                                <th>Product</th>
                                <th class="text-center" style="width: 90px;">Qnt</th>
                                <th class="text-right" style="width: 120px;">Unit</th>
                                <th class="text-right" style="width: 120px;">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <p class="font-w600 mb-1">App Design & Development</p>
                                    <div class="text-muted">Design/Development of iOS and Android application</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary">1</span>
                                </td>
                                <td class="text-right">$25.000,00</td>
                                <td class="text-right">$25.000,00</td>
                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <p class="font-w600 mb-1">Icon Pack Design</p>
                                    <div class="text-muted">50 uniquely crafted icons for promotion</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary">1</span>
                                </td>
                                <td class="text-right">$900,00</td>
                                <td class="text-right">$900,00</td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <p class="font-w600 mb-1">Website Design</p>
                                    <div class="text-muted">Promotional website for the mobile application</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-pill badge-primary">1</span>
                                </td>
                                <td class="text-right">$1.600,00</td>
                                <td class="text-right">$1.600,00</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w600 text-right">Subtotal</td>
                                <td class="text-right">$27.500,00</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w600 text-right">Vat Rate</td>
                                <td class="text-right">20%</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w600 text-right">Vat Due</td>
                                <td class="text-right">$5.500,00</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="font-w700 text-uppercase text-right bg-body-light">Total Due</td>
                                <td class="font-w700 text-right bg-body-light">$33.000,00</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!-- END Table -->

                <!-- Footer -->
                <p class="font-size-sm text-muted text-center py-3 my-3 border-top">
                    Thank you very much for doing business with us. We look forward to working with you again!
                </p>
                <!-- END Footer -->
            </div>
        </div>
    </div>
    <!-- END Invoice -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>