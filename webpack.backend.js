'use strict';

const NODE_ENV           = process.env.NODE_ENV || 'development';
const webpack            = require('webpack');
const ExtractTextPlugin  = require('extract-text-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const AssetsPlugin       = require('assets-webpack-plugin');
var jsName               = NODE_ENV === 'production' ? '[name].[chunkhash].js' : '[name].js';
var cssName              = NODE_ENV === 'production' ? 'styles.[contenthash].css' : 'styles.css';
var fileName             = NODE_ENV === 'production' ? 'url?name=[path][name].[hash:6].[ext]' : 'url?name=[path][name].[ext]';

module.exports = {
    context: __dirname + '/app/modules/backend/src',
    entry:   {
        index: "./index"
    },

    output: {
        path:       __dirname + "/public/assets/feap/js",
        publicPath: "/assets/feap/js/",
        filename:   jsName,
        library:    "feap"
    },

    watch: NODE_ENV === 'development',
    watchOptions: {
        aggregateTimeout: 100
    },
    plugins: [
        new webpack.NoErrorsPlugin(),
        new webpack.DefinePlugin({
            NODE_ENV: JSON.stringify(NODE_ENV)
        }),
        new ExtractTextPlugin(cssName)
    ],

    resolve: {
        modulesDirectories: ['node_modules'],
        extensions:         ['', '.js', '.jsx']
    },

    resolveLoader: {
        modulesDirectories: ['node_modules'],
        moduleTemplates:    ['*-loader', '*'],
        extensions:         ['', '.js']
    },

    module: {
        loaders: [
            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract('style', 'css!postcss')
            },
            {
                test:    /\.jsx?$/,
                exclude: [/node_modules/, /public/],
                loader:  'babel',
                query: {
                    presets: [
                        "es2015",
                        "react",
                        "stage-0"
                    ],
                    plugins: [
                        "transform-decorators-legacy"
                    ]
                }
            },
            {
                test: /\.json$/,
                loader: 'json'
            },
            {
                test:   /\.(png|jpg|svg|gif)$/,
                loader: fileName + '&limit=4096'
            },
            {
                test:   /\.(ttf|eot|woff|woff2)$/,
                loader: fileName + '&limit=1'
            }
        ]
    },

    devtool: NODE_ENV === 'development' ? 'cheap-source-map' : null
};

if (NODE_ENV === 'production') {
    module.exports.plugins.push(
        new webpack.optimize.UglifyJsPlugin({
            compress: {
                warnings:     false,
                drop_console: true,
                unsafe:       true
            }
        })
    );
    module.exports.plugins.push(
        new CleanWebpackPlugin([ 'public/assets/' ], {
            root:    __dirname,
            verbose: true,
            dry:     false
        })
    );
    module.exports.plugins.push(
        new AssetsPlugin({
            filename: 'assets.json',
            path:     __dirname + "/public/assets"
        })
    );
}
