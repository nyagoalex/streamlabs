const mix = require('laravel-mix');
const config = require('./webpack.config');

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ]).vue({ version: 3 })
    .webpackConfig(config)
    .alias({
        '@components': 'resources/js/Components',
        '@layouts': 'resources/js/Layouts',
    });
