// This webpack configuration is meant to be used by Chisel build scripts.
// It should not be used with Webpack CLI.

const webpack = require('webpack');
let configPath = require('./package.json').wp;
configPath = require('./gulp/prepareConfig')(configPath);
const generatorConfig = require('./.yo-rc.json')['generator-wp'].config;

try {
  // eslint-disable-next-line global-require, import/no-unresolved
  const generatorConfigLocal = require('./.yo-rc-local.json')['generator-wp']
    .config;
  _.merge(generatorConfig, generatorConfigLocal);
} catch (e) {
  // Do nothing
}

function createConfig(cb) {
  const isDevelopment = process.env.NODE_ENV === 'development';
  const publicPathResolve = generatorConfig.subSlug
    ? `/${generatorConfig.subSlug}/${configPath.dest.theme}/${
        configPath.dest.scripts
      }/`
    : `/${configPath.dest.theme}/${configPath.dest.scripts}/`;

  const config = {
    output: {
      filename: '[name].bundle.js',
      chunkFilename: '[id].[chunkhash].chunk.js',
      publicPath: publicPathResolve,
    },
    externals: {
      jquery: 'window.jQuery',
    },
    mode: isDevelopment ? 'development' : 'production',
    devtool: 'inline-source-map',
    stats: { colors: true, modules: false },
    watch: isDevelopment,
    module: {
      rules: [
        { test: /\.js$/, exclude: /node_modules/, loader: 'babel-loader' },
      ],
    },
    node: false,
    plugins: [
      new webpack.optimize.ModuleConcatenationPlugin(),
      new webpack.DefinePlugin({
        'process.env.NODE_ENV': JSON.stringify(process.env.NODE_ENV),
      }),
      new webpack.ProvidePlugin({
        jQuery: 'jquery',
        $: 'jquery',
        'window.jQuery': 'jquery',
      }),
    ],
  };

  cb(config);
}

module.exports = () =>
  new Promise(resolve => {
    createConfig(resolve);
  });
