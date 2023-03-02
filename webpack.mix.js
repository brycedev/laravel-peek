const mix = require('laravel-mix')
const path = require('path')

mix.setPublicPath('public/vendor/laravel-peek')
  .js('resources/js/app.js', '/').vue({ version: 3 })
  .webpackConfig({
      output: {
        publicPath: '/vendor/laravel-peek/',
        chunkFilename: '[name].js?id=[chunkhash]'
      },
      resolve: {
        alias: {
        '@': path.resolve('resources/js'),
        },
      },
  })
  .version()