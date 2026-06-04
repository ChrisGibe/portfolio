const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const webpack = require('webpack');
const TerserJSPlugin = require('terser-webpack-plugin');
const OptimizeCSSAssetsPlugin = require('optimize-css-assets-webpack-plugin');
const CopyPlugin = require("copy-webpack-plugin");
const { WebpackManifestPlugin } = require('webpack-manifest-plugin');
const { VueLoaderPlugin } = require('vue-loader');
const SvgStore = require("webpack-svgstore");


const entry = {
    app: ['./_src/js/app.js', './_src/sass/styles.scss'],
}

module.exports = (env, argv) => {
    
    const isProduction = argv.mode === 'production';
    const config = {
        entry: entry,
        output: {
            path: path.resolve(__dirname, 'assets/scripts')
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
            new SvgStore({
                path: path.resolve(__dirname, "./_src/svg/**/*.svg"),
                fileName: "../svg/svg-sprites.svg",
                prefix: "icon-",
                inlineSvg:true
            }),
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
                    test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
                    use: [
                        {
                            loader: 'file-loader',
                            options: {
                                name: '[name].[ext]',
                                outputPath: '../fonts/'
                            }
                        }
                    ]
                },
                {
                    test: /\.(png|jpg|gif|svg|webp)$/,
                    use: [
                        {
                            loader: 'file-loader',
                            options: {
                                name: '[name].[ext]',
                                outputPath: '../images/'
                            }
                        }
                    ]
                }
            ],
        },

    };
    if (isProduction) {
        config.optimization = {
            minimizer: [new TerserJSPlugin({}), new OptimizeCSSAssetsPlugin({})],
        }
    } else {
        config.devtool = 'inline-source-map';
        config.watch = true;
    }
    return config;
};
