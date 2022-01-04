const mix = require('laravel-mix');

require('@tinypixelco/laravel-mix-wp-blocks');
require('laravel-mix-purgecss');
require('laravel-mix-copy-watched');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Sage application. By default, we are compiling the Sass file
 | for your application, as well as bundling up your JS files.
 |
 */

mix.setPublicPath('./dist').browserSync('keley-on-mars.local');

mix.webpackConfig((webpack) => ({
  module: {
    rules: [
      {
        test: /\.(glsl|vs|fs|vert|frag)$/,
        exclude: /node_modules/,
        use: ['raw-loader', 'glslify-loader'],
      },
    ],
  },
  plugins: [
    new webpack.ProvidePlugin({
      THREE: 'three',
    }),
  ],
}));

mix
  .sass('resources/assets/styles/app.scss', 'styles')
  .sass('resources/assets/styles/editor.scss', 'styles');

mix
  .js('resources/assets/scripts/app.js', 'scripts')
  .js('resources/assets/scripts/customizer.js', 'scripts')
  .blocks('resources/assets/scripts/editor.js', 'scripts')
  .extract();

// Assets
mix
  .copyDirectory('resources/assets/images', 'dist/images')
  .copyDirectory('resources/assets/fonts', 'dist/fonts')
  .copyDirectory('resources/assets/animations', 'dist/animations');

// Font integration optimisation
mix.copy('resources/assets/scripts/async/font-css-async.js', 'dist/scripts');

mix
  .autoload({
    jquery: ['$', 'window.jQuery'],
  })
  .options({
    processCssUrls: false,
    rules: [
      {
        test: /\.(glsl|vs|fs|vert|frag)$/,
        exclude: /node_modules/,
        use: ['glslify-loader'],
      },
    ],
  });

mix.options({
  processCssUrls: false,
});

mix.sourceMaps().version();
