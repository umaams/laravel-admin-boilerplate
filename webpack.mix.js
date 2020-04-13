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

mix.autoload({
    jquery: ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery"]
 }).js([
    'resources/js/app.js',
 ], 'public/js').extract([
    'jquery',
    'datatables.net',
    'datatables.net-bs4',
    'datatables.net-responsive-bs4'
 ]).sourceMaps();

 mix.sass('resources/sass/app.scss', 'public/css/app.css');

 mix.styles([
    'node_modules/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css',
    'node_modules/@fortawesome/fontawesome-free/css/all.css',
    'node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css',
    'node_modules/datatables.net-fixedcolumns-bs4/css/fixedColumns.bootstrap4.min.css'
], 'public/css/vendor.css');

mix.copy([
   'node_modules/@fortawesome/fontawesome-free/webfonts',
], 'public/webfonts');