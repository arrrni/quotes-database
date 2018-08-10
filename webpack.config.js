var path = require('path');
var Encore = require('@symfony/webpack-encore');
var OfflinePlugin = require('offline-plugin');
var ManifestPlugin = require('manifest-webpack-plugin');
var commonChunk = require("webpack/lib/optimize/CommonsChunkPlugin");
var VueLoaderPlugin = require('vue-loader/lib/plugin')
//var jwtDecode = require('jwt-decode');

Encore
    .setOutputPath('public/build/')

    .cleanupOutputBeforeBuild()

    .setPublicPath('/build')

    .enableSassLoader()

    .enableSourceMaps(!Encore.isProduction())

    .addEntry('js/vendor', './assets/js/vendor.js')

    .addEntry('js/vue', './assets/js/vue.js')

    .addEntry('js/sw', './assets/js/sw.js')

    .addStyleEntry('css/app', './assets/scss/app.scss')
    
    .addPlugin(new VueLoaderPlugin())

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    .enableVueLoader()

    // create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning()
;

module.exports = Encore.getWebpackConfig();

var config = Encore.getWebpackConfig();
config.plugins.push(new commonChunk({
    name: 'commonChunk',
    async: true
}));
config.plugins.push(new ManifestPlugin({
    fileName: 'manifest.json',
    basePath: '/public/build/',
    seed: {
        "short_name": "QuoteDB",
        "name": "SymfonyVue",
        "start_url": "/",
        "icons": [{
            "src": "/build/images/256.png",
            "sizes": "256x256",
            "type": "image/png"
        },
            {
                "src": "/build/images/512.png",
                "sizes": "512x512",
                "type": "image/png"
            }
        ],
        "background_color": "#FAFAFA",
        "theme_color": "#e10b0b",
        "display": "standalone",
        "orientation": "portrait",
        "gcm_sender_id": "314804067424"
    }
}));
config.plugins.push(new OfflinePlugin({
    "strategy": "changed",
    "responseStrategy": "cache-first",
    "publicPath": "/build/",
    "caches": {
        // offline plugin doesn't know about build folder
        // if I added build in it , it will show something like : OfflinePlugin: Cache pattern [build/images/*] did not match any assets
        "main": [
            '*.json',
            'css/*.css',
            'js/*.js',
            'img/*'
        ]
    },
    "ServiceWorker": {
        "events": !Encore.isProduction(),
        "entry": "./assets/js/sw.js",
        "cacheName": "QuoteDB",
        "navigateFallbackURL": '/',
        "minify": !Encore.isProduction(),
        "output": "./../js/sw.js",
        "scope": "/"
    },
    "AppCache": null
}));
