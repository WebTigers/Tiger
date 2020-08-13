<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php
// Page specific configuration
$one->l_m_content = 'boxed';
?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/select2/css/select2.min.css'); ?>
<?php $one->get_css('js/plugins/dropzone/dist/min/dropzone.min.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Page Content -->
<div class="content">
    <!-- Quick Overview + Actions -->
    <div class="row">
        <div class="col-6 col-lg-4">
            <a class="block block-link-shadow text-center" href="be_pages_ecom_orders.php">
                <div class="block-content block-content-full">
                    <div class="font-size-h2 text-dark">250</div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="font-w600 font-size-sm text-muted mb-0">
                        Pending
                    </p>
                </div>
            </a>
        </div>
        <div class="col-6 col-lg-4">
            <a class="block block-link-shadow text-center" href="javascript:void(0)">
                <div class="block-content block-content-full">
                    <div class="font-size-h2 text-dark">29</div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="font-w600 font-size-sm text-muted mb-0">
                        Available
                    </p>
                </div>
            </a>
        </div>
        <div class="col-lg-4">
            <a class="block block-link-shadow text-center" href="be_pages_ecom_product_edit.php">
                <div class="block-content block-content-full">
                    <div class="font-size-h2 text-danger">
                        <i class="fa fa-times"></i>
                    </div>
                </div>
                <div class="block-content py-2 bg-body-light">
                    <p class="font-w600 font-size-sm text-danger mb-0">
                        Remove Product
                    </p>
                </div>
            </a>
        </div>
    </div>
    <!-- END Quick Overview + Actions -->

    <!-- Info -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Info</h3>
        </div>
        <div class="block-content">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <form action="be_pages_ecom_product_edit.php" method="POST" onsubmit="return false;">
                        <div class="form-group">
                            <label for="one-ecom-product-id">PID</label>
                            <input type="text" class="form-control" id="one-ecom-product-id" name="one-ecom-product-id" value="789" readonly>
                        </div>
                        <div class="form-group">
                            <label for="one-ecom-product-name">Name</label>
                            <input type="text" class="form-control" id="one-ecom-product-name" name="one-ecom-product-name" value="Dark Souls III">
                        </div>
                        <div class="form-group">
                            <!-- CKEditor (js-ckeditor-inline + js-ckeditor ids are initialized in Helpers.ckeditor()) -->
                            <!-- For more info and examples you can check out http://ckeditor.com -->
                            <label>Description</label>
                            <textarea id="js-ckeditor" name="one-ecom-product-description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="one-ecom-product-description-short">Short Description</label>
                            <textarea class="form-control" id="one-ecom-product-description-short" name="one-ecom-product-description-short" rows="4"></textarea>
                        </div>
                        <div class="form-group">
                            <!-- Select2 (.js-select2 class is initialized in Helpers.select2()) -->
                            <!-- For more info and examples you can check out https://github.com/select2/select2 -->
                            <label for="one-ecom-product-category">Category</label>
                            <select class="js-select2 form-control" id="one-ecom-product-category" name="one-ecom-product-category" style="width: 100%;" data-placeholder="Choose one..">
                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="1">Cables</option>
                                <option value="2" selected>Video Games</option>
                                <option value="3">Tablets</option>
                                <option value="4">Laptops</option>
                                <option value="5">PC</option>
                                <option value="6">Home Cinema</option>
                                <option value="7">Sound</option>
                                <option value="8">Office</option>
                                <option value="9">Adapters</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="one-ecom-product-price">Price in USD ($)</label>
                                <input type="text" class="form-control" id="one-ecom-product-price" name="one-ecom-product-price" value="59,00">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label for="one-ecom-product-stock">Stock</label>
                                <input type="text" class="form-control" id="one-ecom-product-stock" name="one-ecom-product-stock" value="29">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="d-block">Condition</label>
                            <div class="custom-control custom-radio custom-control-inline mb-1">
                                <input type="radio" class="custom-control-input" id="one-ecom-product-condition-new" name="one-ecom-product-condition" checked>
                                <label class="custom-control-label" for="one-ecom-product-condition-new">New</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline mb-1">
                                <input type="radio" class="custom-control-input" id="one-ecom-product-condition-old" name="one-ecom-product-condition">
                                <label class="custom-control-label" for="one-ecom-product-condition-old">Old</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Published?</label>
                            <div class="custom-control custom-switch mb-1">
                                <input type="checkbox" class="custom-control-input" id="one-ecom-product-published" name="one-ecom-product-published" checked>
                                <label class="custom-control-label" for="one-ecom-product-published"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Info -->

    <!-- Meta Data -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Meta Data</h3>
        </div>
        <div class="block-content">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <form action="be_pages_ecom_product_edit.php" method="POST" onsubmit="return false;">
                        <div class="form-group">
                            <!-- Bootstrap Maxlength (.js-maxlength class is initialized in Helpers.maxlength()) -->
                            <!-- For more info and examples you can check out https://github.com/mimo84/bootstrap-maxlength -->
                            <label for="one-ecom-product-meta-title">Title</label>
                            <input type="text" class="js-maxlength form-control" id="one-ecom-product-meta-title" name="one-ecom-product-meta-title" value="Dark Souls III" maxlength="55" data-always-show="true" data-placement="top">
                            <small class="form-text text-muted">
                                55 Character Max
                            </small>
                        </div>
                        <div class="form-group">
                            <!-- Select2 (.js-select2 class is initialized in Helpers.select2()) -->
                            <!-- For more info and examples you can check out https://github.com/select2/select2 -->
                            <label for="one-ecom-product-meta-keywords">Keywords</label>
                            <select class="js-select2 form-control" id="one-ecom-product-meta-keywords" name="one-ecom-product-meta-keywords" style="width: 100%;" data-placeholder="Choose many.." multiple>
                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="1" selected>Action</option>
                                <option value="2" selected>RPG</option>
                                <option value="3">Racing</option>
                                <option value="4">Strategy</option>
                                <option value="5">Adventure</option>
                                <option value="6">Strategy</option>
                                <option value="7">Puzzle</option>
                                <option value="8">Horror</option>
                                <option value="9">MMO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <!-- Bootstrap Maxlength (.js-maxlength class is initialized in Helpers.maxlength()) -->
                            <!-- For more info and examples you can check out https://github.com/mimo84/bootstrap-maxlength -->
                            <label for="one-ecom-product-meta-description">Description</label>
                            <textarea class="js-maxlength form-control" id="one-ecom-product-meta-description" name="one-ecom-product-meta-description" rows="4" maxlength="115" data-always-show="true" data-placement="top">Dark Souls III is an action role-playing video game developed by FromSoftware.</textarea>
                            <small class="form-text text-muted">
                                115 Character Max
                            </small>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-alt-success">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Meta Data -->

    <!-- Media -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Media</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <!-- Dropzone (functionality is auto initialized by the plugin itself in js/plugins/dropzone/dropzone.min.js) -->
                    <!-- For more info and examples you can check out http://www.dropzonejs.com/#usage -->
                    <form class="dropzone" action="be_pages_ecom_product_edit.php"></form>
                </div>
            </div>
        </div>
    </div>
    <!-- END Media -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/select2/js/select2.full.min.js'); ?>
<?php $one->get_js('js/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js'); ?>
<?php $one->get_js('js/plugins/ckeditor/ckeditor.js'); ?>
<?php $one->get_js('js/plugins/dropzone/dropzone.min.js'); ?>

<!-- Page JS Helpers (Select2 + CKEditor plugins) -->
<script>jQuery(function(){ One.helpers(['select2', 'maxlength', 'ckeditor']); });</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
