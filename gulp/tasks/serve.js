'use strict';

const path = require('path');

module.exports = function serveTask(
  gulp,
  plugins,
  config,
  helpers,
  generatorConfig // eslint-disable-line no-unused-vars
) {
  const { base, styles, vendorConfig, assets, templatesWatch } = config.src;
  const startTasks = ['styles-watch', 'assets-watch', 'vendor-watch'];

  gulp.task('serve', startTasks, () => {
    const name = generatorConfig.nameSlug;
    const browserSyncConfig = {
      proxy: {
        target: generatorConfig.proxyTarget || `${name}.test`,
        reqHeaders: {
          'x-chisel-proxy': '1',
        },
      },
      ghostMode: false,
      online: true,
    };

    plugins.browserSync.init(browserSyncConfig);

    gulp.watch(path.join(base, styles), ['styles-watch']);
    gulp.watch(path.join(base, assets), ['assets-watch']);
    gulp.watch(templatesWatch).on('change', plugins.browserSync.reload);
    gulp.watch(path.join(base, vendorConfig), () => {
      gulp.start('vendor-watch', () => {
        plugins.browserSync.reload();
      });
    });
  });
};
