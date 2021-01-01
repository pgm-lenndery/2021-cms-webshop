const mix = require('laravel-mix');

mix.js('src/js/app.js', 'app.js')
    .sass('src/scss/index.scss', 'style.css')
    .disableSuccessNotifications();