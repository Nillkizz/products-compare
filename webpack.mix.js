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

const productionSourceMaps = false;

const admin = 'resources/static/admin/'
const admin_dist = 'public/static/admin/'
const public = 'resources/static/public/'
const public_dist = 'public/static/public/'


/* Admin */
admin_mix
  .copy(admin + '/fonts', admin_dist + 'fonts/')
  /* SASS */
  .sass(admin + 'sass/app.sass', admin_dist + 'css/app.css')
  .sass(admin + 'sass/dashmix/themes/xeco.scss', admin_dist + 'css/themes/')
  .sass(admin + 'sass/dashmix/themes/xinspire.scss', admin_dist + 'css/themes/')
  .sass(admin + 'sass/dashmix/themes/xmodern.scss', admin_dist + 'css/themes/')
  .sass(admin + 'sass/dashmix/themes/xsmooth.scss', admin_dist + 'css/themes/')
  .sass(admin + 'sass/dashmix/themes/xwork.scss', admin_dist + 'css/themes/')
  .sass(admin + 'sass/dashmix/themes/xdream.scss', admin_dist + 'css/themes/')
  .sass(admin + 'sass/dashmix/themes/xpro.scss', admin_dist + 'css/themes/')
  .sass(admin + 'sass/dashmix/themes/xplay.scss', admin_dist + 'css/themes/')

  /* JavaScript */
  .js(admin + 'js/dashmix/core.js', admin_dist + 'js/dashmix.core.js')
  .js(admin + 'js/app.js', admin_dist + 'js/')

  /* Page JS */
  .js(admin + 'js/pages/tables_datatables.js', admin_dist + 'js/pages/')

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
//   .js(public + 'js/app.js', admin_dist + 'js')

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
