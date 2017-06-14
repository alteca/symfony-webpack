const webpack = require('webpack');
const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

const extractSass = new ExtractTextPlugin({
    // filename: "[name].[contenthash].css",
    filename: "[name].css",
    disable: process.env.NODE_ENV === "development"
});

module.exports = {
    entry: {
        app: './web_src/app/javascripts/app.js'
    },
    output: {
        filename: '[name]_bundle.js',
        path: path.resolve(__dirname, 'web/dist')
    },
    module: {
        rules: [{
            test: /\.scss$/,
            use: extractSass.extract({
                use: [{
                    loader: "css-loader"
                }, {
                    loader: "sass-loader"
                }],
                // use style-loader in development
                fallback: "style-loader"
            })
            },
            { test: /\.(woff|woff2)$/, use: "url-loader?limit=10000" },
            { test: /\.ttf$/, use: "file-loader" },
            { test: /\.eot$/, use: "file-loader" },
            { test: /\.svg$/, use: "file-loader" }
        ]
    },
    plugins: [
        extractSass,
        new webpack.optimize.CommonsChunkPlugin({
            name: 'vendor',
            minChunks: function (module) {
                // this assumes your vendor imports exist in the node_modules directory
                return module.context && module.context.indexOf('node_modules') !== -1;
            }
        })
    ]
};