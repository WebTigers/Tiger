<?php require 'inc/_global/config.php'; ?>
<?php require 'inc/backend/config.php'; ?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero Content -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo24@2x.jpg');">
    <div class="bg-primary-dark-op">
        <div class="content content-full overflow-hidden">
            <div class="mt-7 mb-5 text-center">
                <h1 class="h2 text-white mb-2 invisible" data-toggle="appear" data-class="animated fadeInDown">The latest stories only for you.</h1>
                <h2 class="h4 font-w400 text-white-75 invisible" data-toggle="appear" data-class="animated fadeInDown">Feel free to explore and read.</h2>
            </div>
        </div>
    </div>
</div>
<!-- END Hero Content -->

<!-- Page Content -->
<div class="content content-boxed">
    <div class="row">
        <!-- Story -->
        <div class="col-lg-4 invisible" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
            <a class="block block-link-pop" href="be_pages_blog_story.php">
                <?php $one->get_photo(21, true, 'img-fluid'); ?>
                <div class="block-content">
                    <h4 class="mb-1">Top 10 Destinations</h4>
                    <p class="font-size-sm">
                        <span class="text-primary"><?php $one->get_name(); ?></span> on July 16, 2019 · <em class="text-muted">10 min</em>
                    </p>
                    <p class="font-size-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida...
                    </p>
                </div>
            </a>
        </div>
        <!-- END Story -->

        <!-- Story -->
        <div class="col-lg-4 invisible" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
            <a class="block block-link-pop" href="be_pages_blog_story.php">
                <?php $one->get_photo(22, true, 'img-fluid'); ?>
                <div class="block-content">
                    <h4 class="mb-1">Follow Your Dreams</h4>
                    <p class="font-size-sm">
                        <span class="text-primary"><?php $one->get_name(); ?></span> on July 13, 2019 · <em class="text-muted">15 min</em>
                    </p>
                    <p class="font-size-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida...
                    </p>
                </div>
            </a>
        </div>
        <!-- END Story -->

        <!-- Story -->
        <div class="col-lg-4 invisible" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
            <a class="block block-link-pop" href="be_pages_blog_story.php">
                <?php $one->get_photo(23, true, 'img-fluid'); ?>
                <div class="block-content">
                    <h4 class="mb-1">Travel &amp; Work</h4>
                    <p class="font-size-sm">
                        <span class="text-primary"><?php $one->get_name(); ?></span> on July 6, 2019 · <em class="text-muted">12 min</em>
                    </p>
                    <p class="font-size-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida...
                    </p>
                </div>
            </a>
        </div>
        <!-- END Story -->

        <!-- Story -->
        <div class="col-lg-4 invisible" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
            <a class="block block-link-pop" href="be_pages_blog_story.php">
                <?php $one->get_photo(24, true, 'img-fluid'); ?>
                <div class="block-content">
                    <h4 class="mb-1">Sleep Better</h4>
                    <p class="font-size-sm">
                        <span class="text-primary"><?php $one->get_name(); ?></span> on July 21, 2019 · <em class="text-muted">9 min</em>
                    </p>
                    <p class="font-size-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida...
                    </p>
                </div>
            </a>
        </div>
        <!-- END Story -->

        <!-- Story -->
        <div class="col-lg-4 invisible" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
            <a class="block block-link-pop" href="be_pages_blog_story.php">
                <?php $one->get_photo(4, true, 'img-fluid'); ?>
                <div class="block-content">
                    <h4 class="mb-1">Black &amp; White</h4>
                    <p class="font-size-sm">
                        <span class="text-primary"><?php $one->get_name(); ?></span> on July 16, 2019 · <em class="text-muted">5 min</em>
                    </p>
                    <p class="font-size-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida...
                    </p>
                </div>
            </a>
        </div>
        <!-- END Story -->

        <!-- Story -->
        <div class="col-lg-4 invisible" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
            <a class="block block-link-pop" href="be_pages_blog_story.php">
                <?php $one->get_photo(6, true, 'img-fluid'); ?>
                <div class="block-content">
                    <h4 class="mb-1">Exploring the Alps</h4>
                    <p class="font-size-sm">
                        <span class="text-primary"><?php $one->get_name(); ?></span> on July 1, 2019 · <em class="text-muted">3 min</em>
                    </p>
                    <p class="font-size-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida...
                    </p>
                </div>
            </a>
        </div>
        <!-- END Story -->

        <!-- Story -->
        <div class="col-lg-4 invisible" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
            <a class="block block-link-pop" href="be_pages_blog_story.php">
                <?php $one->get_photo(7, true, 'img-fluid'); ?>
                <div class="block-content">
                    <h4 class="mb-1">Explore the World</h4>
                    <p class="font-size-sm">
                        <span class="text-primary"><?php $one->get_name(); ?></span> on May 19, 2019 · <em class="text-muted">9 min</em>
                    </p>
                    <p class="font-size-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida...
                    </p>
                </div>
            </a>
        </div>
        <!-- END Story -->

        <!-- Story -->
        <div class="col-lg-4 invisible" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
            <a class="block block-link-pop" href="be_pages_blog_story.php">
                <?php $one->get_photo(8, true, 'img-fluid'); ?>
                <div class="block-content">
                    <h4 class="mb-1">Meet Paris</h4>
                    <p class="font-size-sm">
                        <span class="text-primary"><?php $one->get_name(); ?></span> on May 10, 2019 · <em class="text-muted">14 min</em>
                    </p>
                    <p class="font-size-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida...
                    </p>
                </div>
            </a>
        </div>
        <!-- END Story -->

        <!-- Story -->
        <div class="col-lg-4 invisible" data-toggle="appear" data-offset="50" data-class="animated fadeIn">
            <a class="block block-link-pop" href="be_pages_blog_story.php">
                <?php $one->get_photo(9, true, 'img-fluid'); ?>
                <div class="block-content">
                    <h4 class="mb-1">The Secret Treasure</h4>
                    <p class="font-size-sm">
                        <span class="text-primary"><?php $one->get_name(); ?></span> on May 2, 2019 · <em class="text-muted">20 min</em>
                    </p>
                    <p class="font-size-sm">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas ultrices, justo vel imperdiet gravida...
                    </p>
                </div>
            </a>
        </div>
        <!-- END Story -->
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center push">
            <li class="page-item active">
                <a class="page-link" href="javascript:void(0)">1</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)">2</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)">3</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)">4</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)">5</a>
            </li>
            <li class="page-item">
                <a class="page-link" href="javascript:void(0)" aria-label="Next">
                    <span aria-hidden="true">
                        <i class="fa fa-angle-right"></i>
                    </span>
                    <span class="sr-only">Next</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- END Pagination -->
</div>
<!-- END Page Content -->

<!-- Get Started -->
<div class="bg-body-dark">
    <div class="content content-full">
        <div class="my-5 text-center">
            <h3 class="h4 mb-4 invisible" data-toggle="appear">Do you like our stories? Sign up today and get access to over <strong>10.000</strong> travel stories!</h3>
            <a class="btn btn-rounded btn-success px-4 py-2 invisible" data-toggle="appear" data-class="animated bounceIn" href="javascript:void(0)">Get Started Today</a>
        </div>
    </div>
</div>
<!-- END Get Started -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
