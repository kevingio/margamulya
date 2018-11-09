const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */
mix.combine([
        'public/app-asset/js/jquery-3.2.1.min.js',
        'public/app-asset/css/bootstrap4/popper.js',
        'public/app-asset/css/bootstrap4/bootstrap.min.js',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/owl.carousel.js',
        'public/app-asset/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.js',
        'public/app-asset/plugins/easing/easing.js',
        'public/app-asset/plugins/salvattore/salvattore.js',
        'public/admin-asset/vendors/sweetalert/sweetalert.min.js',
        'public/app-asset/plugins/autocomplete/jquery.autocomplete.js',
        'public/app-asset/js/search-autocomplete.js',
        'public/app-asset/js/preload.js',
        'public/app-asset/js/custom.js'
    ], 'public/js/home.js')
    .styles([
        'public/app-asset/plugins/font-awesome-5.4.1/css/all.css',
        'public/app-asset/css/bootstrap4/bootstrap.min.css',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/owl.carousel.css',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/owl.theme.default.css',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/animate.css',
        'public/app-asset/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css',
        'public/app-asset/css/main_styles.css',
        'public/app-asset/css/responsive.css',
        'public/app-asset/css/custom.css'
    ], 'public/css/home.css')
    .combine([
        'public/app-asset/js/jquery-3.2.1.min.js',
        'public/app-asset/css/bootstrap4/popper.js',
        'public/app-asset/css/bootstrap4/bootstrap.min.js',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/owl.carousel.js',
        'public/app-asset/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.js',
        'public/app-asset/plugins/easing/easing.js',
        'public/app-asset/plugins/salvattore/salvattore.js',
        'public/app-asset/plugins/autocomplete/jquery.autocomplete.js',
        'public/app-asset/plugins/parallax-js-master/parallax.min.js',
        'public/admin-asset/vendors/sweetalert/sweetalert.min.js',
        'public/app-asset/js/category.js',
        'public/app-asset/js/search-autocomplete.js',
        'public/app-asset/js/custom.js'
    ], 'public/js/app.js')
    .styles([
        'public/app-asset/plugins/font-awesome-5.4.1/css/all.css',
        'public/app-asset/css/bootstrap4/bootstrap.min.css',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/owl.carousel.css',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/owl.theme.default.css',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/animate.css',
        'public/app-asset/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css',
        'public/app-asset/css/category.css',
        'public/app-asset/css/category_responsive.css',
        'public/app-asset/css/custom.css'
    ], 'public/css/app.css')
    .combine([
        'public/app-asset/js/jquery-3.2.1.min.js',
        'public/app-asset/css/bootstrap4/popper.js',
        'public/app-asset/css/bootstrap4/bootstrap.min.js',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/owl.carousel.js',
        'public/app-asset/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.js',
        'public/app-asset/plugins/easing/easing.js',
        'public/app-asset/plugins/salvattore/salvattore.js',
        'public/app-asset/plugins/parallax-js-master/parallax.min.js',
        'public/app-asset/plugins/autocomplete/jquery.autocomplete.js',
        'public/app-asset/js/search-autocomplete.js',
        'public/app-asset/js/post.js',
        'public/app-asset/js/custom.js'
    ], 'public/js/article.js')
    .styles([
        'public/app-asset/plugins/font-awesome-5.4.1/css/all.css',
        'public/app-asset/css/bootstrap4/bootstrap.min.css',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/owl.carousel.css',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/owl.theme.default.css',
        'public/app-asset/plugins/OwlCarousel2-2.2.1/animate.css',
        'public/app-asset/plugins/jquery.mb.YTPlayer-3.1.12/jquery.mb.YTPlayer.css',
        'public/app-asset/css/post.css',
        'public/app-asset/css/post_responsive.css',
        'public/app-asset/css/custom.css'
    ], 'public/css/article.css');

// admin

mix.styles([
        'public/admin-asset/vendors/iconfonts/mdi/css/materialdesignicons.css',
        'public/app-asset/plugins/font-awesome-5.4.1/css/all.css',
        'public/admin-asset/vendors/css/vendor.bundle.base.css',
        'public/admin-asset/vendors/css/vendor.bundle.addons.css',
        'public/admin-asset/vendors/summernote/dist/summernote-bs4.css',
        'public/admin-asset/vendors/select2/select2.min.css',
        'public/admin-asset/css/style.css',
        'public/admin-asset/css/custom.css'
    ], 'public/css/admin.css')
    .combine([
        'public/admin-asset/vendors/js/vendor.bundle.base.js',
        'public/admin-asset/vendors/js/vendor.bundle.addons.js',
        'public/admin-asset/vendors/summernote/dist/summernote-bs4.js',
        'public/admin-asset/vendors/select2/select2.min.js',
        'public/admin-asset/vendors/sweetalert/sweetalert.min.js',
        'public/admin-asset/js/misc.js',
        'public/admin-asset/js/contents/*.js'
    ], 'public/js/admin.js');

mix.version();
