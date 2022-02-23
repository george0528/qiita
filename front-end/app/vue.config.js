module.exports = {
    publicPath: './',
    pwa: {
        workboxPluginMode: 'GenerateSW',
        workboxOptions: {
        exclude: [/.htaccess/]
        }
    },
    configureWebpack: {
        devServer: {
            historyApiFallback: true
        }
    }
}