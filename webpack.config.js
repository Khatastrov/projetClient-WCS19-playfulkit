var Encore = require('@symfony/webpack-encore');

Encore
    // directory where compiled assets will be stored
    .setOutputPath('public/build/')
    // public path used by the web server to access the output path
    .setPublicPath('/build')
    // only needed for CDN's or sub-directory deploy
    //.setManifestKeyPrefix('build/')

    /*
     * ENTRY CONFIG
     *
     * Add 1 entry for each "page" of your app
     * (including one that's included on every page - e.g. "app")
     *
     * Each entry will result in one JavaScript file (e.g. app.js)
     * and one CSS file (e.g. app.css) if you JavaScript imports CSS.
     */
    .addEntry('app', './assets/js/app.js')
    .addEntry('TutorialEditionForm', './assets/js/TutorialEditionForm.js')
    .addEntry('tutorial', './assets/js/tuto.js')
    .addEntry('mapScss', './assets/scss/map.scss')
    .addEntry('tutoCreate', './assets/js/tutoCreate.js')
    .addEntry('homePage', './assets/js/homePage.js')
    .addEntry('signIn', './assets/js/signIn.js')
    .addEntry('logIn', './assets/js/logIn.js')
    .addEntry('userEdit', './assets/js/userEdit.js')
    .addEntry('passwordNew', './assets/js/passwordNew.js')
    .addEntry('user', './assets/js/user.js')
    .addEntry('blog', './assets/js/blog.js')
    .addEntry('blogShow', './assets/js/blogShow.js')
    .addEntry('lessons', './assets/js/lessons.js')
    .addEntry('lessonsShow', './assets/js/lessonsShow.js')
    .addEntry('cgu', './assets/js/cgu.js')
    .addEntry('error', './assets/js/error.js')
    .addEntry('shop', './assets/scss/shop.scss')
    .addEntry('contact', './assets/js/contact.js')
    .addEntry('about', './assets/js/about.js')
    .addEntry('educ', './assets/scss/educ.scss')
    .addEntry('contest', './assets/js/contest.js')

    // When enabled, Webpack "splits" your files into smaller pieces for greater optimization.
    .splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    .enableSingleRuntimeChunk()

    /*
     * FEATURE CONFIG
     *
     * Enable & configure other features below. For a full
     * list of features, see:
     * https://symfony.com/doc/current/frontend.html#adding-more-features
     */
    .cleanupOutputBeforeBuild()
    .enableBuildNotifications()
    .enableSourceMaps(!Encore.isProduction())
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables @babel/preset-env polyfills
    .configureBabel(() => {}, {
        useBuiltIns: 'usage',
        corejs: 3
    })

    // enables Sass/SCSS support
    .enableSassLoader()

    // uncomment if you use TypeScript
    //.enableTypeScriptLoader()

    // uncomment to get integrity="..." attributes on your script & link tags
    // requires WebpackEncoreBundle 1.4 or higher
    //.enableIntegrityHashes()

    // uncomment if you're having problems with a jQuery plugin
    .autoProvidejQuery()

    // uncomment if you use API Platform Admin (composer req api-admin)
    //.enableReactPreset()
    //.addEntry('admin', './assets/js/admin.js')
;

module.exports = Encore.getWebpackConfig();
