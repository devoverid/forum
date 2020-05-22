const mix = require('laravel-mix');

require('laravel-mix-tailwind');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/scss/app.scss', 'public/css')
   .sass('resources/scss/vendor.scss', 'public/css')
   .tailwind('./tailwind.config.js');

if (mix.inProduction()) {
  mix
   .version();
}

// minify
mix.minify('public/js/main.js')
mix.styles([ 'public/css/main.css' ], 'public/css/main.min.css');