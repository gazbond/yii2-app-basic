// Utils
const path = require('path');

// Webpack config
let config = {
    mode: 'development',
    // Create source maps
    devtool: 'source-map',
    entry: {
        index: './src/index.js'
    },
    output: {
        // Absolute dist path
        path: dist = path.resolve(__dirname, '../web/dist'),
        filename: '[name].js'
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