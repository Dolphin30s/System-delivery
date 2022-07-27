const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '.env'/*, debug: true*/}));

const mix = require('laravel-mix');
const path = require('path');
let tailwindcss = require('tailwindcss');
require('laravel-mix-merge-manifest');
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

let pb = 'public/assets';
let pbm = `${pb}/main`

mix.webpackConfig({
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js'),
                '@assets': path.resolve(__dirname, 'resources/'),
                '@sass': path.resolve(__dirname, 'resources/sass')
            }
        },
        output: {
            publicPath: '/',
            chunkFilename: 'chunk/[name].js'
        }
    })
    .js('resources/js/app.js', `${pbm}/js`)
    .postCss(`resources/css/main.css`, `${pbm}/css`, [
        tailwindcss('./tailwind.js')
    ])
    .vue()
    .sass('resources/sass/app.scss', `${pbm}/css`)
    .styles('node_modules/vuesax/dist/vuesax.css', `${pbm}/css/vuesax.css`) // Vuesax framework css
    .styles(`resources/css/iconfont.css`, `${pbm}/css/iconfont.css`) // Feather Icon Font css
    .copyDirectory('node_modules/material-icons/iconfont', `${pbm}/css/material-icons`) // Material Icon fonts
    .styles('node_modules/material-icons/iconfont/material-icons.css', `${pbm}/css/material-icons/material-icons.css`) // Material Icon fonts css
    .styles('node_modules/prismjs/themes/prism-tomorrow.css', `${pbm}/css/prism-tomorrow.css`) // Prism Tomorrow theme css
    .styles('node_modules/vue-tel-input/dist/vue-tel-input.css', `${pbm}/css/vue-tel-input.css`) // Tel Input theme css
    .copyDirectory(`resources/fonts`, `${pbm}/fonts`)
    .copyDirectory(`resources/js/assets/images`, `${pbm}/images`); // Copy all images from resources to public folder

if (mix.inProduction()) {
    mix.version();
}
