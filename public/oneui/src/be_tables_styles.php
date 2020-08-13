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
                Table Styles <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Multiple style options to match your preferences.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Styles</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <div class="row">
        <div class="col-xl-6">
            <!-- Default Table -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Default Table</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <code>.table</code>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i < 7; $i++) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo $i; ?></th>
                                <td class="font-w600 font-size-sm">
                                    <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <?php $one->get_tag(); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
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
            <!-- END Default Table -->
        </div>
        <div class="col-xl-6">
            <!-- Striped Table -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Striped Table</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <code>.table-striped</code>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i < 7; $i++) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo $i; ?></th>
                                <td class="font-w600 font-size-sm">
                                    <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <?php $one->get_tag(); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
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
            <!-- END Striped Table -->
        </div>
        <div class="col-xl-6">
            <!-- Hover Table -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Hover Table</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <code>.table-hover</code>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-hover table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i < 7; $i++) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo $i; ?></th>
                                <td class="font-w600 font-size-sm">
                                    <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <?php $one->get_tag(); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
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
            <!-- END Hover Table -->
        </div>
        <div class="col-xl-6">
            <!-- Bordered Table -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Bordered Table</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <code>.table-bordered</code>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-bordered table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i < 7; $i++) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo $i; ?></th>
                                <td class="font-w600 font-size-sm">
                                    <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <?php $one->get_tag(); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
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
            <!-- END Bordered Table -->
        </div>
        <div class="col-xl-6">
            <!-- Borderless Table -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Borderless Table</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <code>.table-borderless</code>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-borderless table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i < 7; $i++) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo $i; ?></th>
                                <td class="font-w600 font-size-sm">
                                    <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <?php $one->get_tag(); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
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
            <!-- END Borderless Table -->
        </div>
        <div class="col-xl-6">
            <!-- Small Table -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Small Table</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <code>.table-sm</code>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-sm table-vcenter">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i < 9; $i++) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo $i; ?></th>
                                <td class="font-w600 font-size-sm">
                                    <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <?php $one->get_tag(); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
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
            <!-- END Small Table -->
        </div>
        <div class="col-xl-6">
            <!-- Table Head Light -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Table Head Light</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <code>.thead-light</code>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-vcenter">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i < 7; $i++) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo $i; ?></th>
                                <td class="font-w600 font-size-sm">
                                    <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <?php $one->get_tag(); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
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
            <!-- END Table Head Light -->
        </div>
        <div class="col-xl-6">
            <!-- Table Head Dark -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Table Head Dark</h3>
                    <div class="block-options">
                        <div class="block-options-item">
                            <code>.thead-dark</code>
                        </div>
                    </div>
                </div>
                <div class="block-content">
                    <table class="table table-vcenter">
                        <thead class="thead-dark">
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th class="d-none d-sm-table-cell" style="width: 15%;">Access</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($i = 1; $i < 7; $i++) { ?>
                            <tr>
                                <th class="text-center" scope="row"><?php echo $i; ?></th>
                                <td class="font-w600 font-size-sm">
                                    <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a>
                                </td>
                                <td class="d-none d-sm-table-cell">
                                    <?php $one->get_tag(); ?>
                                </td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
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
            <!-- END Table Head Dark -->
        </div>
        <div class="col-12">
            <!-- Contextual Table -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Contextual Table</h3>
                </div>
                <div class="block-content">
                    <table class="table table-borderless table-vcenter table-hover">
                        <thead>
                            <tr>
                                <th class="text-center" style="width: 50px;">#</th>
                                <th>Name</th>
                                <th class="text-center" style="width: 100px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-active">
                                <th class="text-center" scope="row">1</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">2</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="table-primary">
                                <th class="text-center" scope="row">3</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">4</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="table-warning">
                                <th class="text-center" scope="row">5</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">6</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="table-danger">
                                <th class="text-center" scope="row">7</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">8</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="table-info">
                                <th class="text-center" scope="row">9</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th class="text-center" scope="row">10</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr class="table-success">
                                <th class="text-center" scope="row">11</th>
                                <td class="font-w600 font-size-sm"><?php $one->get_name(); ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Edit Client">
                                            <i class="fa fa-fw fa-pencil-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-light" data-toggle="tooltip" title="Remove Client">
                                            <i class="fa fa-fw fa-times"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Contextual Table -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
