const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss')


mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .options({
        processCssUrls: false,
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })

mix.browserSync({
    proxy: {
        target: '172.18.0.2'
    },
    open: false,

});

