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
                Typography <small class="d-block d-sm-inline-block mt-2 mt-sm-0 font-size-base font-w400 text-muted">Good Typography not only looks good but also reinforces the meaning of the content.</small>
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Elements</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Typography</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Headings -->
    <h2 class="content-heading">Headings</h2>
    <div class="row">
        <div class="col-lg-6">
            <!-- Bold -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Bold <small>(600 - Default)</small></h3>
                </div>
                <div class="block-content">
                    <h1>h1. Title <small>Subtitle</small></h1>
                    <h2>h2. Title <small>Subtitle</small></h2>
                    <h3>h3. Title <small>Subtitle</small></h3>
                    <h4>h4. Title <small>Subtitle</small></h4>
                    <h5>h5. Title <small>Subtitle</small></h5>
                </div>
            </div>
            <!-- END Bold -->
        </div>
        <div class="col-lg-6">
            <!-- Extra Bold -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Extra Bold <small>(700)</small></h3>
                </div>
                <div class="block-content">
                    <h1 class="font-w700">h1. Title <small>Subtitle</small></h1>
                    <h2 class="font-w700">h2. Title <small>Subtitle</small></h2>
                    <h3 class="font-w700">h3. Title <small>Subtitle</small></h3>
                    <h4 class="font-w700">h4. Title <small>Subtitle</small></h4>
                    <h5 class="font-w700">h5. Title <small>Subtitle</small></h5>
                </div>
            </div>
            <!-- END Extra Bold -->
        </div>
        <div class="col-lg-6">
            <!-- Normal -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Normal <small>(400)</small></h3>
                </div>
                <div class="block-content">
                    <h1 class="font-w400">h1. Title <small>Subtitle</small></h1>
                    <h2 class="font-w400">h2. Title <small>Subtitle</small></h2>
                    <h3 class="font-w400">h3. Title <small>Subtitle</small></h3>
                    <h4 class="font-w400">h4. Title <small>Subtitle</small></h4>
                    <h5 class="font-w400">h5. Title <small>Subtitle</small></h5>
                </div>
            </div>
            <!-- END Normal -->
        </div>
        <div class="col-lg-6">
            <!-- Light -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Light <small>(300)</small></h3>
                </div>
                <div class="block-content">
                    <h1 class="font-w300">h1. Title <small>Subtitle</small></h1>
                    <h2 class="font-w300">h2. Title <small>Subtitle</small></h2>
                    <h3 class="font-w300">h3. Title <small>Subtitle</small></h3>
                    <h4 class="font-w300">h4. Title <small>Subtitle</small></h4>
                    <h5 class="font-w300">h5. Title <small>Subtitle</small></h5>
                </div>
            </div>
            <!-- END Light -->
        </div>
        <div class="col-12">
            <!-- Hero Headings -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Headings</h3>
                </div>
                <div class="block-content block-content-full">
                    <div class="row">
                        <div class="col-lg-6">
                            <h2 class="display-1"><span class="d-none d-sm-inline-block">Title</span> Display 1</h2>
                            <h2 class="display-2"><span class="d-none d-sm-inline-block">Title</span> Display 2</h2>
                        </div>
                        <div class="col-lg-6">
                            <h2 class="display-3"><span class="d-none d-sm-inline-block">Title</span> Display 3</h2>
                            <h2 class="display-4"><span class="d-none d-sm-inline-block">Title</span> Display 4</h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END Hero Headings -->
        </div>
    </div>
    <!-- END Headings -->

    <!-- Typography -->
    <h2 class="content-heading">Typography</h2>

    <!-- Badges Styles -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Badges</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-md-6">
                    <h3 class="h4">Default</h3>
                    <p>
                        <span class="badge badge-secondary">Default</span>
                        <span class="badge badge-primary">Primary</span>
                        <span class="badge badge-success">Success</span>
                        <span class="badge badge-info">Info</span>
                        <span class="badge badge-warning">Warning</span>
                        <span class="badge badge-danger">Danger</span>
                    </p>
                    <p>
                        <span class="badge badge-secondary"><i class="fa fa-home"></i> Home</span>
                        <span class="badge badge-primary"><i class="fa fa-cog"></i> Settings</span>
                        <span class="badge badge-success"><i class="fa fa-check"></i> Great!</span>
                        <span class="badge badge-info"><i class="fa fa-info-circle"></i> More Info</span>
                        <span class="badge badge-warning"><i class="fa fa-exclamation-circle"></i> Attention</span>
                        <span class="badge badge-danger"><i class="fa fa-times-circle"></i> Error</span>
                    </p>
                </div>
                <div class="col-md-6">
                    <h3 class="h4">Pills</h3>
                    <p>
                        <span class="badge badge-pill badge-secondary">Default</span>
                        <span class="badge badge-pill badge-primary">Primary</span>
                        <span class="badge badge-pill badge-success">Success</span>
                        <span class="badge badge-pill badge-info">Info</span>
                        <span class="badge badge-pill badge-warning">Warning</span>
                        <span class="badge badge-pill badge-danger">Danger</span>
                    </p>
                    <p>
                        <span class="badge badge-pill badge-secondary"><i class="fa fa-fw fa-home"></i> Home</span>
                        <span class="badge badge-pill badge-primary"><i class="fa fa-fw fa-cog"></i> Settings</span>
                        <span class="badge badge-pill badge-success"><i class="fa fa-fw fa-check"></i> Great!</span>
                        <span class="badge badge-pill badge-info"><i class="fa fa-fw fa-info-circle"></i> More Info</span>
                        <span class="badge badge-pill badge-warning"><i class="fa fa-fw fa-exclamation-circle"></i> Attention</span>
                        <span class="badge badge-pill badge-danger"><i class="fa fa-fw fa-times-circle"></i> Error</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- END Badges Styles -->

    <!-- Text -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Text</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-xl-6">
                    <p>The following snippet of text is <strong>rendered as bold text</strong>.</p>
                    <p>The following snippet of text is <em>rendered as italicized text</em>.</p>
                </div>
                <div class="col-xl-6">
                    <p>You can use the mark tag to <mark>highlight</mark> text.</p>
                    <p><del>This line of text is meant to be treated as deleted text.</del></p>
                </div>
            </div>
        </div>
    </div>
    <!-- END Text -->

    <!-- Links -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Links</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-md-4">
                    <p>
                        <a href="javascript:void(0)">Default link</a>
                    </p>
                    <p>
                        <a class="text-success" href="javascript:void(0)">Success link</a>
                    </p>
                    <p>
                        <a class="text-info" href="javascript:void(0)">Info link</a>
                    </p>
                    <p>
                        <a class="text-warning" href="javascript:void(0)">Warning link</a>
                    </p>
                    <p>
                        <a class="text-danger" href="javascript:void(0)">Danger link</a>
                    </p>
                </div>
                <div class="col-md-4">
                    <p>
                        <a class="link-fx" href="javascript:void(0)">Link with effect</a>
                    </p>
                    <p>
                        <a class="link-fx text-success" href="javascript:void(0)">Success link with effect</a>
                    </p>
                    <p>
                        <a class="link-fx text-info" href="javascript:void(0)">Info link with effect</a>
                    </p>
                    <p>
                        <a class="link-fx text-warning" href="javascript:void(0)">Warning link with effect</a>
                    </p>
                    <p>
                        <a class="link-fx text-danger" href="javascript:void(0)">Danger link with effect</a>
                    </p>
                </div>
                <div class="col-md-4">

                    <p>
                        <a class="badge badge-primary" href="javascript:void(0)">Badge link</a>
                    </p>
                    <p>
                        <a class="badge badge-success" href="javascript:void(0)">Success Badge link</a>
                    </p>
                    <p>
                        <a class="badge badge-info" href="javascript:void(0)">Info Badge link</a>
                    </p>
                    <p>
                        <a class="badge badge-warning" href="javascript:void(0)">Warning Badge link</a>
                    </p>
                    <p>
                        <a class="badge badge-danger" href="javascript:void(0)">Danger Badge link</a>
                    </p>

                </div>
            </div>
        </div>
    </div>
    <!-- END Links -->

    <!-- Contextual Colors -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Contextual Colors</h3>
        </div>
        <div class="block-content">
            <div class="row">
                <div class="col-sm-4">
                    <p class="text-success">This text has the success color..</p>
                    <p class="text-info">This text has the info color..</p>
                    <p class="text-warning">This text has the warning color..</p>
                    <p class="text-danger">This text has the danger color..</p>
                    <p class="text-muted">This text has the muted color..</p>
                </div>
                <div class="col-sm-4">
                    <p class="text-primary-darker">This text has the primary darker color..</p>
                    <p class="text-primary-dark">This text has the primary dark color..</p>
                    <p class="text-primary">This text has the primary color ..</p>
                    <p class="text-primary-light">This text has the primary light color..</p>
                    <p class="text-primary-lighter">This text has the primary lighter color..</p>
                </div>
                <div class="col-sm-4">
                    <p class="text-gray-darker">This text has the gray darker color..</p>
                    <p class="text-gray-dark">This text has the gray dark color..</p>
                    <p class="text-gray">This text has the gray color ..</p>
                    <p class="text-gray-light">This text has the gray light color..</p>
                    <p class="text-gray-lighter">This text has the gray lighter color..</p>
                </div>
            </div>
        </div>
    </div>
    <!-- END Contextual Colors -->

    <!-- Lists -->
    <div class="block">
        <div class="block-header">
            <div class="block-title">Lists</div>
        </div>
        <div class="block-content">
            <div class="row items-push">
                <div class="col-lg-3">
                    <h3>Unordered List</h3>
                    <ul>
                        <li>First item</li>
                        <li>Second item</li>
                        <li>
                            Sublist
                            <ul>
                                <li>First subitem</li>
                                <li>Second subitem</li>
                                <li>Third subitem</li>
                            </ul>
                        </li>
                        <li>Third item</li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h3>Ordered List</h3>
                    <ol>
                        <li>First item</li>
                        <li>Second item</li>
                        <li>
                            Sublist
                            <ol>
                                <li>First subitem</li>
                                <li>Second subitem</li>
                                <li>Third subitem</li>
                            </ol>
                        </li>
                        <li>Third item</li>
                    </ol>
                </div>
                <div class="col-lg-3">
                    <h3>Icon List</h3>
                    <ul class="fa-ul">
                        <li>
                            <span class="fa-li">
                                <i class="fa fa-arrow-right"></i>
                            </span>
                            First item
                        </li>
                        <li>
                            <span class="fa-li">
                                <i class="fa fa-arrow-right"></i>
                            </span>
                            Second item
                        </li>
                        <li>
                            <span class="fa-li">
                                <i class="fa fa-arrow-right"></i>
                            </span>
                            Sublist
                            <ul class="fa-ul">
                                <li>
                                    <span class="fa-li">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                                    First subitem
                                </li>
                                <li>
                                    <span class="fa-li">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                                    Second subitem
                                </li>
                                <li>
                                    <span class="fa-li">
                                        <i class="fa fa-angle-right"></i>
                                    </span>
                                    Second subitem
                                </li>
                            </ul>
                        </li>
                        <li>
                            <span class="fa-li">
                                <i class="fa fa-arrow-right"></i>
                            </span>
                            Third item
                        </li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h3>Unstyled List</h3>
                    <ul class="list-unstyled">
                        <li>First item</li>
                        <li>Second item</li>
                        <li>
                            Sublist
                            <ul>
                                <li>First subitem</li>
                                <li>Second subitem</li>
                                <li>Third subitem</li>
                            </ul>
                        </li>
                        <li>Third item</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END Lists -->

    <!-- Contextual Backgrounds -->
    <div class="block">
        <div class="block-header">
            <h3 class="block-title">Contextual Backgrounds</h3>
        </div>
        <div class="block-content">
            <div class="row text-white font-w600">
                <div class="col-md">
                    <p class="p-3 bg-success">Success</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-info">Info</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-warning">Warning</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-danger">Danger</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-muted">Muted</p>
                </div>
            </div>
            <div class="row text-white font-w600">
                <div class="col-md">
                    <p class="p-3 bg-success-light text-success">Success Light</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-info-light text-info">Info Light</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-warning-light text-warning">Warning Light</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-danger-light text-danger">Danger Light</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-gray-light text-gray-darker">Muted Light</p>
                </div>
            </div>
            <div class="row text-white font-w600">
                <div class="col-md">
                    <p class="p-3 bg-primary-darker">Darker</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-primary-dark">Dark</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-primary">Primary</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-primary-light">Light</p>
                </div>
                <div class="col-md">
                    <p class="p-3 bg-primary-lighter">Lighter</p>
                </div>
            </div>
        </div>
    </div>
    <!-- END Contextual Backgrounds -->

    <!-- Extras -->
    <div class="row row-deck">
        <div class="col-md-6">
            <!-- Blockquotes -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Blockquotes</h3>
                </div>
                <div class="block-content">
                    <blockquote class="blockquote">
                        <p class="mb-0">Be yourself; everyone else is already taken.</p>
                        <footer class="blockquote-footer">Oscar Wilde</footer>
                    </blockquote>
                    <blockquote class="blockquote text-right">
                        <p class="mb-0">Don't cry because it's over, smile because it happened.</p>
                        <footer class="blockquote-footer">Dr. Seuss</footer>
                    </blockquote>
                </div>
            </div>
            <!-- END Blockquotes -->
        </div>
        <div class="col-md-6">
            <!-- Addresses -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Addresses</h3>
                </div>
                <div class="block-content">
                    <address>
                        <strong>Twitter, Inc.</strong><br>
                        795 Folsom Ave, Suite 600<br>
                        San Francisco, CA 94107<br>
                        <abbr title="Phone">P:</abbr> (123) 456-7890
                    </address>
                    <address>
                        <strong>Full Name</strong><br>
                        <a href="mailto:#">first.last@example.com</a>
                    </address>
                </div>
            </div>
            <!-- END Addresses -->
        </div>
    </div>
    <!-- END Extras -->
    <!-- END Typography -->

    <!-- Paragraphs -->
    <h2 class="content-heading">Paragraphs</h2>
    <div class="row row-deck">
        <div class="col-md-4">
            <!-- Lead -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Lead</h3>
                </div>
                <div class="block-content">
                    <p class="lead">This is a lead paragraph. You can use it you highlight your main point before your article. It is great for such usage.</p>
                </div>
            </div>
            <!-- END Lead -->
        </div>
        <div class="col-md-8">
            <!-- Normal -->
            <div class="block">
                <div class="block-header">
                    <h3 class="block-title">Normal</h3>
                </div>
                <div class="block-content">
                    <?php $one->get_text('medium', 2); ?>
                </div>
            </div>
            <!-- END Normal -->
        </div>
    </div>
    <!-- END Paragraphs -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
