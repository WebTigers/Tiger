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
                Input Groups <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Enrich your form inputs with buttons and extra text content.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Input Groups</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- With Text -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">With Text</h3>
        </div>
        <div class="block-content block-content-full">
            <form action="be_forms_input_groups.php" method="POST" onsubmit="return false;">
                <div class="row">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Prepend or Append Text next to your inputs, useful if you you would like to add extra info
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        Name
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="example-group1-input1" name="example-group1-input1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control" id="example-group1-input2" name="example-group1-input2">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        Email
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        $
                                    </span>
                                </div>
                                <input type="text" class="form-control text-center" id="example-group1-input3" name="example-group1-input3" placeholder="00">
                                <div class="input-group-append">
                                    <span class="input-group-text">,00</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-alt">
                                        Name
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-alt" id="example-group1-input1-alt" name="example-group1-input1-alt">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control form-control-alt" id="example-group1-input2-alt" name="example-group1-input2-alt">
                                <div class="input-group-append">
                                    <span class="input-group-text input-group-text-alt">
                                        Email
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-alt">
                                        $
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-alt text-center" id="example-group1-input3-alt" name="example-group1-input3-alt" placeholder="00">
                                <div class="input-group-append">
                                    <span class="input-group-text input-group-text-alt">,00</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END With Text -->

    <!-- With Icons -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">With Icons</h3>
        </div>
        <div class="block-content block-content-full">
            <form action="be_forms_input_groups.php" method="POST" onsubmit="return false;">
                <div class="row">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Prepend or Append Icons next to your inputs to visualize the context
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="far fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" id="example-group2-input1" name="example-group2-input1">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control" id="example-group2-input2" name="example-group2-input2">
                                <div class="input-group-append">
                                    <span class="input-group-text">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="fa fa-euro-sign"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control text-center" id="example-group2-input3" name="example-group2-input3" placeholder="..">
                                <div class="input-group-append">
                                    <span class="input-group-text">.00</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-alt">
                                        <i class="far fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-alt" id="example-group2-input1-alt" name="example-group2-input1-alt">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control form-control-alt" id="example-group2-input2-alt" name="example-group2-input2-alt">
                                <div class="input-group-append">
                                    <span class="input-group-text input-group-text-alt">
                                        <i class="far fa-envelope"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-group-text-alt">
                                        <i class="fa fa-euro-sign"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control form-control-alt text-center" id="example-group2-input3-alt" name="example-group2-input3-alt" placeholder="..">
                                <div class="input-group-append">
                                    <span class="input-group-text input-group-text-alt">
                                        <i class="si si-wallet"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END With Icons -->

    <!-- With Buttons -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">With Buttons</h3>
        </div>
        <div class="block-content block-content-full">
            <form action="be_forms_input_groups.php" method="POST" onsubmit="return false;">
                <div class="row">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Prepend or Append Buttons next to your inputs to add related actions
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-search mr-1"></i> Search
                                    </button>
                                </div>
                                <input type="text" class="form-control" id="example-group3-input1" name="example-group3-input1" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control" id="example-group3-input2" name="example-group3-input2" placeholder="Email">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-dark">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control" id="example-group3-input3" name="example-group3-input3" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info">
                                        <i class="fab fa-twitter"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fa fa-search mr-1"></i> Search
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-alt" id="example-group3-input1-alt" name="example-group3-input1-alt" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control form-control-alt" id="example-group3-input2-alt" name="example-group3-input2-alt" placeholder="Email">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-dark">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-alt" id="example-group3-input3-alt" name="example-group3-input3-alt" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info">
                                        <i class="fab fa-twitter"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-alt-primary">
                                        <i class="fa fa-search mr-1"></i> Search
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-alt" id="example-group3-input1-alt2" name="example-group3-input1-alt2" placeholder="Name">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control form-control-alt" id="example-group3-input2-alt2" name="example-group3-input2-alt2" placeholder="Email">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-alt-dark">Submit</button>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-alt-primary">
                                        <i class="fab fa-facebook-f"></i>
                                    </button>
                                </div>
                                <input type="text" class="form-control form-control-alt" id="example-group3-input3-alt2" name="example-group3-input3-alt2" placeholder="Search">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-info">
                                        <i class="fab fa-twitter"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END With Buttons -->

    <!-- With Dropdowns -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">With Dropdowns</h3>
        </div>
        <div class="block-content block-content-full">
            <form action="be_forms_input_groups.php" method="POST" onsubmit="return false;">
                <div class="row">
                    <div class="col-lg-4">
                        <p class="font-size-sm text-muted">
                            Prepend or Append dropdowns next to your inputs
                        </p>
                    </div>
                    <div class="col-lg-8 col-xl-5">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary">Options</button>
                                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="example-group4-input1" name="example-group4-input1" placeholder="Name" aria-label="Text input with dropdown button">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control" id="example-group4-input2" name="example-group4-input2" placeholder="Email" aria-label="Text input with dropdown button">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                       <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend dropup">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                                <input type="text" class="form-control" id="example-group4-input3" name="example-group4-input3" placeholder=".." aria-label="Text input with dropdown button">
                                <div class="input-group-append dropup">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-dark">Options</button>
                                    <button type="button" class="btn btn-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                                <input type="text" class="form-control form-control-alt" id="example-group4-input1-alt" name="example-group4-input1-alt" placeholder="Name" aria-label="Text input with dropdown button">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control form-control-alt" id="example-group4-input2-alt" name="example-group4-input2-alt" placeholder="Email" aria-label="Text input with dropdown button">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                       <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend dropup">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                                <input type="text" class="form-control form-control-alt" id="example-group4-input3-alt" name="example-group4-input3-alt" placeholder=".." aria-label="Text input with dropdown button">
                                <div class="input-group-append dropup">
                                    <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-alt-primary">Options</button>
                                    <button type="button" class="btn btn-alt-primary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                                <input type="text" class="form-control form-control-alt" id="example-group4-input1-alt2" name="example-group4-input1-alt2" placeholder="Name" aria-label="Text input with dropdown button">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="email" class="form-control form-control-alt" id="example-group4-input2-alt2" name="example-group4-input2-alt2" placeholder="Email" aria-label="Text input with dropdown button">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-alt-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                       <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend dropup">
                                    <button type="button" class="btn btn-alt-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                                <input type="text" class="form-control form-control-alt" id="example-group4-input3-alt2" name="example-group4-input3-alt2" placeholder=".." aria-label="Text input with dropdown button">
                                <div class="input-group-append dropup">
                                    <button type="button" class="btn btn-alt-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-bell mr-1"></i> News
                                        </a>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="far fa-fw fa-envelope mr-1"></i> Messages
                                        </a>
                                        <div role="separator" class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="javascript:void(0)">
                                            <i class="fa fa-fw fa-pencil-alt mr-1"></i> Edit Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- END With Dropdowns -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
