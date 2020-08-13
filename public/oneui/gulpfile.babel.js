import gulp from 'gulp';
import autoprefixer from 'autoprefixer';
import concat from 'gulp-concat';
import uglify from 'gulp-uglify';
import rename from 'gulp-rename';
import cleanCSS from 'gulp-clean-css';
import header from 'gulp-header';
import sass from 'gulp-sass';
import postcss from 'gulp-postcss';
import connectphp from 'gulp-connect-php';
import browserSync from 'browser-sync';
import del from 'del';
import webpack from 'webpack';
import gulpWebpack from 'webpack-stream';
import strip from 'gulp-strip-comments';
import named from 'vinyl-named';
import changed from 'gulp-changed';


////////////////////////////////////////////////////////////////////////////////////////////////
//
// SETTING UP
//
////////////////////////////////////////////////////////////////////////////////////////////////

// webpack Options
const webpackOptions = {
    development: {
        mode: 'development',
        module: {
            rules: [{
                    test: /\.js$/,
                    exclude: /(node_modules)/,
                    use: {
                        loader: 'babel-loader?cacheDirectory=true'
                    }
                }
            ]
        }
    },
    production: {
        mode: 'production',
        module: {
            rules: [{
                    test: /\.js$/,
                    exclude: /(node_modules)/,
                    use: {
                        loader: 'babel-loader?cacheDirectory=true'
                    }
                }
            ]
        }
    }
};

// Get info from package.json
const pkg = require('./package.json');
const pkgName = pkg.name.toLowerCase();
const pkgNameJSCore = pkgName + '.core';
const pkgNameJSMain = pkgName + '.app';

// Banner to be added at the top of the files
const banner = ['/*!',
    ` * ${pkg.name} - v${pkg.version}`,
    ` * @author ${pkg.author} - https://pixelcave.com`,
    ` * Copyright (c) ${new Date().getFullYear()}`,
    ' */',
    ''].join('\n');

// Directories and paths
const dir = {
    src: 'src/',
    build: 'dist/',
    assets: 'assets/'
};

const path = {
    dir: {
        src: dir.src,
        build: dir.build
    },
    src: {
        assets: dir.src + dir.assets,
        es6: dir.src + dir.assets + '_es6/',
        scss: dir.src + dir.assets + '_scss/',
        css: dir.src + dir.assets + 'css/',
        fonts: dir.src + dir.assets + 'fonts/',
        js: dir.src + dir.assets + 'js/',
        jscore: dir.src + dir.assets + 'js/core/',
        jsplugins: dir.src + dir.assets + 'js/plugins/',
        jspages: dir.src + dir.assets + 'js/pages/',
        media: dir.src + dir.assets + 'media/'
    },
    build: {
        assets: dir.build + dir.assets,
        css: dir.build + dir.assets + 'css/',
        fonts: dir.build + dir.assets + 'fonts/',
        js: dir.build + dir.assets + 'js/',
        jsplugins: dir.build + dir.assets + 'js/plugins/',
        jspages: dir.build + dir.assets + 'js/pages/',
        media: dir.build + dir.assets + 'media/'
    }
};

// Various file sources used in tasks
const files = {
    watch: {
        // When the following files are changed the server will reload
        server: [
            path.src.css + pkgName + '.min.css',
            path.src.js + pkgNameJSCore + '.min.js',
            path.src.js + pkgNameJSMain + '.min.js',
            path.src.jspages + '**/*.min.js',
            path.dir.src + '**/*.php',
            path.dir.src + '**/*.html'
        ],
        // SASS files to watch
        scss: path.src.scss + '**/*.scss',
        es6: {
            // JS main files to watch (ES6)
            main: path.src.es6 + 'main/**/*.js',
            // JS pages files to watch (ES6)
            pages: path.src.es6 + 'pages/**/*.js'
        }
    },
    src: {
        scss: {
            // SASS Main file
            main: path.src.scss + 'main.scss',
            // SASS Theme files
            themes: path.src.scss + pkgName + '/themes/*.scss'
        },
        css: {
            // CSS Main file
            main: path.src.css + pkgName + '.css',
            // CSS Theme files (excluding minified versions)
            themes: [
                path.src.css + 'themes/*.css',
                '!' + path.src.css + 'themes/*.min.css'
            ]
        },
        es6: {
            // JS Main entry file (ES6)
            main: path.src.es6 + 'main/app.js',
            // JS Pages files (ES6)
            pages: path.src.es6 + 'pages/**/*.js'
        },
        js: {
            // JS Core files to be merged together in that specific order
            coreFiles: [
                path.src.jscore + 'jquery.min.js',
                path.src.jscore + 'bootstrap.bundle.min.js',
                path.src.jscore + 'simplebar.min.js',
                path.src.jscore + 'jquery-scrollLock.min.js',
                path.src.jscore + 'jquery.appear.min.js',
                path.src.jscore + 'js.cookie.min.js'
            ],
            // JS Core file to be created including all JS Core files
            core: path.src.js + pkgNameJSCore + '*.min.js',
            // JS Main file to be created from ES6
            main: path.src.js + pkgNameJSMain + '*.min.js',
            // JS Pages files
            pages: [
                path.src.js + 'pages/**/*.min.js'
            ]
        }
    },
    build: {
        // Files to be copied over on build task
        copy: [
            path.src.css + '**/*.min.css',
            path.src.js + '*.min.js',
            path.src.jspages + '**/*.min.js',
            path.src.jsplugins + '**/*.*',
            path.src.fonts + '**/*.*',
            path.src.media + '**/*.*',
            path.dir.src + '**/*.php',
            path.dir.src + '**/*.html'
        ]
    }
};

// Dependencies to be copied over from node_modules
const dependencies = {
    scss: {
        bootstrap: {
            base: path.src.scss + 'bootstrap/',
            src: 'node_modules/bootstrap/scss/**/*',
            dest: path.src.scss + 'bootstrap/'
        },
        fontawesome: {
            base: path.src.scss + 'vendor/fontawesome/',
            src: 'node_modules/@fortawesome/fontawesome-free/scss/**/*',
            dest: path.src.scss + 'vendor/fontawesome/'
        }
    },
    fonts: {
        fontawesome: {
            base: path.src.fonts + 'fontawesome/',
            src: 'node_modules/@fortawesome/fontawesome-free/webfonts/**/*',
            dest: path.src.fonts + 'fontawesome/'
        }
    },
    js: {
        core: {
            jquery: {
                base: path.src.jscore + 'jquery.min.js',
                src: 'node_modules/jquery/dist/jquery.min.js',
                dest: path.src.jscore
            },
            bootstrap: {
                base: path.src.jscore + 'bootstrap.bundle.min.js',
                src: 'node_modules/bootstrap/dist/js/bootstrap.bundle.min.js',
                dest: path.src.jscore,
                minclean: true
            },
            simplebar: {
                base: path.src.jscore + 'simplebar.min.js',
                src: 'node_modules/simplebar/dist/simplebar.js',
                dest: path.src.jscore,
                min: true
            },
            'jquery-scroll-lock': {
                base: path.src.jscore + 'jquery-scrollLock.min.js',
                src: 'node_modules/jquery-scroll-lock/dist/jquery-scrollLock.min.js',
                dest: path.src.jscore,
                minclean: true
            },
            'jquery.appear': {
                base: path.src.jscore + 'jquery.appear.min.js',
                src: 'node_modules/jquery.appear/jquery.appear.js',
                dest: path.src.jscore,
                min: true
            },
            'js-cookie': {
                base: path.src.jscore + 'js.cookie.min.js',
                src: 'node_modules/js-cookie/src/js.cookie.js',
                dest: path.src.jscore,
                min: true
            }
        },
        plugins: {
            'bootstrap-colorpicker': {
                base: path.src.jsplugins + 'bootstrap-colorpicker/',
                src: 'node_modules/bootstrap-colorpicker/dist/**/*.*',
                dest: path.src.jsplugins + 'bootstrap-colorpicker/'
            },
            'bootstrap-datepicker': {
                base: path.src.jsplugins + 'bootstrap-datepicker/',
                src: 'node_modules/bootstrap-datepicker/dist/**/*.*',
                dest: path.src.jsplugins + 'bootstrap-datepicker/'
            },
            'bootstrap-maxlength': {
                base: path.src.jsplugins + 'bootstrap-maxlength/',
                src: 'node_modules/bootstrap-maxlength/bootstrap-maxlength*.js',
                dest: path.src.jsplugins + 'bootstrap-maxlength/'
            },
            'bootstrap-notify': {
                base: path.src.jsplugins + 'bootstrap-notify/dist',
                src: 'node_modules/bootstrap-notify/bootstrap-notify*.js',
                dest: path.src.jsplugins + 'bootstrap-notify/dist'
            },
            'chart.js': {
                base: path.src.jsplugins + 'chart.js/',
                src: ['node_modules/chart.js/dist/**/*.*', '!node_modules/chart.js/dist/docs/**/*.*'],
                dest: path.src.jsplugins + 'chart.js/'
            },
            ckeditor: {
                base: path.src.jsplugins + 'ckeditor/',
                src: ['node_modules/ckeditor/**/*.*', '!node_modules/ckeditor/package.json'],
                dest: path.src.jsplugins + 'ckeditor/'
            },
            cropperjs: {
                base: path.src.jsplugins + 'cropperjs/',
                src: 'node_modules/cropperjs/dist/**/*.*',
                dest: path.src.jsplugins + 'cropperjs/'
            },
            dropzone: {
                base: path.src.jsplugins + 'dropzone/dist',
                src: 'node_modules/dropzone/dist/**/*.*',
                dest: path.src.jsplugins + 'dropzone/dist'
            },
            'easy-pie-chart': {
                base: path.src.jsplugins + 'easy-pie-chart/',
                src: 'node_modules/easy-pie-chart/dist/jquery*.js',
                dest: path.src.jsplugins + 'easy-pie-chart/'
            },
            fullcalendar: {
                base: path.src.jsplugins + 'fullcalendar/',
                src: 'node_modules/fullcalendar/dist/**/*.*',
                dest: path.src.jsplugins + 'fullcalendar/'
            },
            moment: {
                base: path.src.jsplugins + 'moment/',
                src: 'node_modules/moment/min/**/*.*',
                dest: path.src.jsplugins + 'moment/'
            },
            gmaps: {
                base: path.src.jsplugins + 'gmaps/',
                src: 'node_modules/gmaps/gmaps*.*',
                dest: path.src.jsplugins + 'gmaps/'
            },
            'jquery-countdown': {
                base: path.src.jsplugins + 'jquery-countdown/',
                src: 'node_modules/jquery-countdown/dist/**/*.*',
                dest: path.src.jsplugins + 'jquery-countdown/'
            },
            jvectormap: {
                base: path.src.jsplugins + 'jvectormap/dist/',
                src: 'node_modules/jvectormap-next/jquery-jvectormap*.*',
                dest: path.src.jsplugins + 'jvectormap/dist/'
            },
            'raty-js': {
                base: path.src.jsplugins + 'raty-js/',
                src: 'node_modules/raty-js/lib/**/*.*',
                dest: path.src.jsplugins + 'raty-js/'
            },
            'jquery-validation': {
                base: path.src.jsplugins + 'jquery-validation/',
                src: 'node_modules/jquery-validation/dist/**/*.*',
                dest: path.src.jsplugins + 'jquery-validation/'
            },
            'jquery-ui-dist': {
                base: path.src.jsplugins + 'jquery-ui/',
                src: 'node_modules/jquery-ui-dist/*.js',
                dest: path.src.jsplugins + 'jquery-ui/'
            },
            vide: {
                base: path.src.jsplugins + 'vide/',
                src: 'node_modules/vide/dist/**/*.*',
                dest: path.src.jsplugins + 'vide/'
            },
            'magnific-popup': {
                base: path.src.jsplugins + 'magnific-popup/',
                src: 'node_modules/magnific-popup/dist/**/*.*',
                dest: path.src.jsplugins + 'magnific-popup/'
            },
            'jquery.maskedinput': {
                base: path.src.jsplugins + 'jquery.maskedinput/',
                src: 'node_modules/jquery.maskedinput/src/jquery.maskedinput.js',
                dest: path.src.jsplugins + 'jquery.maskedinput/',
                min: true
            },
            select2: {
                base: path.src.jsplugins + 'select2/',
                src: 'node_modules/select2/dist/**/*.*',
                dest: path.src.jsplugins + 'select2/'
            },
            simplemde: {
                base: path.src.jsplugins + 'simplemde/',
                src: 'node_modules/simplemde/dist/**/*.*',
                dest: path.src.jsplugins + 'simplemde/'
            },
            'slick-carousel': {
                base: path.src.jsplugins + 'slick-carousel/',
                src: 'node_modules/slick-carousel/slick/**/*.*',
                dest: path.src.jsplugins + 'slick-carousel/'
            },
            'jquery-sparkline': {
                base: path.src.jsplugins + 'jquery-sparkline/',
                src: 'node_modules/jquery-sparkline/jquery*.js',
                dest: path.src.jsplugins + 'jquery-sparkline/'
            },
            sweetalert2: {
                base: path.src.jsplugins + 'sweetalert2/',
                src: 'node_modules/sweetalert2/dist/**/*.*',
                dest: path.src.jsplugins + 'sweetalert2/'
            },
            highlightjs: {
                base: path.src.jsplugins + 'highlightjs/',
                src: ['node_modules/highlightjs/**/*.js', 'node_modules/highlightjs/**/*.css'],
                dest: path.src.jsplugins + 'highlightjs/'
            },
            'ion-rangeslider': {
                base: path.src.jsplugins + 'ion-rangeslider/',
                src: ['node_modules/ion-rangeslider/**/*.js', 'node_modules/ion-rangeslider/**/*.css', 'node_modules/ion-rangeslider/**/*.png'],
                dest: path.src.jsplugins + 'ion-rangeslider/'
            },
            'jquery-bootstrap-wizard': {
                base: path.src.jsplugins + 'jquery-bootstrap-wizard/bs3',
                src: 'node_modules/jquery-bootstrap-wizard/jquery*.js',
                dest: path.src.jsplugins + 'jquery-bootstrap-wizard/bs3'
            },
            datatables: {
                base: path.src.jsplugins + 'datatables/jquery.dataTables.min.js',
                src: 'node_modules/datatables.net/js/jquery.dataTables.js',
                dest: path.src.jsplugins + 'datatables/',
                min: true
            },
            'datatables-bs4-css': {
                base: path.src.jsplugins + 'datatables/dataTables.bootstrap4.css',
                src: 'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.css',
                dest: path.src.jsplugins + 'datatables/'
            },
            'datatables-bs4-js': {
                base: path.src.jsplugins + 'datatables/dataTables.bootstrap4.min.js',
                src: 'node_modules/datatables.net-bs4/js/dataTables.bootstrap4.js',
                dest: path.src.jsplugins + 'datatables/',
                min: true
            },
            'datatables-buttons': {
                base: path.src.jsplugins + 'datatables/buttons/',
                src: 'node_modules/datatables.net-buttons/js/**/*.js',
                dest: path.src.jsplugins + 'datatables/buttons/'
            },
            'datatables-buttons-bs4': {
                base: path.src.jsplugins + 'datatables/buttons-bs4/',
                src: ['node_modules/datatables.net-buttons-bs4/css/*.css', 'node_modules/datatables.net-buttons-bs4/js/*.js'],
                dest: path.src.jsplugins + 'datatables/buttons-bs4/'
            },
            'es6-promise': {
                base: path.src.jsplugins + 'es6-promise/',
                src: 'node_modules/es6-promise/dist/**/*.*',
                dest: path.src.jsplugins + 'es6-promise/'
            },
            summernote: {
                base: path.src.jsplugins + 'summernote/',
                src: 'node_modules/summernote/dist/**/*.*',
                dest: path.src.jsplugins + 'summernote/'
            },
            flatpickr: {
                base: path.src.jsplugins + 'flatpickr/',
                src: 'node_modules/flatpickr/dist/**/*.*',
                dest: path.src.jsplugins + 'flatpickr/'
            }
        }
    }
};


////////////////////////////////////////////////////////////////////////////////////////////////
//
// SERVER Related Tasks
//
////////////////////////////////////////////////////////////////////////////////////////////////

// PHP Server with browserSync (you must install PHP and add it to your PATH to use it)
gulp.task('serve-php', () => {
    connectphp.server({
        base: path.dir.src,
        port: '4000'
    }, () => {
        browserSync({
            injectChanges: true,
            proxy: '127.0.0.1:4000',
            notify: false
        });
    });

    gulp.watch(files.watch.server).on('change', () => {
        browserSync.reload();
    });
});

// Static Web Server with browserSync
gulp.task('serve-html', () => {
    browserSync.init({
        server: {
            baseDir: path.dir.src
        },
        injectChanges: true,
        notify: false
    });

    gulp.watch(files.watch.server).on('change', () => {
        browserSync.reload();
    });
});


////////////////////////////////////////////////////////////////////////////////////////////////
//
// Dependencies Copy Related Tasks
//
////////////////////////////////////////////////////////////////////////////////////////////////

// Delete original dependency and copy over new files (Minify or clean source map comments if is set)
function depUpdate(depName, depData) {
    del(depData.base).then(() => {
        if (depData.min) {
            return gulp.src(depData.src)
                .pipe(uglify({output: {comments: '/^!/'}}))
                .pipe(rename({suffix: '.min'}))
                .pipe(gulp.dest(depData.dest));
        } else if (depData.minclean) {
            return gulp.src(depData.src)
                .pipe(strip({safe: true}))
                .pipe(gulp.dest(depData.dest));
        } else {
            return gulp.src(depData.src)
                .pipe(gulp.dest(depData.dest));
        }
    });
}

// Update SCSS dependencies
gulp.task('dep-scss', (done) => {
    for (const [key, value] of Object.entries(dependencies.scss)) {
        depUpdate(key, value);
    };

    done();
});

// Update Fonts dependencies
gulp.task('dep-fonts', (done) => {
    for (const [key, value] of Object.entries(dependencies.fonts)) {
        depUpdate(key, value);
    };

    done();
});

// Update JS Core dependencies
gulp.task('dep-js-core', (done) => {
    for (const [key, value] of Object.entries(dependencies.js.core)) {
        depUpdate(key, value);
    };

    done();
});

// Update JS Plugins dependencies
gulp.task('dep-js-plugins', (done) => {
    for (const [key, value] of Object.entries(dependencies.js.plugins)) {
        depUpdate(key, value);
    };

    done();
});


////////////////////////////////////////////////////////////////////////////////////////////////
//
// SASS to CSS Related Tasks
//
////////////////////////////////////////////////////////////////////////////////////////////////

// SASS to CSS task for main styles
gulp.task('css-scss-main', () => {
    return gulp.src(files.src.scss.main)
        .pipe(sass({outputStyle: 'expanded', precision: 6}).on('error', sass.logError))
        .pipe(postcss([autoprefixer()]))
        .pipe(header(banner, {pkg : pkg} ))
        .pipe(rename({basename: pkgName}))
        .pipe(gulp.dest(path.src.css));
});

// SASS to CSS task for theme styles
gulp.task('css-scss-themes', () => {
    return gulp.src(files.src.scss.themes)
        .pipe(sass({outputStyle: 'expanded', precision: 6}).on('error', sass.logError))
        .pipe(postcss([autoprefixer()]))
        .pipe(header(banner, {pkg : pkg} ))
        .pipe(gulp.dest(path.src.css + 'themes/'));
});

// Minify main CSS
gulp.task('css-min-main', () => {
    return gulp.src(files.src.css.main)
        .pipe(cleanCSS({level: {1: {specialComments: 0}}}))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(path.src.css));
});

// Minify themes CSS
gulp.task('css-min-themes', () => {
    return gulp.src(files.src.css.themes)
        .pipe(cleanCSS({level: {1: {specialComments: 0}}}))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(path.src.css + 'themes/'));
});


////////////////////////////////////////////////////////////////////////////////////////////////
//
// ES6 to ES5 Related Tasks
//
////////////////////////////////////////////////////////////////////////////////////////////////

// Concat/uglify core JS files into one
gulp.task('js-concat-core', () => {
    return gulp.src(files.src.js.coreFiles)
        .pipe(concat(pkgNameJSCore + '.min.js'))
        .pipe(uglify())
        .pipe(header(banner, {pkg : pkg} ))
        .pipe(gulp.dest(path.src.js));
});

// ES6 to ES5 main JS (development friendly)
gulp.task('js-es6-main-dev', () => {
    return gulp.src(files.src.es6.main)
        .pipe(named())
        .pipe(gulpWebpack(webpackOptions.development, webpack))
        .pipe(header(banner, {pkg : pkg} ))
        .pipe(rename({basename: pkgNameJSMain}))
        .pipe(gulp.dest(path.src.js));
});

// ES6 to ES5 main JS (production ready)
gulp.task('js-es6-main', () => {
    return gulp.src(files.src.es6.main)
        .pipe(named())
        .pipe(gulpWebpack(webpackOptions.production, webpack))
        .pipe(header(banner, {pkg : pkg} ))
        .pipe(rename({basename: pkgNameJSMain, suffix: '.min'}))
        .pipe(gulp.dest(path.src.js));
});

// ES6 to ES5 pages JS (development friendly)
gulp.task('js-es6-pages-dev', () => {
    return gulp.src(files.src.es6.pages)
        .pipe(changed(path.src.js + 'pages/'))
        .pipe(named())
        .pipe(gulpWebpack(webpackOptions.development, webpack))
        .pipe(header(banner, {pkg : pkg} ))
        .pipe(gulp.dest(path.src.js + 'pages/'));
});

// ES6 to ES5 pages JS (production ready)
gulp.task('js-es6-pages', () => {
    return gulp.src(files.src.es6.pages)
        .pipe(changed(path.src.js + 'pages/', {extension: '.min.js'}))
        .pipe(named())
        .pipe(gulpWebpack(webpackOptions.production, webpack))
        .pipe(header(banner, {pkg : pkg} ))
        .pipe(rename({suffix: '.min'}))
        .pipe(gulp.dest(path.src.js + 'pages/'));
});


////////////////////////////////////////////////////////////////////////////////////////////////
//
// Build Related Tasks
//
////////////////////////////////////////////////////////////////////////////////////////////////

// Clean build directory and alias
gulp.task('build-clean', () => {
    return del(path.dir.build);
});
gulp.task('clean', gulp.series('build-clean'));

// Copy folders and files to build folder
gulp.task('build-copy', () => {
    return gulp.src(files.build.copy, {base: path.dir.src})
        .pipe(gulp.dest(path.dir.build));
});


////////////////////////////////////////////////////////////////////////////////////////////////
//
// Creating Main Tasks
//
////////////////////////////////////////////////////////////////////////////////////////////////

// Update Dependencies
gulp.task('dep-update', gulp.series('dep-scss', 'dep-fonts', 'dep-js-core', 'dep-js-plugins'));

// SASS to CSS
gulp.task('css', gulp.series(
    gulp.parallel('css-scss-main', 'css-scss-themes'),
    gulp.parallel('css-min-main', 'css-min-themes')
));

// ES6 to ES5
gulp.task('js-dev', gulp.series(
    gulp.parallel('js-es6-main-dev', 'js-es6-pages-dev'),
    gulp.parallel('js-es6-main', 'js-es6-pages')
));
gulp.task('js', gulp.series(
    gulp.parallel('js-es6-main', 'js-es6-pages')
));

// Build task
gulp.task('build', gulp.series('css', 'js', 'build-clean', 'build-copy'));


////////////////////////////////////////////////////////////////////////////////////////////////
//
// Watch Related Tasks
//
////////////////////////////////////////////////////////////////////////////////////////////////

// Watch task for SASS files
gulp.task('watch-scss', () => {
    return gulp.watch(files.watch.scss, gulp.series('css'));
});

// Watch tasks for Main JS files
gulp.task('watch-es6-main-dev', () => {
    return gulp.watch(files.watch.es6.main, gulp.series('js-es6-main-dev', 'js-es6-main'));
});
gulp.task('watch-es6-main', () => {
    return gulp.watch(files.watch.es6.main, gulp.series('js-es6-main'));
});

// Watch tasks for Pages JS files
gulp.task('watch-es6-pages-dev', () => {
    return gulp.watch(files.watch.es6.pages, gulp.series('js-es6-pages-dev', 'js-es6-pages'));
});
gulp.task('watch-es6-pages', () => {
    return gulp.watch(files.watch.es6.pages, gulp.series('js-es6-pages'));
});

// Watch task for all files
gulp.task('watch-dev', gulp.parallel('watch-scss', 'watch-es6-main-dev', 'watch-es6-pages-dev'));
gulp.task('watch', gulp.parallel('watch-scss', 'watch-es6-main', 'watch-es6-pages'));


////////////////////////////////////////////////////////////////////////////////////////////////
//
// Run Related Tasks
//
////////////////////////////////////////////////////////////////////////////////////////////////

// HTML Server and Watch files (-dev also produces unminimized development friendly JS files from ES6)
gulp.task('run-html-dev', gulp.parallel('serve-html', 'watch-dev'));
gulp.task('run-html', gulp.parallel('serve-html', 'watch'));

// PHP Server and Watch files (-dev also produces unminimized development friendly JS files from ES6)
gulp.task('run-php-dev', gulp.parallel('serve-php', 'watch-dev'));
gulp.task('run-php', gulp.parallel('serve-php', 'watch'));

// Default task
gulp.task('default', gulp.series('run-html'));
