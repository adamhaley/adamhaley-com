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
//js

mix.js('resources/js/carousel.js', 'public/js')
    .js('resources/js/app.js', 'public/js');

//stylus
mix.stylus(
    'resources/styl/main.styl',
    'public/css/main.css'
).stylus(
    'resources/styl/skins/ice/app.styl',
    'public/skins/ice/css/app.css'
);
