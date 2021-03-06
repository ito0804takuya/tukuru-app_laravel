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

mix.js(['resources/js/app.js','resources/js/assets/image_upload.js'], 'public/js/app.js')
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/sign_up.scss', 'public/css')
   .sass('resources/sass/sign_in.scss', 'public/css')
   .sass('resources/sass/header.scss', 'public/css')
   .sass('resources/sass/home.scss', 'public/css')
   .sass('resources/sass/products/create.scss', 'public/css')
   .sass('resources/sass/products/show.scss', 'public/css');
