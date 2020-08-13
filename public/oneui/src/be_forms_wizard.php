<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Form Wizard <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Step by step form submissions will become a valuable tool for you and your users.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Wizard</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Form Wizards (.js-wizard-* classes are initialized in js/pages/be_forms_wizard.min.js which was auto compiled from _es6/pages/be_forms_wizard.js) -->
    <!-- For more examples you can check out https://github.com/VinceG/twitter-bootstrap-wizard -->

    <!-- Simple Wizards -->
    <h2 class="content-heading">Simple Wizards</h2>
    <div class="row">
        <div class="col-md-6">
            <!-- Simple Wizard -->
            <div class="js-wizard-simple block">
                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#wizard-simple-step1" data-toggle="tab">1. Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple-step2" data-toggle="tab">2. Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple-step3" data-toggle="tab">3. Extra</a>
                    </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
                <form action="be_forms_wizard.php" method="POST">
                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content px-md-5" style="min-height: 300px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-simple-step1" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-simple-firstname">First Name</label>
                                <input class="form-control" type="text" id="wizard-simple-firstname" name="wizard-simple-firstname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-simple-lastname">Last Name</label>
                                <input class="form-control" type="text" id="wizard-simple-lastname" name="wizard-simple-lastname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-simple-email">Email</label>
                                <input class="form-control" type="email" id="wizard-simple-email" name="wizard-simple-email">
                            </div>
                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-simple-step2" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-simple-bio">Bio</label>
                                <textarea class="form-control" id="wizard-simple-bio" name="wizard-simple-bio" rows="7"></textarea>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-simple-step3" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-simple-location">Location</label>
                                <input class="form-control" type="text" id="wizard-simple-location" name="wizard-simple-location">
                            </div>
                            <div class="form-group">
                                <label for="wizard-simple-skills">Skills</label>
                                <select class="form-control" id="wizard-simple-skills" name="wizard-simple-skills">
                                    <option value="">Please select your best skill</option>
                                    <option value="1">Photoshop</option>
                                    <option value="2">HTML</option>
                                    <option value="3">CSS</option>
                                    <option value="4">JavaScript</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="wizard-simple-terms" name="wizard-simple-terms">
                                    <label class="custom-control-label" for="wizard-simple-terms">Agree with the terms</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 3 -->
                    </div>
                    <!-- END Steps Content -->

                    <!-- Steps Navigation -->
                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary" data-wizard="prev">
                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                    Next <i class="fa fa-angle-right ml-1"></i>
                                </button>
                                <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                                    <i class="fa fa-check mr-1"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Steps Navigation -->
                </form>
                <!-- END Form -->
            </div>
            <!-- END Simple Wizard -->
        </div>
        <div class="col-md-6">
            <!-- Simple Wizard 2 -->
            <div class="js-wizard-simple block block">
                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#wizard-simple2-step1" data-toggle="tab">1. Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple2-step2" data-toggle="tab">2. Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-simple2-step3" data-toggle="tab">3. Extra</a>
                    </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
                <form action="be_forms_wizard.php" method="POST">
                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content px-md-5" style="min-height: 303px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-simple2-step1" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-simple2-firstname">First Name</label>
                                <input class="form-control form-control-alt" type="text" id="wizard-simple2-firstname" name="wizard-simple2-firstname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-simple2-lastname">Last Name</label>
                                <input class="form-control form-control-alt" type="text" id="wizard-simple2-lastname" name="wizard-simple2-lastname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-simple2-email">Email</label>
                                <input class="form-control form-control-alt" type="email" id="wizard-simple2-email" name="wizard-simple2-email">
                            </div>
                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-simple2-step2" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-simple2-bio">Bio</label>
                                <textarea class="form-control form-control-alt" id="wizard-simple2-bio" name="wizard-simple2-bio" rows="7"></textarea>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-simple2-step3" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-simple2-location">Location</label>
                                <input class="form-control form-control-alt" type="text" id="wizard-simple2-location" name="wizard-simple2-location">
                            </div>
                            <div class="form-group">
                                <label for="wizard-simple2-skills">Skills</label>
                                <select class="form-control form-control-alt" id="wizard-simple2-skills" name="wizard-simple2-skills">
                                    <option value="">Please select your best skill</option>
                                    <option value="1">Photoshop</option>
                                    <option value="2">HTML</option>
                                    <option value="3">CSS</option>
                                    <option value="4">JavaScript</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="wizard-simple2-terms" name="wizard-simple2-terms">
                                    <label class="custom-control-label" for="wizard-simple2-terms">Agree with the terms</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 3 -->
                    </div>
                    <!-- END Steps Content -->

                    <!-- Steps Navigation -->
                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary" data-wizard="prev">
                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                    Next <i class="fa fa-angle-right ml-1"></i>
                                </button>
                                <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                                    <i class="fa fa-check mr-1"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Steps Navigation -->
                </form>
                <!-- END Form -->
            </div>
            <!-- END Simple Wizard 2 -->
        </div>
    </div>
    <!-- END Simple Wizards -->

    <!-- Progress Wizards -->
    <h2 class="content-heading">Progress Wizards</h2>
    <div class="row">
        <div class="col-md-6">
            <!-- Progress Wizard -->
            <div class="js-wizard-simple block block">
                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#wizard-progress-step1" data-toggle="tab">1. Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-progress-step2" data-toggle="tab">2. Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-progress-step3" data-toggle="tab">3. Extra</a>
                    </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
                <form action="be_forms_wizard.php" method="POST">
                    <!-- Wizard Progress Bar -->
                    <div class="block-content block-content-sm">
                        <div class="progress" data-wizard="progress" style="height: 8px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    <!-- END Wizard Progress Bar -->

                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content px-md-5" style="min-height: 300px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-progress-step1" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-progress-firstname">First Name</label>
                                <input class="form-control" type="text" id="wizard-progress-firstname" name="wizard-progress-firstname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-progress-lastname">Last Name</label>
                                <input class="form-control" type="text" id="wizard-progress-lastname" name="wizard-progress-lastname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-progress-email">Email</label>
                                <input class="form-control" type="email" id="wizard-progress-email" name="wizard-progress-email">
                            </div>
                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-progress-step2" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-progress-bio">Bio</label>
                                <textarea class="form-control" id="wizard-progress-bio" name="wizard-progress-bio" rows="7"></textarea>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-progress-step3" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-progress-location">Location</label>
                                <input class="form-control" type="text" id="wizard-progress-location" name="wizard-progress-location">
                            </div>
                            <div class="form-group">
                                <label for="wizard-progress-skills">Skills</label>
                                <select class="form-control" id="wizard-progress-skills" name="wizard-progress-skills">
                                    <option value="">Please select your best skill</option>
                                    <option value="1">Photoshop</option>
                                    <option value="2">HTML</option>
                                    <option value="3">CSS</option>
                                    <option value="4">JavaScript</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="wizard-progress-terms" name="wizard-progress-terms">
                                    <label class="custom-control-label" for="wizard-progress-terms">Agree with the terms</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 3 -->
                    </div>
                    <!-- END Steps Content -->

                    <!-- Steps Navigation -->
                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary" data-wizard="prev">
                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                    Next <i class="fa fa-angle-right ml-1"></i>
                                </button>
                                <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                                    <i class="fa fa-check mr-1"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Steps Navigation -->
                </form>
                <!-- END Form -->
            </div>
            <!-- END Progress Wizard -->
        </div>
        <div class="col-md-6">
            <!-- Progress Wizard 2 -->
            <div class="js-wizard-simple block block">
                <!-- Wizard Progress Bar -->
                <div class="progress rounded-0" data-wizard="progress" style="height: 8px;">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <!-- END Wizard Progress Bar -->

                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#wizard-progress2-step1" data-toggle="tab">1. Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-progress2-step2" data-toggle="tab">2. Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-progress2-step3" data-toggle="tab">3. Extra</a>
                    </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
                <form action="be_forms_wizard.php" method="POST">
                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content px-md-5" style="min-height: 314px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-progress2-step1" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-progress2-firstname">First Name</label>
                                <input class="form-control form-control-alt" type="text" id="wizard-progress2-firstname" name="wizard-progress2-firstname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-progress2-lastname">Last Name</label>
                                <input class="form-control form-control-alt" type="text" id="wizard-progress2-lastname" name="wizard-progress2-lastname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-progress2-email">Email</label>
                                <input class="form-control form-control-alt" type="email" id="wizard-progress2-email" name="wizard-progress2-email">
                            </div>
                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-progress2-step2" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-progress2-bio">Bio</label>
                                <textarea class="form-control form-control-alt" id="wizard-progress2-bio" name="wizard-progress2-bio" rows="7"></textarea>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-progress2-step3" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-simple2-location">Location</label>
                                <input class="form-control form-control-alt" type="text" id="wizard-progress2-location" name="wizard-simple2-location">
                            </div>
                            <div class="form-group">
                                <label for="wizard-progress2-skills">Skills</label>
                                <select class="form-control form-control-alt" id="wizard-progress2-skills" name="wizard-progress2-skills">
                                    <option value="">Please select your best skill</option>
                                    <option value="1">Photoshop</option>
                                    <option value="2">HTML</option>
                                    <option value="3">CSS</option>
                                    <option value="4">JavaScript</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="wizard-progress2-terms" name="wizard-progress2-terms">
                                    <label class="custom-control-label" for="wizard-progress2-terms">Agree with the terms</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 3 -->
                    </div>
                    <!-- END Steps Content -->

                    <!-- Steps Navigation -->
                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary" data-wizard="prev">
                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                    Next <i class="fa fa-angle-right ml-1"></i>
                                </button>
                                <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                                    <i class="fa fa-check mr-1"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Steps Navigation -->
                </form>
                <!-- END Form -->
            </div>
            <!-- END Progress Wizard 2 -->
        </div>
    </div>
    <!-- END Progress Wizards -->

    <!-- Validation Wizards -->
    <h2 class="content-heading">Validation Wizards</h2>
    <div class="row">
        <div class="col-md-6">
            <!-- Validation Wizard -->
            <div class="js-wizard-validation block block">
                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-block nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#wizard-validation-step1" data-toggle="tab">1. Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation-step2" data-toggle="tab">2. Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation-step3" data-toggle="tab">3. Extra</a>
                    </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
                <form class="js-wizard-validation-form" action="be_forms_wizard.php" method="POST">
                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content px-md-5" style="min-height: 300px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-validation-step1" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-validation-firstname">First Name</label>
                                <input class="form-control" type="text" id="wizard-validation-firstname" name="wizard-validation-firstname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-validation-lastname">Last Name</label>
                                <input class="form-control" type="text" id="wizard-validation-lastname" name="wizard-validation-lastname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-validation-email">Email</label>
                                <input class="form-control" type="email" id="wizard-validation-email" name="wizard-validation-email">
                            </div>
                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-validation-step2" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-validation-bio">Bio</label>
                                <textarea class="form-control" id="wizard-validation-bio" name="wizard-validation-bio" rows="7"></textarea>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-validation-step3" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-validation-location">Location</label>
                                <input class="form-control" type="text" id="wizard-validation-location" name="wizard-validation-location">
                            </div>
                            <div class="form-group">
                                <label for="wizard-validation-skills">Skills</label>
                                <select class="form-control" id="wizard-validation-skills" name="wizard-validation-skills">
                                    <option value="">Please select your best skill</option>
                                    <option value="1">Photoshop</option>
                                    <option value="2">HTML</option>
                                    <option value="3">CSS</option>
                                    <option value="4">JavaScript</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="wizard-validation-terms" name="wizard-validation-terms">
                                    <label class="custom-control-label" for="wizard-validation-terms">Agree with the terms</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 3 -->
                    </div>
                    <!-- END Steps Content -->

                    <!-- Steps Navigation -->
                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary" data-wizard="prev">
                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                    Next <i class="fa fa-angle-right ml-1"></i>
                                </button>
                                <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                                    <i class="fa fa-check mr-1"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Steps Navigation -->
                </form>
                <!-- END Form -->
            </div>
            <!-- END Validation Wizard Classic -->
        </div>
        <div class="col-md-6">
            <!-- Validation Wizard 2 -->
            <div class="js-wizard-validation2 block block">
                <!-- Step Tabs -->
                <ul class="nav nav-tabs nav-tabs-alt nav-justified" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#wizard-validation2-step1" data-toggle="tab">1. Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation2-step2" data-toggle="tab">2. Details</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#wizard-validation2-step3" data-toggle="tab">3. Extra</a>
                    </li>
                </ul>
                <!-- END Step Tabs -->

                <!-- Form -->
                <form class="js-wizard-validation2-form" action="be_forms_wizard.php" method="POST">
                    <!-- Steps Content -->
                    <div class="block-content block-content-full tab-content px-md-5" style="min-height: 303px;">
                        <!-- Step 1 -->
                        <div class="tab-pane active" id="wizard-validation2-step1" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-validation2-firstname">First Name</label>
                                <input class="form-control form-control-alt" type="text" id="wizard-validation2-firstname" name="wizard-validation2-firstname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-validation2-lastname">Last Name</label>
                                <input class="form-control form-control-alt" type="text" id="wizard-validation2-lastname" name="wizard-validation2-lastname">
                            </div>
                            <div class="form-group">
                                <label for="wizard-validation2-email">Email</label>
                                <input class="form-control form-control-alt" type="email" id="wizard-validation2-email" name="wizard-validation2-email">
                            </div>
                        </div>
                        <!-- END Step 1 -->

                        <!-- Step 2 -->
                        <div class="tab-pane" id="wizard-validation2-step2" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-validation2-bio">Bio</label>
                                <textarea class="form-control form-control-alt" id="wizard-validation2-bio" name="wizard-validation2-bio" rows="7"></textarea>
                            </div>
                        </div>
                        <!-- END Step 2 -->

                        <!-- Step 3 -->
                        <div class="tab-pane" id="wizard-validation2-step3" role="tabpanel">
                            <div class="form-group">
                                <label for="wizard-validation2-location">Location</label>
                                <input class="form-control form-control-alt" type="text" id="wizard-validation2-location" name="wizard-validation2-location">
                            </div>
                            <div class="form-group">
                                <label for="wizard-validation2-skills">Skills</label>
                                <select class="form-control form-control-alt" id="wizard-validation2-skills" name="wizard-validation2-skills">
                                    <option value="">Please select your best skill</option>
                                    <option value="1">Photoshop</option>
                                    <option value="2">HTML</option>
                                    <option value="3">CSS</option>
                                    <option value="4">JavaScript</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-checkbox custom-control-primary">
                                    <input type="checkbox" class="custom-control-input" id="wizard-validation2-terms" name="wizard-validation2-terms">
                                    <label class="custom-control-label" for="wizard-validation2-terms">Agree with the terms</label>
                                </div>
                            </div>
                        </div>
                        <!-- END Step 3 -->
                    </div>
                    <!-- END Steps Content -->

                    <!-- Steps Navigation -->
                    <div class="block-content block-content-sm block-content-full bg-body-light rounded-bottom">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-secondary" data-wizard="prev">
                                    <i class="fa fa-angle-left mr-1"></i> Previous
                                </button>
                            </div>
                            <div class="col-6 text-right">
                                <button type="button" class="btn btn-secondary" data-wizard="next">
                                    Next <i class="fa fa-angle-right ml-1"></i>
                                </button>
                                <button type="submit" class="btn btn-primary d-none" data-wizard="finish">
                                    <i class="fa fa-check mr-1"></i> Submit
                                </button>
                            </div>
                        </div>
                    </div>
                    <!-- END Steps Navigation -->
                </form>
                <!-- END Form -->
            </div>
            <!-- END Validation Wizard 2 -->
        </div>
    </div>
    <!-- END Validation Wizards -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/jquery-bootstrap-wizard/bs4/jquery.bootstrap.wizard.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-validation/jquery.validate.min.js'); ?>
<?php $one->get_js('js/plugins/jquery-validation/additional-methods.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_forms_wizard.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
