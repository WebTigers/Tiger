<?php require 'inc/_global/config.php'; ?>
<?php
// Page specific configuration
$one->l_m_content = 'boxed';
?>
<?php require 'inc/_global/views/head_start.php'; ?>
<?php require 'inc/_global/views/head_end.php'; ?>
<?php require 'inc/_global/views/page_start.php'; ?>

<!-- Hero -->
<div class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo36@2x.jpg');">
    <div class="hero bg-black-75 overflow-hidden">
        <div class="hero-inner">
            <div class="content content-full text-center">
                <div class="mb-5 invisible" data-toggle="appear" data-class="animated fadeInDown">
                    <i class="fa fa-circle-notch fa-3x text-primary"></i>
                </div>
                <h1 class="display-4 font-w600 mb-3 text-white invisible" data-toggle="appear" data-class="animated fadeInDown">
                    OneUI <span class="font-w300"><?php echo $one->version; ?> Remastered</span>
                </h1>
                <h2 class="h3 font-w400 text-white-50 mb-5 invisible" data-toggle="appear" data-class="animated fadeInDown" data-timeout="300">
                    Build your next idea with one super flexible UI framework. Reimagined and rebuilt for super modern projects.
                </h2>
                <span class="m-2 d-inline-block invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="600">
                    <a class="btn btn-success px-4 py-2" data-toggle="click-ripple" href="https://1.envato.market/AVD6j">
                        <i class="fa fa-fw fa-shopping-cart mr-1"></i> Purchase
                    </a>
                </span>
                <span class="m-2 d-inline-block invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="600">
                    <a class="btn btn-primary px-4 py-2" data-toggle="click-ripple" href="be_pages_dashboard.php">
                        <i class="fa fa-fw fa-rocket mr-1"></i> Live Preview
                    </a>
                </span>
            </div>
        </div>
        <div class="hero-meta">
            <div class="animated slideInDown infinite">
                <i class="fa fa-angle-down text-white-50 fa-2x"></i>
            </div>
        </div>
    </div>
</div>
<!-- END Hero -->

<!-- Vue Edition -->
<div id="one-vue-edition" class="bg-white">
    <div class="content content-full">
        <div class="py-5 text-center">
            <h2 class="h1 mb-2">
                OneUI Vue Edition
            </h2>
            <h3 class="font-w400 text-muted mb-5">
                The pure Vue.js version is now included as a free update in the package!
            </h3>
            <div class="row justify-content-center">
                <div class="col-sm-6 col-xl-5 invisible" data-toggle="appear">
                    <a href="https://1.envato.market/5Noyb" class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="py-4">
                                <i class="fab fa-4x fa-vuejs text-success"></i>
                            </div>
                            <h4 class="mb-2">OneUI Vue Edition</h4>
                            <p class="font-size-sm text-muted text-left">
                                A pure Vue.js version created from scratch and based on the design of OneUI Remastered. It is a super flexible Bootstrap dashboard template and was built with Vue CLI, Vue Router, Vuex and BootstrapVue. You can also purchase it separately if you are interested only in this version.
                            </p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Vue Edition -->

<!-- Versions -->
<div id="one-versions" class="bg-light">
    <div class="content content-full">
        <div class="py-5 text-center">
            <h2 class="h1 mb-2">
                OneUI <?php echo $one->version; ?> Versions
            </h2>
            <h3 class="font-w400 text-muted mb-5">
                Inside the package you will find a Get Started version, an HTML version, a PHP version and a Laravel Starter Kit.
            </h3>
            <div class="row row-deck">
                <div class="col-sm-6 col-xl-3 invisible" data-toggle="appear">
                    <!-- Get Started Version -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="py-4">
                                <i class="fa fa-4x fa-burn text-modern"></i>
                            </div>
                            <h4 class="mb-2">Get Started Version</h4>
                            <p class="font-size-sm text-muted text-left">
                                A production ready version with boilerplate pages featuring RTL examples pages as well. It will help you rocket start your project.
                            </p>
                        </div>
                    </div>
                    <!-- END Get Started Version -->
                </div>
                <div class="col-sm-6 col-xl-3 invisible" data-toggle="appear">
                    <!-- HTML Version -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="py-4">
                                <i class="fab fa-4x fa-html5 text-city"></i>
                            </div>
                            <h4 class="mb-2">HTML Version</h4>
                            <p class="font-size-sm text-muted text-left">
                                The abstract HTML version. This version can be used with any server side language/framework you prefer or currently working with.
                            </p>
                        </div>
                    </div>
                    <!-- END HTML Version -->
                </div>
                <div class="col-sm-6 col-xl-3 invisible" data-toggle="appear">
                    <!-- PHP Version -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="py-4">
                                <i class="fab fa-4x fa-php text-amethyst"></i>
                            </div>
                            <h4 class="mb-2">PHP Version</h4>
                            <p class="font-size-sm text-muted text-left">
                                The abstract PHP version. This version can come really handy as a starting point if you would like to build a custom PHP application.
                            </p>
                        </div>
                    </div>
                    <!-- END PHP Version -->
                </div>
                <div class="col-sm-6 col-xl-3 invisible" data-toggle="appear">
                    <!-- Laravel Starter Kit -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="py-4">
                                <i class="fab fa-4x fa-laravel text-city"></i>
                            </div>
                            <h4 class="mb-2">Laravel Starter Kit</h4>
                            <p class="font-size-sm text-muted text-left">
                                It features a clean Laravel installation with all OneUI assets ready to work with Laravel Mix and a few example pages to get you started.
                            </p>
                        </div>
                    </div>
                    <!-- END Laravel Starter Kit -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Versions -->

<!-- Remastered -->
<div id="one-remastered" class="bg-white">
    <div class="content content-full">
        <div class="py-5 text-center">
            <h2 class="h1 mb-2">
                Remastered
            </h2>
            <h3 class="font-w400 text-muted mb-5">
                OneUI <?php echo $one->version; ?> was carefully crafted for your new projects using the latest tech.
            </h3>
            <div class="row row-deck">
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- Bootstrap 4 -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-amethyst-lighter mx-auto my-4">
                                <i class="fa fa-2x fa-fire text-amethyst"></i>
                            </div>
                            <h4 class="mb-2">Bootstrap 4</h4>
                            <p class="font-size-sm text-muted text-left">
                                The latest Bootstrap version now powers OneUI <?php echo $one->version; ?> framework. Flexbox support and tons of new features are ready for you to use.
                            </p>
                        </div>
                    </div>
                    <!-- END Bootstrap 4 -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- Sass -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-danger-light mx-auto my-4">
                                <i class="fab fa-2x fa-sass text-danger"></i>
                            </div>
                            <h4 class="mb-2">Sass</h4>
                            <p class="font-size-sm text-muted text-left">
                                OneUI <?php echo $one->version; ?> was built with Sass, overriding and extending Bootstrap in an intelligent way to ensure a perfect and modular workflow.
                            </p>
                        </div>
                    </div>
                    <!-- END Sass -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- ES6 -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-warning-light mx-auto my-4">
                                <span class="font-w700 text-warning">ES6</span>
                            </div>
                            <h4 class="mb-2">ECMAScript 6</h4>
                            <p class="font-size-sm text-muted text-left">
                                OneUI <?php echo $one->version; ?> was built with ES6, the new major JavaScript release which enables us writing cleaner and better code.
                            </p>
                        </div>
                    </div>
                    <!-- END ES6 -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- FontAwesome 5 -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-flat-lighter mx-auto my-4">
                                <i class="fab fa-2x fa-font-awesome text-flat"></i>
                            </div>
                            <h4 class="mb-2">FontAwesome 5</h4>
                            <p class="font-size-sm text-muted text-left">
                                OneUI <?php echo $one->version; ?> comes packed with the latest Font Awesome version, bringing you over 1300 freshly made icons for your projects.
                            </p>
                        </div>
                    </div>
                    <!-- END FontAwesome 5 -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- Gulp -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-city-lighter mx-auto my-4">
                                <i class="fab fa-2x fa-gulp text-city"></i>
                            </div>
                            <h4 class="mb-2">Gulp 4</h4>
                            <p class="font-size-sm text-muted text-left">
                                We created smart development tasks to help you focus on your projects. Just install the npm dependencies and use them out of the box.
                            </p>
                        </div>
                    </div>
                    <!-- END Gulp -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- webpack -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-default-lighter mx-auto my-4">
                                <i class="fa fa-2x fa-boxes text-default"></i>
                            </div>
                            <h4 class="mb-2">webpack + Babel</h4>
                            <p class="font-size-sm text-muted text-left">
                                Babel makes your JavaScript code compatible with older browsers and webpack bundles your JavaScript files together.
                            </p>
                        </div>
                    </div>
                    <!-- END webpack -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- Browsersync -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-modern-lighter mx-auto my-4">
                                <i class="fab fa-2x fa-chrome text-modern"></i>
                            </div>
                            <h4 class="mb-2">Browsersync</h4>
                            <p class="font-size-sm text-muted text-left">
                                It will serve and sync your project across different browsers and also refresh them each time your save your files.
                            </p>
                        </div>
                    </div>
                    <!-- END Browsersync -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- Autoprefixer -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-smooth-lighter mx-auto my-4">
                                <i class="fab fa-2x fa-autoprefixer text-smooth"></i>
                            </div>
                            <h4 class="mb-2">Autoprefixer</h4>
                            <p class="font-size-sm text-muted text-left">
                                Peace of mind when working with Sass. Use the latest CSS syntax and Autoprefixer will auto add any required prefixes for older browsers.
                            </p>
                        </div>
                    </div>
                    <!-- END Autoprefixer -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- Modular Approach -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-gray-light mx-auto my-4">
                                <i class="fa fa-2x fa-truck-loading text-dark"></i>
                            </div>
                            <h4 class="mb-2">Modular Approach</h4>
                            <p class="font-size-sm text-muted text-left">
                                You can add your JavaScript or Sass overrides/customizations without altering the original files, making the update process an easy one.
                            </p>
                        </div>
                    </div>
                    <!-- END Modular Approach -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- Improved Design -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-info-light mx-auto my-4">
                                <i class="fa fa-2x fa-brush text-info"></i>
                            </div>
                            <h4 class="mb-2">Improved Design</h4>
                            <p class="font-size-sm text-muted text-left">
                                Small touches and improvements were introduced throughout the template. From colors to layout and fom custom elements to plugins.
                            </p>
                        </div>
                    </div>
                    <!-- END Improved Design -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- New Features -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-success-light mx-auto my-4">
                                <i class="fa fa-2x fa-smile-wink text-success"></i>
                            </div>
                            <h4 class="mb-2">New Features</h4>
                            <p class="font-size-sm text-muted text-left">
                                Dark header, light sidebar, flexbox based layout, page overlay, header search and even more features are now available.
                            </p>
                        </div>
                    </div>
                    <!-- END New Features -->
                </div>
                <div class="col-sm-6 col-md-4 col-xl-3 invisible" data-toggle="appear">
                    <!-- New Features -->
                    <div class="block block-rounded block-fx-pop">
                        <div class="block-content block-content-full">
                            <div class="item item-rounded bg-warning-light mx-auto my-4">
                                <i class="fa fa-2x fa-star text-warning"></i>
                            </div>
                            <h4 class="mb-2">Free Update</h4>
                            <p class="font-size-sm text-muted text-left">
                                We love our customers, so we are giving the Remastered version away as a free update to all existing ones! Thank you all for your support!
                            </p>
                        </div>
                    </div>
                    <!-- END New Features -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Remastered -->

<!-- Reviews -->
<div id="one-reviews" class="bg-image" style="background-image: url('<?php echo $one->assets_folder; ?>/media/photos/photo36@2x.jpg');">
    <div class="bg-black-75">
        <div class="content content-full">
            <div class="py-5">
                <h2 class="h1 text-white mb-2 text-center">
                    Customer Reviews
                </h2>
                <h3 class="font-w400 text-white-50 mb-5 text-center">
                    Check out what our customers have written about OneUI that made the Remastered version a reality.
                </h3>
                <div class="row items-push-2x">
                    <div class="col-md-4 invisible" data-toggle="appear">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">A combination of flexibility and ease of use. The design is beautiful, but I really value the ease in which I was able to integrate this into my development workflow and platform.</div>
                        <div class="font-size-sm text-white-75">For Other by <em>appeality</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="150">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">While reading the docs i can feel that you literally gave your heart to create this project. It is a high quality piece of work, thanks for sharing it!</div>
                        <div class="font-size-sm text-white-75">For Code Quality by <em>msagi</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="300">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">This is my first purchase on Themeforest and I am delighted. Everything from the design to the code is beautifully crafted and the customer support is great also. Congratulations pixelcave.</div>
                        <div class="font-size-sm text-white-75">For Customizability by <em>CaravelaThemes</em></div>
                    </div>
                </div>
                <div class="row items-push-2x">
                    <div class="col-md-4 invisible" data-toggle="appear">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">One of the most well thought-through and comprehensive Themeforest templates available. Consistently excellent design and broad feature base. Highly Recommended!</div>
                        <div class="font-size-sm text-white-75">For Feature Availability by <em>stephenhird</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="150">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">One of the best paid for downloads I have ever made. Has so many features which have all been designed and put together absolutely brilliantly.</div>
                        <div class="font-size-sm text-white-75">For Design Quality by <em>weblid</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="300">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">This is hands down the best template I have ever come across. It has absolutely everything you need right there laid out and easy to find. I couldn't recommend this template enough!</div>
                        <div class="font-size-sm text-white-75">For Feature Availability by <em>dhowa021</em></div>
                    </div>
                </div>
                <div class="row items-push-2x">
                    <div class="col-md-4 invisible" data-toggle="appear">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">After using this Admin template for 6 months...we are still delighted. This template has everything. It has obviously been designed with much care and detail. Very intuitive, Easy to use. And we're still finding functionality that we hadn't discovered before. Well done to the developer and thanks for putting your heart-and-soul into this template.</div>
                        <div class="font-size-sm text-white-75">For Other by <em>conorhannah</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="150">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">Easily the best admin template you can find.</div>
                        <div class="font-size-sm text-white-75">For Code Quality by <em>nozebra_dk</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="300">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">I have spent two days researching admin themes. There are a couple of really good ones out there, but this one came out at the very top for me. Looks great, on both desktop and mobile, the feature set is amazing, the documentation looks very good. I haven't started implementing yet, but this deserves five stars already.</div>
                        <div class="font-size-sm text-white-75">For Design Quality by <em>dvartok</em></div>
                    </div>
                </div>
                <div class="row items-push-2x">
                    <div class="col-md-4 invisible" data-toggle="appear">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">This is one of the best all-around packages I've purchased from ThemeForest. Not only is the Documentation is excellent and well-written, but the code itself is intelligently built and a pleasure to work with. Thanks for doing such great work.</div>
                        <div class="font-size-sm text-white-75">For Other by <em>rshaffaf</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="150">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">This is the best UI I have ever came across, this UI theme is absolutely perfect in Every Way :) Really happy with the purchase.</div>
                        <div class="font-size-sm text-white-75">For Other by <em>spmtumblr</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="300">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">The best admin template ever, no doubt of it!!</div>
                        <div class="font-size-sm text-white-75">For Other by <em>kaladrian</em></div>
                    </div>
                </div>
                <div class="row items-push-2x">
                    <div class="col-md-4 invisible" data-toggle="appear">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">Everything's perfect! Good design! Best performance I've ever use! And the best thing, fastest support I've seen! 5 star satisfaction!</div>
                        <div class="font-size-sm text-white-75">For Customer Support by <em>arkheacol04</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="150">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">This is an amazing, multi purpose, and very well designed and structured template. I rarely write a review but this template deserves the support. It is distinguished.</div>
                        <div class="font-size-sm text-white-75">For Design Quality by <em>maa83</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="300">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">Long story short: I really enjoy using the templates made by pixelcave. The code is very flexible and well structured, the documentation is very good - everything you need.</div>
                        <div class="font-size-sm text-white-75">For Code Quality by <em>Master_rg</em></div>
                    </div>
                </div>
                <div class="row items-push-2x mb-20-t">
                    <div class="col-md-4 invisible" data-toggle="appear">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">It's awesome, not only the design is marvelous, the code and documentation helps easy customization.</div>
                        <div class="font-size-sm text-white-75">For Design Quality by <em>alperaydyn2</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="150">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">Awesome !!! Thanks for a so great template !!</div>
                        <div class="font-size-sm text-white-75">For Feature Availability by <em>Markuitos</em></div>
                    </div>
                    <div class="col-md-4 invisible" data-toggle="appear" data-timeout="300">
                        <div class="text-warning my-3">
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                            <i class="fa fa-fw fa-star"></i>
                        </div>
                        <div class="text-white-50 mb-2">Awesome code, works really well, well documented!</div>
                        <div class="font-size-sm text-white-75">For Flexibility by <em>corverdevelopment</em></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END Reviews -->

<!-- Call To Action -->
<div id="one-call-to-action" class="bg-white">
    <div class="content content-full">
        <div class="py-5 py-md-8 text-center">
            <h2 class="mb-2 invisible" data-toggle="appear" data-class="animated fadeInDown">
                Crafted with <i class="fa fa-fw fa-heart text-danger"></i> by <a class="link-fx text-danger" href="https://1.envato.market/ydb">pixelcave</a>
            </h2>
            <h3 class="font-w400 text-muted mb-4 invisible" data-toggle="appear" data-class="animated fadeInDown" data-timeout="300">
                Passionate web design and development with over 13.000 customers worldwide.
            </h3>
            <span class="m-2 d-inline-block invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="600">
                <a class="btn btn-alt-success px-4 py-2" data-toggle="click-ripple" href="https://1.envato.market/AVD6j">
                    <i class="fa fa-fw fa-shopping-cart mr-1"></i> Purchase
                </a>
            </span>
            <span class="m-2 d-inline-block invisible" data-toggle="appear" data-class="animated fadeInUp" data-timeout="600">
                <a class="btn btn-alt-primary px-4 py-2" data-toggle="click-ripple" href="be_pages_dashboard.php">
                    <i class="fa fa-fw fa-rocket mr-1"></i> Live Preview
                </a>
            </span>
        </div>
    </div>
</div>
<!-- END Call To Action -->

<!-- Footer -->
<footer id="page-footer" class="bg-light">
    <div class="content py-5">
        <div class="row font-size-sm">
            <div class="col-sm-6 order-sm-2 py-1 text-center text-sm-right">
                Crafted with <i class="fa fa-heart text-danger"></i> by <a class="font-w600" href="https://1.envato.market/ydb" target="_blank">pixelcave</a>
            </div>
            <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
                <a class="font-w600" href="https://1.envato.market/AVD6j" target="_blank"><?php echo $one->name . ' ' . $one->version; ?></a> &copy; <span data-toggle="year-copy"></span>
            </div>
        </div>
    </div>
</footer>
<!-- END Footer -->

<?php require 'inc/_global/views/page_end.php'; ?>
<?php require 'inc/_global/views/footer_start.php'; ?>
<?php require 'inc/_global/views/footer_end.php'; ?>
