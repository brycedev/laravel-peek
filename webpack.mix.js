const mix = require('laravel-mix')
const path = require('path')

mix.setPublicPath('public/vendor/laravel-peek')
  .js('resources/js/app.js', 'js/').vue({ version: 3 })// change this while developing in different host/port
  .webpackConfig({
      output: {
        publicPath: '/vendor/laravel-peek/',
        chunkFilename: 'js/[name].js?id=[chunkhash]'
      },
      resolve: {
        alias: {
        '@': path.resolve('resources/js'),
        },
      },
  })
  .sourceMaps()
  .version()