const configure = require('@dosomething/webpack-config');
const path = require('path');

module.exports = configure({
  entry: {
    'app': ['babel-polyfill', './resources/assets/app.js'],
  },
  output: {
    // Override output path for Laravel's "public" directory.
    path: path.join(__dirname, '/public/dist'),
  }
});
