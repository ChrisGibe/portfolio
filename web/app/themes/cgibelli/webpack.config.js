const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const webpack = require('webpack');
const TerserJSPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const CopyPlugin = require("copy-webpack-plugin");
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const { VueLoaderPlugin } = require('vue-loader');


const entry = {
    app: ['./_src/js/app.js', './_src/styles/styles.scss', './_src/styles/css/tailwind.css'],
}

module.exports = (env, argv) => {

    const isProduction = argv.mode === 'production';
    const config = {
        entry: entry,
        output: {
            path: path.resolve(__dirname, 'assets/scripts'),
            assetModuleFilename: '[name][ext]'
        },
        resolve: {
            alias: {
                vue: "vue/dist/vue.esm-bundler.js"
            },
            symlinks: true,
            extensions: ['.tsx', '.ts', '.js'],
        },
        plugins: [
            new webpack.DefinePlugin({ __VUE_OPTIONS_API__: true, __VUE_PROD_DEVTOOLS__: true }),
            new MiniCssExtractPlugin({
                filename: "../styles/styles.css" // change this RELATIVE to your output.path!
            }),
            new CopyPlugin({
                patterns: [
                    {from: "./_src/images", to: "../images/"},
                ],
            }),
            new WebpackManifestPlugin(),
            new VueLoaderPlugin(),
        ],
        module: {
            rules: [
                {
                    test: /\.js$/,
                    exclude: /node_modules/,
                    loader: "babel-loader"
                },
                {
                    test: /\.vue$/,
                    loader: 'vue-loader',
                },
                {
                    test: /\.scss$/i,
                    exclude: /node_modules/,
                    use: [
                        MiniCssExtractPlugin.loader,
                        'css-loader',
                        'sass-loader'
                    ],

                },
                {
                    test: /\.css$/i,
                    use: [
                        MiniCssExtractPlugin.loader,
                        'css-loader',
                        'postcss-loader',
                    ],
                },
                {
                    test: /\.(woff(2)?|ttf|eot)(\?v=\d+\.\d+\.\d+)?$/,
                    type: 'asset/resource',
                    generator: {
                        filename: '../fonts/[name][ext]'
                    }
                },
                {
                    test: /\.(png|jpg|gif|svg|webp)$/,
                    type: 'asset/resource',
                    generator: {
                        filename: '../images/[name][ext]'
                    }
                }
            ],
        },

    };
    if (isProduction) {
        config.optimization = {
            minimizer: [new TerserJSPlugin(), new CssMinimizerPlugin()],
        }
    } else {
        config.devtool = 'inline-source-map';
        config.watch = true;
        config.watchOptions = {
            ignored: ['**/node_modules/**', '**/assets/**'],
            aggregateTimeout: 300,
        };
    }
    return config;
};
