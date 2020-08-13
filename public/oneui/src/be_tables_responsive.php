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
                Responsive Tables <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Mobile friendly tables that work across all screen sizes.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Responsive</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Full Table -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Full Table</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option">
                    <i class="si si-settings"></i>
                </button>
            </div>
        </div>
        <div class="block-content">
            <p class="font-size-sm text-muted">
                The first way to make a table responsive is to wrap it with <code>&lt;div class=&quot;table-responsive&quot;&gt;&lt;/div&gt;</code>. This way, the table will be horizontally scrollable and all data will be accessible on smaller screens. You could also append the following modifiers to the <code>table-responsive</code> to apply the horizontal scrolling on different screen widths: <code>-sm</code>, <code>-md</code>, <code>-lg</code>, <code>-xl</code>.
            </p>
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-vcenter">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 100px;">
                                <i class="far fa-user"></i>
                            </th>
                            <th>Name</th>
                            <th style="width: 30%;">Email</th>
                            <th style="width: 15%;">Access</th>
                            <th class="text-center" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 1; $i < 6; $i++) { ?>
                        <tr>
                            <td class="text-center">
                                <?php $one->get_avatar(0, 'female', 48); ?>
                            </td>
                            <td class="font-w600 font-size-sm">
                                <a href="be_pages_generic_profile.php"><?php $one->get_name('female'); ?></a>
                            </td>
                            <td class="font-size-sm">client<?php echo $i; ?><em class="text-muted">@example.com</em></td>
                            <td>
                                <?php $one->get_tag(); ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete">
                                        <i class="fa fa-fw fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- END Full Table -->

    <!-- Partial Table -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Partial Table</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option">
                    <i class="si si-settings"></i>
                </button>
            </div>
        </div>
        <div class="block-content">
            <p class="font-size-sm text-muted">
                The second way is to use <a href="be_ui_grid.php#grid-rutil">responsive utility CSS classes</a> for hiding columns in various screen resolutions. This way you can hide less important columns and keep the most valuable on smaller screens. At the following example the <strong>Access</strong> column isn't visible on small and extra small screens and <strong>Email</strong> column isn't visible on extra small screens.
            </p>
            <table class="table table-bordered table-striped table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 100px;">
                            <i class="far fa-user"></i>
                        </th>
                        <th>Name</th>
                        <th class="d-none d-md-table-cell" style="width: 30%;">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                        <th class="text-center" style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i < 6; $i++) { ?>
                    <tr>
                        <td class="text-center">
                            <?php $one->get_avatar(0, 'female', 48); ?>
                        </td>
                        <td class="font-w600 font-size-sm">
                            <a href="be_pages_generic_profile.php"><?php $one->get_name('female'); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell font-size-sm">client<?php echo $i; ?><em class="text-muted">@example.com</em></td>
                        <td class="d-none d-sm-table-cell">
                            <?php $one->get_tag(); ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group">
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Edit">
                                    <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-primary" data-toggle="tooltip" title="Delete">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Partial Table -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
