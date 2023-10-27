const path = require('path')

//importation plugins
const MiniCssExtactPlugin = require('mini-css-extract-plugin')

var config = {
    entry: {
        app: './assets/app.js',
        admin: './assets/admin.js'
    },
    output: {
        filename:'[name].js',
        path: path.resolve(__dirname, 'public/dist')
    },
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [
                    MiniCssExtactPlugin.loader,
                    {loader: 'css-loader'},
                    {loader: 'sass-loader'}
                ]
            },
            {
                test: /\.js$/,
                exclude: /node_modules/,
                use: ["babel-loader"]
            }
        ]
    },
    plugins: [new MiniCssExtactPlugin()]
}


module.exports = (env, argv) => {
    let dev = argv.mode === "development" ? true : false
    if(dev){
        config.watch = true
        config.devtool = 'source-map'
    }

    return config;
}