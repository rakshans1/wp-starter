<?php
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    include __DIR__ . '/vendor/autoload.php';
}
define('Wp_NAMESPACE', 'WpStarter\\');

spl_autoload_register(
    function ($class) {
        $baseDirectory = __DIR__ . '/WpStarter/';

        $namespacePrefixLength = strlen(Wp_NAMESPACE);

        if (strncmp(Wp_NAMESPACE, $class, $namespacePrefixLength) !== 0) {
            return;
        }

        $relativeClassName = substr($class, $namespacePrefixLength);

        $classFilename = $baseDirectory . str_replace('\\', '/', $relativeClassName) . '.php';

        if (file_exists($classFilename)) {
            include $classFilename;
        }
    }
);
include __DIR__ . '/includes/_includes.php';

\WpStarter\Helpers::setWpEnv();
new \WpStarter\Settings();
new \WpStarter\Security();
new \WpStarter\Performance();
new \WpStarter\Media();
new \WpStarter\Assets();
new \WpStarter\Localize();
new \WpStarter\Slug();
