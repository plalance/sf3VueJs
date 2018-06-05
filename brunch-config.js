'use strict';

exports.config = {
    paths: {
        'public': 'web',
        'watched': ['app/Resources/build']
    },
    conventions: {
        'assets': /^app\/Resources\/assets/
    },
    files: {
        javascripts: {
            joinTo: {
                'assets/app.js': /^app/,
                'assets/vendor.js': /^(?!app)/
            }
        },
        stylesheets: {
            joinTo: 'assets/app.css'
        },
        templates: {
            joinTo: 'assets/app.js',
        },
    },
    modules: {
        autoRequire: {
            'app.js': ['resources/build/main.js'],
        }
    },
    npm: {
        enabled: true
    },
    plugins: {
        babel: {},
        sass: {
            options: {
                includePaths: ["node_modules/uikit/src/scss"]
            }
        },
        // Globales se déclarent ic ou dans les fichiers js avec import ... from '...'
        // globals: {
        //     // $: "jquery",
        //     // uikit: "uikit",
        // }
    },
};