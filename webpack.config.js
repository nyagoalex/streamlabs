const path = require('path');
const MomentLocalesPlugin = require('moment-locales-webpack-plugin');
const webpack = require('webpack')

module.exports = {
  plugins: [
    // To strip all locales except “en”
    new MomentLocalesPlugin(),

    // Or: To strip all locales except “en”, “es-us” and “ru”
    // (“en” is built into Moment and can’t be removed)
    new MomentLocalesPlugin({
      localesToKeep: ['es-us', 'ru'],
    }),
  ],
    output: { chunkFilename: 'js/[name].js?id=[chunkhash]' },
  resolve: {
    extensions: ['.js', '.json', '.vue'],
    alias: {
      '@': path.resolve('./resources/js'),
      '@components': path.resolve(__dirname, 'resources/js/Components'),
      '@layouts': path.resolve(__dirname, 'resources/js/Layouts'),
      '@utilities': path.resolve(__dirname, 'resources/js/Utilities/'),

    },
  },
    plugins: [
        new webpack.DefinePlugin({
            VUE_OPTIONS_API: true,
            VUE_PROD_DEVTOOLS: false
        })
    ],
    // module: {
    //     rules: [
    //         {
    //             enforce: 'pre',
    //             test: /\.(js|vue)$/,
    //             loader: 'eslint-loader',
    //             exclude: /node_modules/
    //         }
    //     ]
    // }
};
