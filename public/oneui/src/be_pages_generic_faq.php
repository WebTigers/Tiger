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
                FAQ <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Check out answers to the most common questions.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Generic</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">FAQ</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content content-boxed">
    <!-- Frequently Asked Questions -->
    <div class="block">
        <div class="block-content block-content-full">
            <div class="p-sm-4 p-xl-7">
                <!-- Introduction -->
                <h2 class="h3"><strong>1.</strong> Introduction</h2>
                <div id="faq1" class="mb-5" role="tablist" aria-multiselectable="true">
                    <div class="block block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q1" aria-expanded="true" aria-controls="faq1_q1">Welcome to our service!</a>
                        </div>
                        <div id="faq1_q1" class="collapse show" role="tabpanel" aria-labelledby="faq1_h1" data-parent="#faq1">
                            <div class="block-content">
                                <?php $one->get_text('small', 2); ?>
                            </div>
                        </div>
                    </div>
                    <div class="block block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h2">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q2" aria-expanded="true" aria-controls="faq1_q2">Who are we?</a>
                        </div>
                        <div id="faq1_q2" class="collapse" role="tabpanel" aria-labelledby="faq1_h2" data-parent="#faq1">
                            <div class="block-content">
                                <?php $one->get_text('small', 2); ?>
                            </div>
                        </div>
                    </div>
                    <div class="block block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq1_h3">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq1" href="#faq1_q3" aria-expanded="true" aria-controls="faq1_q3">What are our values?</a>
                        </div>
                        <div id="faq1_q3" class="collapse" role="tabpanel" aria-labelledby="faq1_h3" data-parent="#faq1">
                            <div class="block-content">
                                <?php $one->get_text('small'); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Introduction -->

                <!-- Functionality -->
                <h2 class="h3"><strong>2.</strong> Functionality</h2>
                <div id="faq2" class="mb-5" role="tablist" aria-multiselectable="true">
                    <div class="block block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq2_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq2" href="#faq2_q1" aria-expanded="true" aria-controls="faq2_q1">What are the key features?</a>
                        </div>
                        <div id="faq2_q1" class="collapse" role="tabpanel" aria-labelledby="faq2_h1" data-parent="#faq2">
                            <div class="block-content">
                                <?php $one->get_text('small', 2); ?>
                            </div>
                        </div>
                    </div>
                    <div class="block block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq2_h2">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq2" href="#faq2_q2" aria-expanded="true" aria-controls="faq2_q2">Does your App support mobile devices?</a>
                        </div>
                        <div id="faq2_q2" class="collapse" role="tabpanel" aria-labelledby="faq2_h2" data-parent="#faq2">
                            <div class="block-content">
                                <?php $one->get_text('small', 2); ?>
                            </div>
                        </div>
                    </div>
                    <div class="block block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq2_h3">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq2" href="#faq2_q3" aria-expanded="true" aria-controls="faq2_q3">Why should I choose your service?</a>
                        </div>
                        <div id="faq2_q3" class="collapse" role="tabpanel" aria-labelledby="faq2_h3" data-parent="#faq2">
                            <div class="block-content">
                                <?php $one->get_text('small', 2); ?>
                            </div>
                        </div>
                    </div>
                    <div class="block block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq2_h4">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq2" href="#faq2_q4" aria-expanded="true" aria-controls="faq2_q4">Is my data secure?</a>
                        </div>
                        <div id="faq2_q4" class="collapse" role="tabpanel" aria-labelledby="faq2_h4" data-parent="#faq2">
                            <div class="block-content">
                                <?php $one->get_text('small', 2); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Functionality -->

                <!-- Payments -->
                <h2 class="h3"><strong>3.</strong> Payments</h2>
                <div id="faq3" role="tablist" aria-multiselectable="true">
                    <div class="block block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq3_h1">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq3" href="#faq3_q1" aria-expanded="true" aria-controls="faq3_q1">Is there any free plan?</a>
                        </div>
                        <div id="faq3_q1" class="collapse" role="tabpanel" aria-labelledby="faq3_h1" data-parent="#faq3">
                            <div class="block-content">
                                <?php $one->get_text('small', 2); ?>
                            </div>
                        </div>
                    </div>
                    <div class="block block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq3_h2">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq3" href="#faq3_q2" aria-expanded="true" aria-controls="faq3_q2">What are the available payment options?</a>
                        </div>
                        <div id="faq3_q2" class="collapse" role="tabpanel" aria-labelledby="faq3_h2" data-parent="#faq3">
                            <div class="block-content">
                                <?php $one->get_text('small', 2); ?>
                            </div>
                        </div>
                    </div>
                    <div class="block block-bordered mb-1">
                        <div class="block-header block-header-default" role="tab" id="faq3_h3">
                            <a class="text-muted" data-toggle="collapse" data-parent="#faq3" href="#faq3_q3" aria-expanded="true" aria-controls="faq3_q3">Can I get a refund?</a>
                        </div>
                        <div id="faq3_q3" class="collapse" role="tabpanel" aria-labelledby="faq3_h3" data-parent="#faq3">
                            <div class="block-content">
                                <?php $one->get_text('small', 2); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Payments -->
            </div>
        </div>
    </div>
    <!-- END Frequently Asked Questions -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
