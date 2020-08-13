<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/select2/css/select2.min.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Form Validation <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">It’s never been easier to validate form values.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Validation</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- jQuery Validation (.js-validation class is initialized in js/pages/be_forms_validation.min.js which was auto compiled from _es6/pages/be_forms_validation.js) -->
    <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
    <form class="js-validation" action="be_forms_validation.php" method="POST">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Validation Form</h3>
            </div>
            <div class="block-content block-content-full">
                <!-- Regular -->
                <h2 class="content-heading border-bottom mb-4 pb-2">Regular</h2>
                <div class="row items-push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Username, email and password validation made easy for your login/register forms
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="val-username">Username <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-username" name="val-username" placeholder="Enter a username..">
                        </div>
                        <div class="form-group">
                            <label for="val-email">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-email" name="val-email" placeholder="Your valid email..">
                        </div>
                        <div class="form-group">
                            <label for="val-password">Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="val-password" name="val-password" placeholder="Choose a safe one..">
                        </div>
                        <div class="form-group">
                            <label for="val-confirm-password">Confirm Password <span class="text-danger">*</span></label>
                            <input type="password" class="form-control" id="val-confirm-password" name="val-confirm-password" placeholder="..and confirm it!">
                        </div>
                    </div>
                </div>
                <!-- END Regular -->

                <!-- Advanced -->
                <h2 class="content-heading border-bottom mb-4 pb-2">Advanced</h2>
                <div class="row items-push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            You can easily validate any kind of data you like either it is in a normal input, a textarea or a select box
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="val-suggestions">Suggestions <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="val-suggestions" name="val-suggestions" rows="5" placeholder="What would you like to see?"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="val-skill">Best Skill <span class="text-danger">*</span></label>
                            <select class="form-control" id="val-skill" name="val-skill">
                                <option value="">Please select</option>
                                <option value="html">HTML</option>
                                <option value="css">CSS</option>
                                <option value="javascript">JavaScript</option>
                                <option value="angular">Angular</option>
                                <option value="react">React</option>
                                <option value="vuejs">Vue.js</option>
                                <option value="ruby">Ruby</option>
                                <option value="php">PHP</option>
                                <option value="asp">ASP.NET</option>
                                <option value="python">Python</option>
                                <option value="mysql">MySQL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="val-currency">Currency <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-currency" name="val-currency" placeholder="$21.60">
                        </div>
                        <div class="form-group">
                            <label for="val-website">Website <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-website" name="val-website" placeholder="http://example.com">
                        </div>
                        <div class="form-group">
                            <label for="val-phoneus">Phone (US) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-phoneus" name="val-phoneus" placeholder="212-999-0000">
                        </div>
                        <div class="form-group">
                            <label for="val-digits">Digits <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-digits" name="val-digits" placeholder="5">
                        </div>
                        <div class="form-group">
                            <label for="val-number">Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-number" name="val-number" placeholder="5.0">
                        </div>
                        <div class="form-group">
                            <label for="val-range">Range [1, 5] <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="val-range" name="val-range" placeholder="4">
                        </div>
                        <div class="form-group">
                            <a href="#" data-toggle="modal" data-target="#modal-terms">Terms &amp; Conditions</a> <span class="text-danger">*</span>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="val-terms" name="val-terms" value="1">
                                <label class="custom-control-label" for="val-terms">I agree</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Advanced -->

                <!-- Third Party Plugins -->
                <h2 class="content-heading border-bottom mb-4 pb-2">Third Party Plugins</h2>
                <div class="row items-push">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Check out how easy it is to enable the validation on third party plugins such as Select2
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <label for="val-select2">Select2 <span class="text-danger">*</span></label>
                            <select class="js-select2 form-control" id="val-select2" name="val-select2" style="width: 100%;" data-placeholder="Choose one..">
                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="html">HTML</option>
                                <option value="css">CSS</option>
                                <option value="javascript">JavaScript</option>
                                <option value="angular">Angular</option>
                                <option value="react">React</option>
                                <option value="vuejs">Vue.js</option>
                                <option value="ruby">Ruby</option>
                                <option value="php">PHP</option>
                                <option value="asp">ASP.NET</option>
                                <option value="python">Python</option>
                                <option value="mysql">MySQL</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="val-select2-multiple">Select2 Multiple <span class="text-danger">*</span></label>
                            <select class="js-select2 form-control" id="val-select2-multiple" name="val-select2-multiple" style="width: 100%;" data-placeholder="Choose at least two.." multiple>
                                <option></option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                <option value="html">HTML</option>
                                <option value="css">CSS</option>
                                <option value="javascript">JavaScript</option>
                                <option value="angular">Angular</option>
                                <option value="react">React</option>
                                <option value="vuejs">Vue.js</option>
                                <option value="ruby">Ruby</option>
                                <option value="php">PHP</option>
                                <option value="asp">ASP.NET</option>
                                <option value="python">Python</option>
                                <option value="mysql">MySQL</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- END Third Party Plugins -->

                <!-- Submit -->
                <div class="row items-push">
                    <div class="col-lg-7 offset-lg-4">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                <!-- END Submit -->
            </div>
        </div>
    </form>
    <!-- jQuery Validation -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>

<!-- Terms Modal -->
<div class="modal fade" id="modal-terms" tabindex="-1" role="dialog" aria-labelledby="modal-terms" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-themed block-transparent mb-0">
                <div class="block-header bg-primary-dark">
                    <h3 class="block-title">Terms &amp; Conditions</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <?php $one->get_text('small', 2); ?>
                </div>
                <div class="block-content block-content-full text-right bg-light">
                    <button type="button" class="btn btn-sm btn-primary" data-dismiss="modal">Done</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Terms Modal -->

<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/select2/js/select2.full.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-validation/additional-methods.js'); ?>

<!-- Page JS Helpers (Select2 plugin) -->
<script>jQuery(function(){ One.helpers('select2'); });</script>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_forms_validation.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
