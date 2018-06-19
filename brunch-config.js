'use strict';

exports.config = {
    paths: {
        'public': 'web',
        'watched': ['app/Resources/']
    },
    conventions: {
        'assets': /^app\/Resources\/assets/
    },
    files: {
        javascripts: {
            joinTo: {
                'js/app.js': /^app/,
                'js/vendor.js': /^(?!app)/,
                'js/jquery.js': '/app/Resources/ove/jquery.slim.js'
            }
        },
        stylesheets: {
            joinTo: 'css/app.css'
        },
        templates: {
            joinTo: 'css/app.js',
        },
    },
    modules: {
        autoRequire: {
            'app.js': ['Resources/build/main.js'],
        }
    },
    npm: {
        enabled: true
    },
    plugins: {
        babel: {},
        sass: {
            options: {
                precision: 8
            }
        },
        copycat:{
            // "fonts" : ["bower_components/material-design-iconic-font", "bower_components/font-awesome/fonts"],
            "images": ["./app/Resources/build/images"],
            "js": ["./app/Resources/build/libraries", './node_modules/jquery/dist/jquery.slim.js'],
            verbose : true, //shows each file that is copied to the destination directory
            onlyChanged: true //only copy a file if it's modified time has changed (only effective when using brunch watch)
        },
        postcss: {
            modules: true,
        },
        // Globales se déclarent ic ou dans les fichiers js avec import ... from '...'
        globals: {
            $: 'jquery',
            jQuery: 'jquery'
        }
    },
};