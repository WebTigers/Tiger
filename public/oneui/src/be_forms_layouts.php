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
                Form Layouts <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Multiple layouts to match any design requirement.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Layouts</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Inline -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Inline</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        Using an inline layout can come really handy for small forms
                    </p>
                </div>
                <div class="col-lg-8">
                    <!-- Form Inline - Default Style -->
                    <form class="form-inline mb-4" action="be_forms_layouts.php" method="POST" onsubmit="return false;">
                        <label class="sr-only" for="example-if-email">Email</label>
                        <input type="email" class="form-control mb-2 mr-sm-2 mb-sm-0" id="example-if-email" name="example-if-email" placeholder="Email">
                        <label class="sr-only" for="example-if-password">Password</label>
                        <input type="password" class="form-control mb-2 mr-sm-2 mb-sm-0" id="example-if-password" name="example-if-password" placeholder="Password">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                    <!-- END Form Inline - Default Style -->

                    <!-- Form Inline - Alternative Style -->
                    <form class="form-inline" action="be_forms_layouts.php" method="POST" onsubmit="return false;">
                        <label class="sr-only" for="example-if-email2">Email</label>
                        <input type="email" class="form-control form-control-alt mb-2 mr-sm-2 mb-sm-0" id="example-if-email2" name="example-if-email2" placeholder="Email">
                        <label class="sr-only" for="example-if-password2">Password</label>
                        <input type="password" class="form-control form-control-alt mb-2 mr-sm-2 mb-sm-0" id="example-if-password2" name="example-if-password2" placeholder="Password">
                        <button type="submit" class="btn btn-dark">Login</button>
                    </form>
                    <!-- END Form Inline - Alternative Style -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Inline -->

    <!-- Labels on top -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Labels on top</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        An often used layout which is very easy to create with minimal markup
                    </p>
                </div>
                <div class="col-lg-8">
                    <!-- Form Labels on top - Default Style -->
                    <form class="mb-5" action="be_forms_layouts.php" method="POST" onsubmit="return false;">
                        <div class="form-group">
                            <label for="example-ltf-email">Email</label>
                            <input type="email" class="form-control" id="example-ltf-email" name="example-ltf-email" placeholder="Your Email..">
                        </div>
                        <div class="form-group">
                            <label for="example-ltf-password">Password</label>
                            <input type="password" class="form-control" id="example-ltf-password" name="example-ltf-password" placeholder="Your Password..">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                    <!-- END Form Labels on top - Default Style -->

                    <!-- Form Labels on top - Alternative Style -->
                    <form action="be_forms_layouts.php" method="POST" onsubmit="return false;">
                        <div class="form-group">
                            <label for="example-ltf-email2">Email</label>
                            <input type="email" class="form-control form-control-alt" id="example-ltf-email2" name="example-ltf-email2" placeholder="Your Email..">
                        </div>
                        <div class="form-group">
                            <label for="example-ltf-password2">Password</label>
                            <input type="password" class="form-control form-control-alt" id="example-ltf-password2" name="example-ltf-password2" placeholder="Your Password..">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-dark">Login</button>
                        </div>
                    </form>
                    <!-- END Form Labels on top - Alternative Style -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Labels on top -->

    <!-- Horizontal -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Horizontal</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        A horizontal layout is perfect for bigger forms
                    </p>
                </div>
                <div class="col-lg-8">
                    <!-- Form Horizontal - Default Style -->
                    <form class="mb-5" action="be_forms_layouts.php" method="POST" onsubmit="return false;">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control" id="example-hf-email" name="example-hf-email" placeholder="Your Email..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="example-hf-password">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="example-hf-password" name="example-hf-password" placeholder="Your Password..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 ml-auto">
                                <button type="submit" class="btn btn-primary">Login</button>
                            </div>
                        </div>
                    </form>
                    <!-- END Form Horizontal - Default Style -->

                    <!-- Form Horizontal - Alternative Style -->
                    <form action="be_forms_layouts.php" method="POST" onsubmit="return false;">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="example-hf-email2">Email</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control form-control-alt" id="example-hf-email2" name="example-hf-email2" placeholder="Your Email..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label" for="example-hf-password2">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control form-control-alt" id="example-hf-password2" name="example-hf-password2" placeholder="Your Password..">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-8 ml-auto">
                                <button type="submit" class="btn btn-dark">Login</button>
                            </div>
                        </div>
                    </form>
                    <!-- END Form Horizontal - Alternative Style -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Horizontal -->

    <!-- Grid Based -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Grid Based</h3>
        </div>
        <div class="block-content block-content-full">
            <div class="row push">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        Using the form grid you can create any input layout you could possibly imagine
                    </p>
                </div>
                <div class="col-lg-8">
                    <!-- Form Grid -->
                    <form action="be_forms_layouts.php" method="POST" onsubmit="return false;">
                        <div class="form-group form-row">
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="col-4">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="col-4">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="col-4">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="col-4">
                            </div>
                            <div class="col-8">
                                <input type="text" class="form-control" placeholder="col-8">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-5">
                                <input type="text" class="form-control" placeholder="col-5">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control" placeholder="col-4">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control" placeholder="col-3">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-3">
                                <input type="text" class="form-control form-control-alt" placeholder="col-3">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control form-control-alt" placeholder="col-3">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control form-control-alt" placeholder="col-3">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control form-control-alt" placeholder="col-3">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-8">
                                <input type="text" class="form-control form-control-alt" placeholder="col-8">
                            </div>
                            <div class="col-4">
                                <input type="text" class="form-control form-control-alt" placeholder="col-4">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-3">
                                <input type="text" class="form-control form-control-alt" placeholder="col-3">
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control form-control-alt" placeholder="col-6">
                            </div>
                            <div class="col-3">
                                <input type="text" class="form-control form-control-alt" placeholder="col-3">
                            </div>
                        </div>
                    </form>
                    <!-- END Form Grid -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <p class="font-size-sm text-muted">
                        You could also include labels
                    </p>
                </div>
                <div class="col-lg-8">
                    <!-- Form Grid with Labels -->
                    <form action="be_forms_layouts.php" method="POST" onsubmit="return false;">
                        <div class="form-group form-row">
                            <div class="col-4">
                                <label>.col-4</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-4">
                                <label>.col-4</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-4">
                                <label>.col-4</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-4">
                                <label>.col-4</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-8">
                                <label>.col-8</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-5">
                                <label>.col-5</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-4">
                                <label>.col-4</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-3">
                                <label>.col-3</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-3">
                                <label>.col-3</label>
                                <input type="text" class="form-control form-control-alt">
                            </div>
                            <div class="col-3">
                                <label>.col-3</label>
                                <input type="text" class="form-control form-control-alt">
                            </div>
                            <div class="col-3">
                                <label>.col-3</label>
                                <input type="text" class="form-control form-control-alt">
                            </div>
                            <div class="col-3">
                                <label>.col-3</label>
                                <input type="text" class="form-control form-control-alt">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-8">
                                <label>.col-8</label>
                                <input type="text" class="form-control form-control-alt">
                            </div>
                            <div class="col-4">
                                <label>.col-4</label>
                                <input type="text" class="form-control form-control-alt">
                            </div>
                        </div>
                        <div class="form-group form-row">
                            <div class="col-3">
                                <label>.col-3</label>
                                <input type="text" class="form-control form-control-alt">
                            </div>
                            <div class="col-6">
                                <label>.col-6</label>
                                <input type="text" class="form-control form-control-alt">
                            </div>
                            <div class="col-3">
                                <label>.col-3</label>
                                <input type="text" class="form-control form-control-alt">
                            </div>
                        </div>
                    </form>
                    <!-- END Form Grid with Labels -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Grid Based -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
