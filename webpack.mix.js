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

mix
//    .js('resources/js/app.js', 'public/js')
   .sass('resources/scss/app.scss', 'public/css')
   .sass('resources/scss/vendor.scss', 'public/css')
   .tailwind('./tailwind.config.js');

// scripts
mix.js('resources/js/vendor.js', 'public/js/vendor.js');
mix.js('resources/js/app.js', 'public/js/app.js');

// styles
mix.styles([ 'public/css/main.css' ], 'public/css/main.css');

// minify
mix.minify('public/js/vendor.js')
mix.minify('public/js/app.js')
mix.minify('public/css/main.css')

//
if (mix.inProduction()) {
    mix.version();
}
mix.webpackConfig({
    module: {
        rules: [{
            test: /\.js?$/,
            use: [{
                loader: 'babel-loader',
                options: mix.config.babel()
            }]
        }]
    }
});
