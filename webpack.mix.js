const mix = require('laravel-mix')
require('laravel-mix-tailwind')
const path = require('path')

mix.setPublicPath('public')
  .sass('resources/sass/app.scss', '/').tailwind()
  .js('resources/js/app.js', '/').vue({ version: 3 })
  .webpackConfig({
      output: {
        chunkFilename: '[name].js?id=[chunkhash]'
      },
      resolve: {
        alias: {
        '@': path.resolve('resources/js'),
        },
      },
  })
  .version()