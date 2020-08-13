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
                Discussion
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx text-dark" href="be_pages_forum_categories.php">Forum</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a class="link-fx text-dark" href="be_pages_forum_topics.php">Topics</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Discussion</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Discussion -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Hey all! I just signed up!</h3>
            <div class="block-options">
                <a class="btn-block-option mr-2" href="#forum-reply-form" data-toggle="scroll-to">
                    <i class="fa fa-reply mr-1"></i> Reply
                </a>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
            </div>
        </div>
        <div class="block-content">
            <table class="table table-borderless">
                <tbody>
                    <tr class="table-active">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="font-size-sm text-muted">
                            <a href="be_pages_generic_profile.php"><?php $one->get_name('female'); ?></a> on <em>July 1, 2019 16:15</em>
                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center" style="width: 140px;">
                            <p>
                                <a href="be_pages_generic_profile.php">
                                    <?php $one->get_avatar('', 'female'); ?>
                                </a>
                            </p>
                            <p class="font-size-sm"><?php echo rand(100, 500); ?> Posts<br>Level <?php echo rand(1, 10); ?></p>
                        </td>
                        <td>
                            <?php $one->get_text('medium', 2); ?>
                            <hr>
                            <p class="font-size-sm text-muted">There is only one way to avoid criticism: do nothing, say nothing, and be nothing.</p>
                        </td>
                    </tr>
                    <tr class="table-active">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="font-size-sm text-muted">
                            <a href="be_pages_generic_profile.php"><?php $one->get_name('male'); ?></a> on <em>July 10, 2019 10:09</em>
                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center" style="width: 140px;">
                            <p>
                                <a href="be_pages_generic_profile.php">
                                    <?php $one->get_avatar('', 'male'); ?>
                                </a>
                            </p>
                            <p class="font-size-sm"><?php echo rand(100, 500); ?> Posts<br>Level <?php echo rand(1, 10); ?></p>
                        </td>
                        <td>
                            <?php $one->get_text('large'); ?>
                            <hr>
                            <p class="font-size-sm text-muted">Be yourself; everyone else is already taken.</p>
                        </td>
                    </tr>
                    <tr class="table-active">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="font-size-sm text-muted">
                            <a href="be_pages_generic_profile.php"><?php $one->get_name('male'); ?></a> on <em>July 15, 2019 20:17</em>
                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center" style="width: 140px;">
                            <p>
                                <a href="be_pages_generic_profile.php">
                                    <?php $one->get_avatar('', 'male'); ?>
                                </a>
                            </p>
                            <p class="font-size-sm"><?php echo rand(100, 500); ?> Posts<br>Level <?php echo rand(1, 10); ?></p>
                        </td>
                        <td>
                            <?php $one->get_text('medium', 3); ?>
                            <hr>
                            <p class="font-size-sm text-muted">Don't cry because it's over, smile because it happened.</p>
                        </td>
                    </tr>
                    <tr class="table-active">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="font-size-sm text-muted">
                            <a href="be_pages_generic_profile.php"><?php $one->get_name('female'); ?></a> on <em>July 20, 2019 20:29</em>
                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center" style="width: 140px;">
                            <p>
                                <a href="be_pages_generic_profile.php">
                                    <?php $one->get_avatar('', 'female'); ?>
                                </a>
                            </p>
                            <p class="font-size-sm"><?php echo rand(100, 500); ?> Posts<br>Level <?php echo rand(1, 10); ?></p>
                        </td>
                        <td>
                            <?php $one->get_text('medium', 2); ?>
                            <hr>
                            <p class="font-size-sm text-muted">Strive not to be a success, but rather to be of value.</p>
                        </td>
                    </tr>
                    <tr class="table-active" id="forum-reply-form">
                        <td class="d-none d-sm-table-cell"></td>
                        <td class="font-size-sm text-muted">
                            <a href="be_pages_generic_profile.php"><?php $one->get_name('male'); ?></a> Just now
                        </td>
                    </tr>
                    <tr>
                        <td class="d-none d-sm-table-cell text-center">
                            <p>
                                <a href="be_pages_generic_profile.php">
                                    <?php $one->get_avatar('', 'male'); ?>
                                </a>
                            </p>
                            <p class="font-size-sm"><?php echo rand(100, 500); ?> Posts<br>Level <?php echo rand(1, 10); ?></p>
                        </td>
                        <td>
                            <form action="be_pages_forum_discussion.php" method="POST" onsubmit="return false;">
                                <div class="form-group">
                                    <!-- CKEditor (js-ckeditor id is initialized in Helpers.ckeditor()) -->
                                    <!-- For more info and examples you can check out http://ckeditor.com -->
                                    <textarea id="js-ckeditor" name="ckeditor"></textarea>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-reply mr-1"></i> Reply
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Discussion -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/ckeditor/ckeditor.js'); ?>

<!-- Page JS Helpers (CKEditor plugin) -->
<script>jQuery(function(){ One.helpers(['ckeditor']); });</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
