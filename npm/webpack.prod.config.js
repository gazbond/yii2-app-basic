// Utils
const path = require('path');

// Webpack plugins
const UglifyJsPlugin = require('uglifyjs-webpack-plugin');

// Webpack config
let config = {
    mode: 'production',
    entry: {
        index: './src/index.js',
        lib: './lib/lib.js',
        shim: './lib/shim.js'
    },
    output: {
        // Absolute dist path
        path: dist = path.resolve(__dirname, '../web/dist'),
        filename: '[name].js'
    },
    optimization: {
        minimizer: [
            new UglifyJsPlugin({
                cache: true,
                parallel: true
            })
        ]
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: {
                    loader: "babel-loader",
                    options: {
                        presets: [
                            '@babel/preset-react',
                            '@babel/preset-env'
                        ]
                    }
                }
            }
        ]
    }
};

module.exports = config;