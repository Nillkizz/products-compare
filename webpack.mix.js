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
  rsc: 'resources/static/core/',
  rsp: 'resources/static/public/',
  p: 'public/',
  ps: 'public/static/',
  psa: 'public/static/admin/',
  psc: 'public/static/core/',
  psp: 'public/static/public/',
};



/* Core */
mix
  .copy(path.rs + 'images/', path.ps + 'images/')

  .copy(path.rsc + 'fonts/', path.psc + 'fonts/')
  /* SASS */
  .sass(path.rsc + 'sass/app.sass', path.psc + 'css/')
  .sass(path.rsc + 'sass/dashmix/themes/xeco.scss', path.psc + 'css/themes/')
  .sass(path.rsc + 'sass/dashmix/themes/xinspire.scss', path.psc + 'css/themes/')
  .sass(path.rsc + 'sass/dashmix/themes/xmodern.scss', path.psc + 'css/themes/')
  .sass(path.rsc + 'sass/dashmix/themes/xsmooth.scss', path.psc + 'css/themes/')
  .sass(path.rsc + 'sass/dashmix/themes/xwork.scss', path.psc + 'css/themes/')
  .sass(path.rsc + 'sass/dashmix/themes/xdream.scss', path.psc + 'css/themes/')
  .sass(path.rsc + 'sass/dashmix/themes/xpro.scss', path.psc + 'css/themes/')
  .sass(path.rsc + 'sass/dashmix/themes/xplay.scss', path.psc + 'css/themes/')

  /* JavaScript */
  .js(path.rsc + 'js/app.js', path.psc + 'js/core.js')
  .js(path.rsc + 'js/alpine.js', path.psc + 'js/alpine.js')

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



/* Admin */
admin_mix
  .js(path.rsa + 'js/app.js', path.psa + 'js/')

  .sass(path.rsa + 'sass/app.sass', path.psa + 'css/')

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
public_mix
  .copy(path.rsp + 'fonts', path.psp + 'fonts/')
  /* SASS */
  .sass(path.rsp + 'sass/app.sass', path.psp + 'css/app.css')

  /* JavaScript */
  .js(path.rsp + 'js/app.js', path.psp + 'js')

  /* Page JS */

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
