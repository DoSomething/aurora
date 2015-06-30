var elixir = require('laravel-elixir');
/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
mix.clean;
// DoSomething Neue Interface
mix.copy('node_modules/dosomething-neue/dist', 'public/assets/vendor/neue');

mix.copy('node_modules/dosomething-modal/dist', 'public/assets/vendor/modal');

});
