var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass("app.scss")
        .copy("node_modules/bootstrap-sass/js/bootstrap-alert.js","public/js/")
        .copy("node_modules/bootstrap-sass/js/bootstrap-dropdown.js","public/js/")
        .copy("node_modules/jquery/dist/jquery.js","public/js/")
        .phpUnit();
});
