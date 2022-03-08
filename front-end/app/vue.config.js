module.exports = {
    publicPath: './',
    pwa: {
        workboxPluginMode: 'GenerateSW',
        workboxOptions: {
        exclude: /.htaccess/
        }
    },
    pluginOptions: {
        // ↓ コレを追加
        webpackBundleAnalyzer: {
            openAnalyzer: false
        },
    }
}