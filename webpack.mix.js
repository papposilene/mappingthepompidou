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

mix.js('resources/js/backend.js', 'public/js');
mix.js('resources/js/app.js', 'public/js').vue({ version: 3 });
mix.postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ]);
mix.sass('resources/sass/bootstraped.scss', 'public/css');
