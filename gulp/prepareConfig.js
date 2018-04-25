'use strict';

const path = require('path');

// WordPress destination paths should be inside WP template
function prepareWpConfig(config) {
  const { dest, src } = config;
  const wordpressTemplatePath = path.join(
    dest.wordpress,
    'wp-content/themes',
    dest.wordpressTheme
  );

  dest.base = path.join(
    dest.wordpress,
    'wp-content/themes',
    dest.wordpressTheme,
    dest.base
  );

  src.templatesWatch = [
    path.join(wordpressTemplatePath, src.templatesPath, '**/*.twig'),
    path.join(wordpressTemplatePath, '**/*.php'),
  ];

  return config;
}

module.exports = function prepareConfig(config) {
  const { templatesBuild, base } = config.src;

  Object.assign(config, prepareWpConfig(config));
  templatesBuild[0] = path.join(base, templatesBuild[0]);

  return config;
};
