const mix = require('laravel-mix')
require('laravel-mix-polyfill')
require('laravel-vue-lang/mix')

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
  .js('resources/js/styleguide.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css', [
    require('tailwindcss'),
    require('autoprefixer')
  ])
  .lang()

if (mix.inProduction()) {
  mix.version()
    .polyfill() // Support IE 11
} else {
  mix.sourceMaps() // In case we ever use something that needs them
}
