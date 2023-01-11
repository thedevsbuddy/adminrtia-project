const mix = require('laravel-mix');
const path = require('path');


mix.js('resources/js/app.js', 'public/js')
    .vue()
    .css('resources/css/app.css', 'public/css')
    .alias({
        "@": path.join(__dirname, 'resources/js')
    })
