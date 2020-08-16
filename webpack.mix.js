"use strict";

const mix = require("laravel-mix");

mix.webpackConfig({
    "module": {
        "rules": [
            {
                "enforce": "pre",
                "exclude": /node_modules/u,
                "loader": "eslint-loader",
                "options": {
                    "emitWarning": true
                },
                "test": /\.(js)?$/u
            }
        ]
    },
    "output": {
        "chunkFilename": "js/components/[name].js",
        "publicPath": "/"
    }
});

mix.js(
    "resources/js/base.js",
    "public/js"
).js(
    "resources/js/track.js",
    "public/js"
).
    sass(
        "resources/sass/base.scss",
        "public/css"
    ).
    sass(
        "resources/sass/login.scss",
        "public/css"
    ).
    sass(
        "resources/sass/tracks.scss",
        "public/css"
    );
