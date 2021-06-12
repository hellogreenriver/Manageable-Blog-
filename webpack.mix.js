const mix = require("laravel-mix");

/*
|--------------------------------------------------------------------------
| Mix Asset Management
|--------------------------------------------------------------------------
|
| Mix provides a clean, fluent API for defining some Webpack build steps
| for your Laravel applications. By default, we are compiling the CSS
| file for the application as well as bundling up all the JS files.
|
*/

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/app2.js", "public/js")
    .vue()
    .js("resources/js/router.js", "public/js")
    .styles(['resources/css/app.css', 'resources/css/forMain.css'], 'public/css/style.css')
    .scripts('resources/js/scripts.js', 'public/js/scripts.js');