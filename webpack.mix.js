const mix = require("laravel-mix");

mix.webpackConfig({
    "module": {
        "rules": [
            {
                "enforce": "pre",
                "exclude": /node_modules/u,
                "loader": "eslint-loader",
                "test": "/.(js|vue)$/"
            }
        ]
    }
}).js(
    "resources/js/app.js",
    "public/js"
).
    sass(
        "resources/sass/app.scss",
        "public/css"
    );
