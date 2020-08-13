<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php
// Page specific configuration
$one->l_page_overlay = false;
?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Page Overlay <small class="font-size-base font-w400 text-muted">Disabled</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Layout</li>
                    <li class="breadcrumb-item">Side Overlay</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">No Page Overlay</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="block">
        <div class="block-content text-center">
            <p>
                You can easily disable the clickable Page Overlay which opens when Side Overlay Opens. Try <a href="javascript:void(0)" data-toggle="layout" data-action="side_overlay_open">opening Side Overlay</a> to check it out.
            </p>
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
