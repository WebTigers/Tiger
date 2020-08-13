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
                Table Helpers <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Custom functionality to further enrich your tables.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Helpers</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Checkable Table (.js-table-checkable class is initialized in Helpers.tableToolsCheckable()) -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Checkable Table</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <code>.js-table-checkable</code>
                </div>
            </div>
        </div>
        <div class="block-content">
            <!-- If you put a checkbox in thead section, it will automatically toggle all tbody section checkboxes -->
            <table class="js-table-checkable table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 70px;">
                            <div class="custom-control custom-checkbox d-inline-block">
                                <input type="checkbox" class="custom-control-input" id="check-all" name="check-all">
                                <label class="custom-control-label" for="check-all"></label>
                            </div>
                        </th>
                        <th>Name</th>
                        <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php for ($i = 1; $i < 7; $i++) { ?>
                    <tr>
                        <td class="text-center">
                            <div class="custom-control custom-checkbox d-inline-block">
                                <input type="checkbox" class="custom-control-input" id="row_<?php echo $i; ?>" name="row_<?php echo $i; ?>">
                                <label class="custom-control-label" for="row_<?php echo $i; ?>"></label>
                            </div>
                        </td>
                        <td class="font-size-sm">
                            <p class="font-w600 mb-1">
                                <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a>
                            </p>
                            <p class="text-muted mb-0">
                                Customer details and further information
                            </p>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <?php $one->get_tag(); ?>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="font-size-sm text-muted">November <?php echo rand(1, 28); ?>, 2018 08:<?php echo rand(10, 59); ?></em>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <!-- END Checkable Table -->

    <!-- Table Sections (.js-table-sections class is initialized in Helpers.tableToolsSections()) -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Table Sections</h3>
            <div class="block-options">
                <div class="block-options-item">
                    <code>.js-table-sections</code>
                </div>
            </div>
        </div>
        <div class="block-content">
            <!--
            Separate your table content with multiple tbody sections. Add one row and add the class .js-table-sections-header to a
            tbody section to make it clickable. It will then toggle the next tbody section which can have multiple rows. Eg:

            <tbody class="js-table-sections-header">One row</tbody>
            <tbody>Multiple rows</tbody>
            <tbody class="js-table-sections-header">One row</tbody>
            <tbody>Multiple rows</tbody>
            <tbody class="js-table-sections-header">One row</tbody>
            <tbody>Multiple rows</tbody>

            You can also add the class .show in your tbody.js-table-sections-header to make the next tbody section visible by default
            -->
            <table class="js-table-sections table table-hover table-vcenter">
                <thead>
                    <tr>
                        <th style="width: 30px;"></th>
                        <th>Name</th>
                        <th style="width: 15%;">Access</th>
                        <th class="d-none d-sm-table-cell" style="width: 20%;">Date</th>
                    </tr>
                </thead>
                <?php for ($i = 1; $i < 7; $i++) { ?>
                <tbody class="js-table-sections-header<?php if ($i == 1) { echo ' show table-active'; } ?>">
                    <tr>
                        <td class="text-center">
                            <i class="fa fa-angle-right text-muted"></i>
                        </td>
                        <td class="font-w600 font-size-sm">
                            <div class="py-1">
                                <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a>
                            </div>
                        </td>
                        <td>
                            <?php $one->get_tag(); ?>
                        </td>
                        <td class="d-none d-sm-table-cell">
                            <em class="font-size-sm text-muted">November <?php echo rand(1, 28); ?>, 2018 08:<?php echo rand(10, 59); ?></em>
                        </td>
                    </tr>
                </tbody>
                <tbody class="font-size-sm">
                    <?php for ($j = 1; $j < 5; $j++) { ?>
                    <tr>
                        <td class="text-center"></td>
                        <td class="font-w600 font-size-sm">+ $<?php echo rand(100, 999); ?>,00</td>
                        <td colspan="2">
                            <i class="fab fa-paypal"></i>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <!-- END Table Sections -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Helpers (Table Tools helpers) -->
<script>jQuery(function(){ One.helpers(['table-tools-checkable', 'table-tools-sections']); });</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
