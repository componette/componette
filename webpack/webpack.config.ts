import deepmerge from 'deepmerge';
import MiniCssExtractPlugin from 'mini-css-extract-plugin';
import { Configuration } from 'webpack';

import { DEV, helper, makeEntry } from './utils';
import makeLoaders from './loaders';

const baseConfig: Configuration = {
  entry: makeEntry(),
  module: {
    rules: makeLoaders(DEV),
  },
  target: 'web',
  plugins: [
    new MiniCssExtractPlugin({ filename: '[name].css?[hash]' }),
    helper.createManifestPlugin(),
  ],
  resolve: {
    extensions: ['.ts', '.js'],
  },
};

const makeConfig = (config: Configuration): Configuration =>
  deepmerge(baseConfig, config, {
    arrayMerge: (target, source) => [...source, ...target],
  });

export default makeConfig;