<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero Content -->
<div class="bg-primary-dark">
    <div class="content content-full overflow-hidden">
        <div class="mt-7 mb-5 text-center">
            <h1 class="h2 text-white mb-2 invisible" data-toggle="appear" data-class="animated fadeInDown">Support Center.</h1>
            <h2 class="h4 font-w400 text-white-75 invisible" data-toggle="appear" data-class="animated fadeInDown">Building products is not our only job. We care about our clients.</h2>
        </div>
    </div>
</div>
<!-- END Hero Content -->

<!-- Categories-->
<div class="content content-boxed overflow-hidden">
    <div class="row">
        <div class="col-sm-6 col-md-3 invisible" data-toggle="appear" data-class="animated fadeInDown">
            <a class="block block-bordered block-rounded block-link-shadow" href="javascript:void(0)">
                <div class="block-content block-content-full border-bottom text-center">
                    <div class="py-3">
                        <i class="si si-user fa-2x text-amethyst"></i>
                    </div>
                </div>
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <span class="font-w600 text-uppercase font-size-sm">Account</span>
                    <span class="badge badge-secondary">23</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-3 invisible" data-toggle="appear" data-timeout="200" data-class="animated fadeInDown">
            <a class="block block-bordered block-rounded block-link-shadow" href="javascript:void(0)">
                <div class="block-content block-content-full border-bottom text-center">
                    <div class="py-3">
                        <i class="si si-settings fa-2x text-city"></i>
                    </div>
                </div>
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <span class="font-w600 text-uppercase font-size-sm">Features</span>
                    <span class="badge badge-secondary">11</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-3 invisible" data-toggle="appear" data-timeout="400" data-class="animated fadeInDown">
            <a class="block block-bordered block-rounded block-link-shadow" href="javascript:void(0)">
                <div class="block-content block-content-full border-bottom text-center">
                    <div class="py-3">
                        <i class="si si-target fa-2x text-flat"></i>
                    </div>
                </div>
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <span class="font-w600 text-uppercase font-size-sm">Services</span>
                    <span class="badge badge-secondary">16</span>
                </div>
            </a>
        </div>
        <div class="col-sm-6 col-md-3 invisible" data-toggle="appear" data-timeout="600" data-class="animated fadeInDown">
            <a class="block block-bordered block-rounded block-link-shadow" href="javascript:void(0)">
                <div class="block-content block-content-full border-bottom text-center">
                    <div class="py-3">
                        <i class="si si-wallet fa-2x text-smooth"></i>
                    </div>
                </div>
                <div class="block-content block-content-full d-flex align-items-center justify-content-between">
                    <span class="font-w600 text-uppercase font-size-sm">Payments</span>
                    <span class="badge badge-secondary">19</span>
                </div>
            </a>
        </div>
    </div>
</div>
<!-- END Categories -->

<!-- Search Form -->
<div class="bg-white">
    <div class="content content-full">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="be_pages_generic_support.php" method="POST">
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Search..">
                        <div class="input-group-append">
                            <span class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- END Search Form -->

<!-- Frequently Asked Questions -->
<div class="content content-full">
    <div class="row justify-content-center">
        <div class="col-md-8 py-5">
            <!-- Introduction -->
            <h2 class="h3">Introduction</h2>
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
            <h2 class="h3">Functionality</h2>
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
            <h2 class="h3">Payments</h2>
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
                        <a class="text-muted" data-toggle="collapse" data-parent="#faq3" href="#faq3_q3" aria-expanded="true" aria-controls="faq3_q3">What are the available payment options?</a>
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

<!-- Contact Us -->
<div class="bg-body-dark">
    <div class="content content-full">
        <div class="my-5 text-center">
            <h3 class="h4 mb-4 invisible" data-toggle="appear">Can't find what you were looking for?</h3>
            <a class="btn btn-rounded btn-success px-4 py-2 invisible" data-toggle="appear" data-class="animated bounceIn" href="be_pages_generic_contact.php">Contact Us</a>
        </div>
    </div>
</div>
<!-- END Contact Us -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
