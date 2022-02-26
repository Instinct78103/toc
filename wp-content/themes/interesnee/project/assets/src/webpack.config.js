const path = require('path');
const glob = require('glob');
const TerserPlugin = require('terser-webpack-plugin');

function getEntries() {
  return glob.sync('./js/**/*.js').reduce((accumulator, path) => {
    const fileName = path.split('/').slice(-1)[0];
    return Object.assign(accumulator, { [fileName]: path });
  }, {});
}

function getOutputFileName({ name }) {
  return name.replace('.js', '.min.js');
}

module.exports = {
  entry: getEntries(),
  output: {
    path: path.resolve(__dirname, '../js'),
    filename: pathData => getOutputFileName(pathData.chunk),
  },
  module: {
    rules: [
      {
        test: /\.m?js$/,
        exclude: /(node_modules)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: ['@babel/preset-env'],
            plugins: ['@babel/plugin-transform-runtime'],
          },
        },
      },
    ],
  },
  optimization: {
    minimize: true,
    minimizer: [
      new TerserPlugin({
        extractComments: false,
      }),
    ],
  },
};
