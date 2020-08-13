<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>

<!-- Page JS Plugins CSS -->
<?php $one->get_css('js/plugins/highlightjs/styles/github-gist.css'); ?>

<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero Content -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/various/promo-code.png');">
    <div class="bg-primary-dark-op">
        <div class="content content-full overflow-hidden">
            <div class="mt-7 mb-5 text-center">
                <h1 class="h2 text-white mb-2 invisible" data-toggle="appear" data-class="animated fadeInDown">Learn HTML5 in 10 simple and easy to follow steps</h1>
                <h2 class="h4 font-w400 text-white-75 invisible" data-toggle="appear" data-class="animated fadeInDown">10 Lessons &bull; 3 hours</h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero Content -->

<!-- Navigation -->
<div class="bg-white">
    <div class="content content-boxed py-1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-alt">
                <li class="breadcrumb-item">
                    <a class="link-fx text-dark" href="be_pages_elearning_courses.php">Courses</a>
                </li>
                <li class="breadcrumb-item">
                    <a class="link-fx text-dark" href="be_pages_elearning_course.php">Learn HTML5</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">
                    <a class="link-fx" href="">1.1 HTML5 Intro</a>
                </li>
            </ol>
        </nav>
    </div>
</div>
<!-- END Navigation -->

<!-- Page Content -->
<div class="content content-boxed">
    <p class="alert alert-success text-center">
        <i class="fa fa-gift mr-1"></i> This is a free preview! If you like it, you can subscribe or purchase this course for only $4!
    </p>
    <div class="row">
        <div class="col-xl-8">
            <!-- Lesson -->
            <!-- Syntax Highlighting functionality is initialized in Helpers.highlightjs() -->
            <!-- For more info and examples you can check out https://highlightjs.org/usage/ -->
            <div class="block block-rounded">
                <div class="block-content">
                    <h3>1.1 HTML5 Intro (free preview)</h3>
                    <?php echo $one->get_text('medium', 1); ?>
                    <pre class="push"><code class="html">&lt;!doctype html&gt;
&lt;html&gt;
    &lt;head&gt;
        &lt;meta charset=&quot;utf-8&quot;&gt;

        &lt;title&gt;Title&lt;/title&gt;
    &lt;/head&gt;
    &lt;body&gt;
        &lt;!-- Your content --&gt;
    &lt;/body&gt;
&lt;/html&gt;</code></pre>
                    <?php echo $one->get_text('medium', 1); ?>
                    <div class="alert alert-warning text-center">
                        <i class="fa fa-exclamation-triangle mr-1"></i> This is an attention message.
                    </div>
                    <?php echo $one->get_text('medium', 1); ?>
                    <pre class="push"><code class="html">&lt;div id=&quot;id-name&quot; class=&quot;class-name&quot;&gt;
    &lt;!-- This is a comment --&gt;
&lt;/div&gt;</code></pre>
                    <p class="font-w600">Things to do:</p>
                    <ul class="fa-ul list list-simple-mini push">
                        <li>
                            <i class="fa fa-check fa-li text-success"></i>
                            Make sure you are always closing your tags.
                        </li>
                        <li>
                            <i class="fa fa-check fa-li text-success"></i>
                            Keep writing markup to become more familiar.
                        </li>
                        <li>
                            <i class="fa fa-check fa-li text-success"></i>
                            Create your own projects.
                        </li>
                    </ul>
                    <p class="alert alert-success text-center">
                        <i class="fa fa-thumbs-up mr-1"></i> Congrats! Let's head up to the next lesson.
                    </p>
                </div>
            </div>
            <!-- END Lesson -->
        </div>
        <div class="col-xl-4">
            <!-- Subscribe -->
            <div class="block block-rounded">
                <div class="block-content">
                    <a class="btn btn-block btn-rounded btn-success mb-2" href="javascript:void(0)">Subscribe from $9/month</a>
                    <p class="font-size-sm text-center">
                        or <a class="link-effect" href="javascript:void(0)">buy this course for $4</a>
                    </p>
                    <a class="btn btn-block btn-primary disabled push" href="javascript:void(0)">
                        <i class="fa fa-download mr-1"></i> Download
                    </a>
                </div>
            </div>
            <!-- END Subscribe -->

            <!-- Course Info -->
            <div class="block block-rounded">
                <div class="block-header block-header-default text-center">
                    <h3 class="block-title">About This Course</h3>
                </div>
                <div class="block-content">
                    <table class="table table-striped table-borderless font-size-sm">
                        <tbody>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-book mr-1"></i> 10 Lessons
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-clock mr-1"></i> 3 hours
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-heart mr-1"></i> 16850 Favorites
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-calendar mr-1"></i> 3 weeks ago
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <i class="fa fa-fw fa-tags mr-1"></i>
                                    <a class="badge badge-primary" href="javascript:void(0)">HTML</a>
                                    <a class="badge badge-primary" href="javascript:void(0)">CSS</a>
                                    <a class="badge badge-primary" href="javascript:void(0)">JavaScript</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END Course Info -->

            <!-- About Instructor -->
            <a class="block block-rounded block-link-shadow" href="javascript:void(0)">
                <div class="block-header block-header-default text-center">
                    <h3 class="block-title">About The Instructor</h3>
                </div>
                <div class="block-content block-content-full text-center">
                    <div class="push">
                        <?php $one->get_avatar('', 'male'); ?>
                    </div>
                    <div class="font-w600 mb-1"><?php $one->get_name('male'); ?></div>
                    <div class="font-size-sm text-muted">Front-end Developer</div>
                </div>
            </a>
            <!-- END About Instructor -->
        </div>
    </div>
</div>
<!-- END Page Content -->

<!-- Get Started -->
<div class="bg-body-dark">
    <div class="content content-full">
        <div class="my-5 text-center">
            <h3 class="h4 mb-4 invisible" data-toggle="appear">Subscribe today and learn HTML5 in under 3 hours.</h3>
            <a class="btn btn-rounded btn-success px-4 py-2 invisible" data-toggle="appear" data-class="animated bounceIn" href="javascript:void(0)">Subscribe from $9/month</a>
        </div>
    </div>
</div>
<!-- END Get Started -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>

<!-- Page JS Plugins -->
<?php $one->get_js('js/plugins/highlightjs/highlight.pack.min.js'); ?>

<!-- Page JS Helpers (Highlight.js Plugin) -->
<script>jQuery(function(){ One.helpers('highlightjs'); });</script>

<?php require 'inc/_global/views/footer_end.php'; ?>
