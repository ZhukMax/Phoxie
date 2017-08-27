'use strict';

const NODE_ENV           = process.env.NODE_ENV || 'development';
const webpack            = require('webpack');
const ExtractTextPlugin  = require('extract-text-webpack-plugin');
const CleanWebpackPlugin = require('clean-webpack-plugin');
const AssetsPlugin       = require('assets-webpack-plugin');

let jsName               = NODE_ENV === 'production' ? '[name].[chunkhash].js' : '[name].js';
let cssName              = NODE_ENV === 'production' ? 'styles.[contenthash].css' : 'styles.css';
let fileName             = NODE_ENV === 'production' ? 'url-loader?name=[path][name].[hash:6].[ext]' : 'url-loader?name=[path][name].[ext]';

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
        new webpack.NoEmitOnErrorsPlugin(),
        new webpack.DefinePlugin({
            NODE_ENV: JSON.stringify(NODE_ENV)
        }),
        new ExtractTextPlugin(cssName)
    ],

    module: {
        loaders: [
            {
                test: /\.css$/,
                loader: ExtractTextPlugin.extract({ fallback: 'style-loader', use: 'css-loader' })
            },
            {
                test:    /\.jsx?$/,
                exclude: [/node_modules/, /public/],
                loader:  'babel-loader',
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
                loader: 'json-loader'
            },
            {
                test:   /\.(png|jpg|svg|gif|ico)$/,
                loader: fileName + '&limit=4096'
            },
            {
                test:   /\.(ttf|eot|woff|woff2)$/,
                loader: fileName + '&limit=1'
            }
        ]
    },

    devtool: NODE_ENV === 'development' ? 'cheap-source-map' : false
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
        new CleanWebpackPlugin([ 'public/assets/feap/' ], {
            root:    __dirname,
            verbose: true,
            dry:     false
        })
    );
    module.exports.plugins.push(
        new AssetsPlugin({
            filename: 'assets.json',
            path:     __dirname + "/public/assets/feap"
        })
    );
}
