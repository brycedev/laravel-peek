let mix = require('laravel-mix');

mix.setPublicPath('public/vendor/laravel-peek')
  .js('resources/js/app.js', 'js/')
  .browserSync('localhost:9090')   // change this while developing in different host/port
  .webpackConfig({
      output: {
          publicPath: '/vendor/laravel-peek/',
          chunkFilename: 'js/[name].js?id=[chunkhash]'
      },
      resolve: {
          alias: {
              'vue$': 'vue/dist/vue.runtime.esm.js',
              '@': path.resolve('resources/js'),
          },
      },
  })
  .sourceMaps()
  .version()