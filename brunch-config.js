'use strict';

exports.config = {
    paths: {
        'public': 'web',
        'watched': ['app/Resources']
    },
    conventions: {
        'assets': /^app\/Resources\/assets/
    },
    files: {
        javascripts: {
            joinTo: {
                'js/app.js': /^app/,
                'js/vendor.js': /^(?!app)/
            }
        },
        stylesheets: {
            joinTo: 'css/style.css'
        },
        templates: {
            joinTo: 'js/app.js',
        },
    },
    modules: {
        autoRequire: {
            'js/app.js': ['Resources/js/main.js'],
        }
    },
    plugins: {
        babel: {},
    },
};