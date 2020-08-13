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
                Welcome to the forums
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">
                        <a class="link-fx text-dark" href="be_pages_forum_categories.php">Forum</a>
                    </li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Home</a>
                    </li>
                </ol>
            </nav>
        </div>
   </div>
</div>
<!-- END Hero -->

<!-- Page Content -->
<div class="content">
    <!-- Categories -->
    <div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Categories</h3>
            <div class="block-options">
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="fullscreen_toggle"></button>
                <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                    <i class="si si-refresh"></i>
                </button>
            </div>
        </div>
        <div class="block-content">
            <!-- Intro Category -->
            <table class="table table-striped table-borderless table-vcenter push">
                <thead class="border-bottom">
                    <tr>
                        <th colspan="2">Introduction</th>
                        <th class="d-none d-md-table-cell text-center" style="width: 90px;">Topics</th>
                        <th class="d-none d-md-table-cell text-center" style="width: 90px;">Posts</th>
                        <th class="d-none d-md-table-cell" style="width: 180px;">Last Post</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" style="width: 70px;">
                            <i class="si si-check fa-2x"></i>
                        </td>
                        <td>
                            <a class="font-size-h5 font-w600" href="be_pages_forum_topics.php">Welcome</a>
                            <div class="font-size-sm text-muted mt-1">Introduce yourself to our community</div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(100, 1000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(3000, 10000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">by <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a><br>on <em>May 23, 2019</em></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <i class="si si-bell fa-2x"></i>
                        </td>
                        <td>
                            <a class="font-size-h5 font-w600" href="be_pages_forum_topics.php">Announcements</a>
                            <div class="font-size-sm text-muted mt-1">For all recent news</div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(100, 1000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(3000, 10000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">by <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a><br>on <em>May 15, 2019</em></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <i class="si si-badge fa-2x"></i>
                        </td>
                        <td>
                            <a class="font-size-h5 font-w600" href="be_pages_forum_topics.php">Terms &amp; Conditions</a>
                            <div class="font-size-sm text-muted mt-1">Please read and comply with our forum’s rules</div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(100, 1000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(3000, 10000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">by <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a><br>on <em>May 21, 2019</em></span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- END Intro Category -->

            <!-- Web App Category -->
            <table class="table table-striped table-borderless table-vcenter push">
                <thead class="border-bottom">
                    <tr>
                        <th colspan="2">Web App</th>
                        <th class="d-none d-md-table-cell text-center" style="width: 90px;">Topics</th>
                        <th class="d-none d-md-table-cell text-center" style="width: 90px;">Posts</th>
                        <th class="d-none d-md-table-cell" style="width: 180px;">Last Post</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" style="width: 70px;">
                            <i class="si si-cursor fa-2x"></i>
                        </td>
                        <td>
                            <a class="font-size-h5 font-w600" href="be_pages_forum_topics.php">Getting Started</a>
                            <div class="font-size-sm text-muted mt-1">If you are a new user, here you will find everything you need</div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(100, 1000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(3000, 10000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">by <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a><br>on <em>May 17, 2019</em></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <i class="si si-docs fa-2x"></i>
                        </td>
                        <td>
                            <a class="font-size-h5 font-w600" href="be_pages_forum_topics.php">Tutorials</a>
                            <div class="font-size-sm text-muted mt-1">The best place to learn new stuff</div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(100, 1000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(3000, 10000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">by <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a><br>on <em>May 23, 2019</em></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <i class="si si-settings fa-2x"></i>
                        </td>
                        <td>
                            <a class="font-size-h5 font-w600" href="be_pages_forum_topics.php">Plugins</a>
                            <div class="font-size-sm text-muted mt-1">Creating or looking for an existing plugin?</div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(100, 1000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(3000, 10000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">by <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a><br>on <em>May 22, 2019</em></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <i class="si si-wrench fa-2x"></i>
                        </td>
                        <td>
                            <a class="font-size-h5 font-w600" href="be_pages_forum_topics.php">API</a>
                            <div class="font-size-sm text-muted mt-1">Take advantage of our powerful API</div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(100, 1000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(3000, 10000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">by <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a><br>on <em>May 17, 2019</em></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <i class="si si-chemistry fa-2x"></i>
                        </td>
                        <td>
                            <a class="font-size-h5 font-w600" href="be_pages_forum_topics.php">Extentions</a>
                            <div class="font-size-sm text-muted mt-1">Extend our web application’s features</div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(100, 1000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(3000, 10000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">by <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a><br>on <em>May 13, 2019</em></span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- END Web App Category -->

            <!-- Support Category -->
            <table class="table table-striped table-borderless table-vcenter push">
                <thead class="border-bottom">
                    <tr>
                        <th colspan="2">Support</th>
                        <th class="d-none d-md-table-cell text-center" style="width: 90px;">Topics</th>
                        <th class="d-none d-md-table-cell text-center" style="width: 90px;">Posts</th>
                        <th class="d-none d-md-table-cell" style="width: 180px;">Last Post</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center" style="width: 70px;">
                            <i class="si si-info fa-2x"></i>
                        </td>
                        <td>
                            <a class="font-size-h5 font-w600" href="be_pages_forum_topics.php">Questions</a>
                            <div class="font-size-sm text-muted mt-1">Need assistance? Don’t worry, we are here to help</div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(100, 1000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(3000, 10000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">by <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a><br>on <em>May 20, 2019</em></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <i class="si si-question fa-2x"></i>
                        </td>
                        <td>
                            <a class="font-size-h5 font-w600" href="be_pages_forum_topics.php">Playground</a>
                            <div class="font-size-sm text-muted mt-1">Discuss with other users</div>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(100, 1000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell text-center">
                            <a class="font-w600" href="javascript:void(0)"><?php echo rand(3000, 10000); ?></a>
                        </td>
                        <td class="d-none d-md-table-cell">
                            <span class="font-size-sm">by <a href="be_pages_generic_profile.php"><?php $one->get_name(); ?></a><br>on <em>May 24, 2019</em></span>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- END Support Category -->
        </div>
    </div>
    <!-- END Categories -->
</div>
<!-- END Page Content -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
