const path = require('path');
const UglifyJSPlugin = require('uglifyjs-webpack-plugin');
// Our new plugin
const MiniCssExtractPlugin = require("mini-css-extract-plugin");

module.exports = {
    mode: 'development',
    entry: {
        admin: './js/admin.js',
        public: './js/public.js',
    },    
    output: {      
      filename: '[name].min.js',
      path: path.resolve(__dirname, '../assets')
    },
    plugins: [
        new UglifyJSPlugin(),
        new MiniCssExtractPlugin({
            filename: '[name].min.css',
            //chunkFilename: "theme.css"            
        })
    ],
    module: {
        rules: [
            {
              test: /\.js$/,
              exclude: /(node_modules|bower_components)/,
              use: {
                loader: 'babel-loader',
                options: {
                  presets: ['babel-preset-env']
                }
              }
            },
            {
              test: /\.scss$/,
              use: [
                MiniCssExtractPlugin.loader,
                "css-loader",
                'sass-loader',
              ]
            }
          ]
    }
};