let mix = require('laravel-mix');

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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

mix.sass('resources/assets/sass/app.scss', 'public/css/lib.css');

mix.styles([
    'resources/assets/css/single.css'
], 'public/css/single.css');

mix.js('resources/assets/js/app.js', 'public/js/lib.js');

mix.scripts([
    'resources/assets/js/fabric.min.js',
    'resources/assets/js/single.js'
], 'public/js/single.js');

if (mix.inProduction()) {
    mix.version();
}
