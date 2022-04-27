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

mix.styles([
    'resources/css/app.css',
    'resources/css/datatabes.css',
    'resources/css/leaflet.css',
    'resources/css/plugins.css',
], 'public/css/app.css');

mix.styles([
    'resources/css/store/preloader.css',
    'resources/css/store/bootstrap.min.css',
    'resources/css/store/slick.css',
    'resources/css/store/backToTop.css',
    'resources/css/store/meanmenu.css',
    'resources/css/store/nice-select.css',
    'resources/css/store/owl.carousel.min.css',
    'resources/css/store/animate.min.css',
    'resources/css/store/jquery.fancybox.min.css',
    'resources/css/store/fontAwesome5Pro.css',
    'resources/css/store/ui-range-slider.css',
    'resources/css/store/default.css',
    'resources/css/store/style.css',
], 'public/store/css/app.css');


mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts',
        'public/webfonts'
    ).sourceMaps();

mix.js([
        'resources/js/store/a.js',
        'resources/js/store/b-waypoints.min.js',
        'resources/js/store/c-meanmenu.js',
        'resources/js/store/d-slick.min.js',
        'resources/js/store/e-backToTop.js',
        'resources/js/store/f-jquery.fancybox.min.js',
        'resources/js/store/g-countdown.js',
        'resources/js/store/h-nice-select.min.js',
        'resources/js/store/i-isotope.pkgd.min.js',
        'resources/js/store/j-owl.carousel.min.js',
        'resources/js/store/k-jquery-ui-slider-range.js',
        'resources/js/store/l-ajax-form.js',
        'resources/js/store/n-imagesloaded.pkgd.min.js',
        'resources/js/store/o-main.js'
    ], 'public/js/store.js')
    .sass('resources/sass/store/app.scss', 'public/store/css');
