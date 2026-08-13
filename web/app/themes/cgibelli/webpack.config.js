const path = require('path');
const crypto = require('crypto');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const webpack = require('webpack');
const TerserJSPlugin = require('terser-webpack-plugin');
const CssMinimizerPlugin = require('css-minimizer-webpack-plugin');
const CopyPlugin = require("copy-webpack-plugin");
const { VueLoaderPlugin } = require('vue-loader');


const entry = {
    app: ['./_src/js/app.js', './_src/styles/styles.scss', './_src/styles/css/tailwind.css'],
}

/**
 * Écrit assets/mix-manifest.json au format attendu par le helper mix()
 * (web/app/mu-plugins/tequila/helpers/assets.php) :
 *
 *   { "/styles/styles.css": "/styles/styles.css?id=<hash>" }
 *
 * Le hash suit le contenu : l'URL change à chaque build réel, ce qui invalide
 * le cache navigateur. Les noms de fichiers restent stables, donc si le
 * manifest venait à manquer, mix() retombe sur l'URL nue et le site s'affiche.
 */
class MixManifestPlugin {
    // assetsByPublicPath : { <chemin public> : <nom de l'asset webpack> }
    constructor(assetsByPublicPath, fileName = '../mix-manifest.json') {
        this.assetsByPublicPath = assetsByPublicPath;
        this.fileName = fileName;
    }

    apply(compiler) {
        compiler.hooks.thisCompilation.tap('MixManifestPlugin', (compilation) => {
            compilation.hooks.processAssets.tap(
                {
                    name: 'MixManifestPlugin',
                    stage: webpack.Compilation.PROCESS_ASSETS_STAGE_REPORT,
                },
                (assets) => {
                    const manifest = Object.entries(this.assetsByPublicPath).reduce(
                        (acc, [publicPath, assetName]) => {
                            const asset = assets[assetName];

                            if (!asset) {
                                compilation.warnings.push(
                                    new Error(`MixManifestPlugin : asset introuvable « ${assetName} »`)
                                );
                                return acc;
                            }

                            const hash = crypto
                                .createHash('md5')
                                .update(asset.source())
                                .digest('hex')
                                .slice(0, 20);

                            return { ...acc, [publicPath]: `${publicPath}?id=${hash}` };
                        },
                        {}
                    );

                    compilation.emitAsset(
                        this.fileName,
                        new webpack.sources.RawSource(JSON.stringify(manifest, null, 2))
                    );
                }
            );
        });
    }
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
            new webpack.DefinePlugin({
                __VUE_OPTIONS_API__: true,
                // Les devtools Vue n'ont rien à faire sur le site public
                __VUE_PROD_DEVTOOLS__: !isProduction,
            }),
            new MiniCssExtractPlugin({
                filename: "../styles/styles.css" // change this RELATIVE to your output.path!
            }),
            new CopyPlugin({
                patterns: [
                    {from: "./_src/images", to: "../images/"},
                ],
            }),
            new MixManifestPlugin({
                '/scripts/app.js': 'app.js',
                '/styles/styles.css': '../styles/styles.css',
            }),
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
                    // Import .glsl files as raw strings (webpack 5 built-in).
                    // `import src from './x.glsl'` -> the file's text content.
                    test: /\.glsl$/,
                    type: 'asset/source',
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
            minimizer: [
                new TerserJSPlugin({
                    terserOptions: {
                        // Pas de console.log dans le bundle livré
                        compress: { drop_console: true },
                    },
                }),
                new CssMinimizerPlugin(),
            ],
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
