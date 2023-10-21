const path = require('path')

module.exports = {
    mode: 'development',
    entry: {
        app: './assets/app.js',
        admin: './assets/admin.js'
    },
    output: {
        filename:'[name].js',
        path: path.resolve(__dirname, 'public/dist')
    }
}