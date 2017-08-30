const webpack = require('webpack');
const path = require('path');
const ExtractTextPlugin = require("extract-text-webpack-plugin");

const extractSass = new ExtractTextPlugin({
    // filename: "[name].[contenthash].css",
    filename: "[name].css",
    disable: process.env.NODE_ENV === "development"
});

// const jqueryWrapper = path.resolve(__dirname, 'web_src/app/javascripts/jquery-wrapper.js');
const jqueryWrapper = 'jquery';

module.exports = {
    entry: {
        app: './src/AppBundle/Resources/javascripts/app.js',
        admin: './src/AdminBundle/Resources/javascripts/admin.js'
    },
    output: {
        filename: '[name].js',
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
            { test: /\.svg$/, use: "file-loader" },
            // {
            //     test: require.resolve('jquery'),
            //     use: [{
            //         loader: 'expose-loader',
            //         options: 'jQuery'
            //     },{
            //         loader: 'expose-loader',
            //         options: '$'
            //     }]
            // }
        ]
    },
    // resolve: {
    //     alias: {
    //         jquery: path.resolve(__dirname, 'web_src/app/javascripts/jquery-wrapper.js')
    //     }
    // },
    plugins: [
        extractSass,
        // new webpack.optimize.CommonsChunkPlugin({
        //     name: 'vendor',
        //     minChunks: function (module) {
        //         // this assumes your vendor imports exist in the node_modules directory
        //         return module.context && module.context.indexOf('node_modules') !== -1;
        //     }
        // }),

        // for bootstrap
        new webpack.ProvidePlugin({
            jQuery: jqueryWrapper,
            $: jqueryWrapper,
            "window.jQuery": "jquery"
        })
    ]
};