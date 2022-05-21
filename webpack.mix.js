const mix = require('laravel-mix');
const admin_mix = require('laravel-mix');
const public_mix = require('laravel-mix');

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

const productionSourceMaps = true;

const path = {
  r: 'resources/',
  rs: 'resources/static/',
  rsa: 'resources/static/admin/',
  rsp: 'resources/static/public/',
  p: 'public/',
  ps: 'public/static/',
  psa: 'public/static/admin/',
  psp: 'public/static/public/',
};


mix
  .copy(path.rs + 'images/', path.ps + 'images/')

/* Admin */
admin_mix
  .copy(path.rsa + 'fonts/', path.psa + 'fonts/')
  /* SASS */
  .sass(path.rsa + 'sass/app.sass', path.psa + 'css/app.css')
  .sass(path.rsa + 'sass/dashmix/themes/xeco.scss', path.psa + 'css/themes/')
  .sass(path.rsa + 'sass/dashmix/themes/xinspire.scss', path.psa + 'css/themes/')
  .sass(path.rsa + 'sass/dashmix/themes/xmodern.scss', path.psa + 'css/themes/')
  .sass(path.rsa + 'sass/dashmix/themes/xsmooth.scss', path.psa + 'css/themes/')
  .sass(path.rsa + 'sass/dashmix/themes/xwork.scss', path.psa + 'css/themes/')
  .sass(path.rsa + 'sass/dashmix/themes/xdream.scss', path.psa + 'css/themes/')
  .sass(path.rsa + 'sass/dashmix/themes/xpro.scss', path.psa + 'css/themes/')
  .sass(path.rsa + 'sass/dashmix/themes/xplay.scss', path.psa + 'css/themes/')

  /* JavaScript */
  .js(path.rsa + 'js/dashmix/core.js', path.psa + 'js/dashmix.core.js')
  .js(path.rsa + 'js/app.js', path.psa + 'js/')

  /* Page JS */
  .js(path.rsa + 'js/pages/tables_datatables.js', path.psa + 'js/pages/')

  /* Tools */
  .disableNotifications()

  /* Options */
  .options({
    processCssUrls: false,
    postCss: [
      require('postcss-import'),
      require('autoprefixer'),
    ]
  })
  .sourceMaps(productionSourceMaps, 'source-map')


/* Public */
// public_mix
//   .copy(public + '/fonts', 'public/fonts/')
//   /* SASS */
//   .sass(public + 'sass/app.sass', 'public/css/app.css')

//   /* JavaScript */
//   .js(public + 'js/app.js', path.psa+ 'js')

//   /* Page JS */

//   /* Tools */
//   .disableNotifications()

//   /* Options */
//   .options({
//     processCssUrls: false,
//     postCss: [
//       require('postcss-import'),
//       require('tailwindcss'),
//       require('autoprefixer'),
//     ]
//   })
//   .sourceMaps(productionSourceMaps, 'source-map')
