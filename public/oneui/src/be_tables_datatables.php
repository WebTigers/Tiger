<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/datatables/dataTables.bootstrap4.css'); ?>
<?php $one->get_css('js/plugins/datatables/buttons-bs4/buttons.bootstrap4.min.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                DataTables <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Tables transformed with dynamic features.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">DataTables</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Dynamic Table Full -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Dynamic Table <small>Full</small></h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                        <th style="width: 15%;">Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i < 41; $i++) { ?>
                    <tr>
                        <td class="text-center font-size-sm"><?php echo $i; ?></td>
                        <td class="font-w600 font-size-sm">
                            <a href="be_pages_generic_blank.php"><?php $one->get_name(); ?></a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            client<?php echo $i; ?><em class="text-muted">@example.com</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <?php $one->get_tag(); ?>
                        </td>
                        <td>
                            <em class="text-muted font-size-sm"><?php echo rand(2, 10); ?> days ago</em>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full -->

    <!-- Dynamic Table Full Pagination -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Dynamic Table <small>Full pagination</small></h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-full-pagination class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-full-pagination">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                        <th style="width: 15%;">Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i < 41; $i++) { ?>
                    <tr>
                        <td class="text-center font-size-sm"><?php echo $i; ?></td>
                        <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            client<?php echo $i; ?><em class="text-muted">@example.com</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <?php $one->get_tag(); ?>
                        </td>
                        <td>
                            <em class="text-muted font-size-sm"><?php echo rand(2, 10); ?> days ago</em>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Full Pagination -->

    <!-- Dynamic Table Simple -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Dynamic Table <small>With only sorting and pagination</small></h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-simple class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-simple">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                        <th style="width: 15%;">Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i < 41; $i++) { ?>
                    <tr>
                        <td class="text-center font-size-sm"><?php echo $i; ?></td>
                        <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            client<?php echo $i; ?><em class="text-muted">@example.com</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <?php $one->get_tag(); ?>
                        </td>
                        <td>
                            <em class="text-muted font-size-sm"><?php echo rand(2, 10); ?> days ago</em>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table Simple -->

    <!-- Dynamic Table with Export Buttons -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Dynamic Table <small>Export Buttons</small></h3>
        </div>
        <div class="block-content block-content-full">
            <!-- DataTables init on table by adding .js-dataTable-buttons class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _es6/pages/be_tables_datatables.js -->
            <table class="table table-bordered table-striped table-vcenter js-dataTable-buttons">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;">ID</th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 30%;">Email</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                        <th style="width: 15%;">Registered</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i < 41; $i++) { ?>
                    <tr>
                        <td class="text-center font-size-sm"><?php echo $i; ?></td>
                        <td class="font-w600 font-size-sm">
                            <a href="be_pages_generic_blank.php"><?php $one->get_name(); ?></a>
                        </td>
                        <td class="d-none d-sm-table-cell font-size-sm">
                            client<?php echo $i; ?><em class="text-muted">@example.com</em>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <?php $one->get_tag(); ?>
                        </td>
                        <td>
                            <em class="text-muted font-size-sm"><?php echo rand(2, 10); ?> days ago</em>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Dynamic Table with Export Buttons -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/datatables/jquery.dataTables.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/dataTables.bootstrap4.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/dataTables.buttons.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.print.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.html5.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.flash.min.js'); ?>
<?php $one->get_js('js/plugins/datatables/buttons/buttons.colVis.min.js'); ?>

<!-- Page JS Code -->
<?php $one->get_js('js/pages/be_tables_datatables.min.js'); ?>

<?php require 'inc/_global/views/footer_end.php'; ?>
