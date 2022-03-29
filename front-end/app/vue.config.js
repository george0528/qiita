const ForkTsCheckerWebpackPlugin = require('fork-ts-checker-webpack-plugin');

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
    },
    // build時のメモリの上限の設定 参考(https://jpcodeqa.com/q/9657df44a2eef94b0faa692fcdc0ef7b)
    configureWebpack: config => {

        // get a reference to the existing ForkTsCheckerWebpackPlugin
        const existingForkTsChecker = config.plugins.filter(
          p => p instanceof ForkTsCheckerWebpackPlugin,
        )[0];
    
        // remove the existing ForkTsCheckerWebpackPlugin
        // so that we can replace it with our modified version
        config.plugins = config.plugins.filter(
          p => !(p instanceof ForkTsCheckerWebpackPlugin),
        );
    
        // copy the options from the original ForkTsCheckerWebpackPlugin
        // instance and add the memoryLimit property
        const forkTsCheckerOptions = existingForkTsChecker.options;
        forkTsCheckerOptions.memoryLimit =  6000;
    
        config.plugins.push(new ForkTsCheckerWebpackPlugin(forkTsCheckerOptions));
      },
}