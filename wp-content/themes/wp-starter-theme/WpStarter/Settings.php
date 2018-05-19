<?php

namespace WpStarter;

/**
 * Class Settings
 * @package Wp
 *
 * Use this class to store configuration constants
 */
class Settings
{
    const MANIFEST_PATH = 'dist/rev-manifest.json';
    const WEBPACK_MANIFEST_PATH = 'dist/scripts/manifest.json';
    const WEBPACK_MANIFEST_DEV_PATH = 'dist/scripts/manifest-dev.json';
    const DIST_PATH = 'dist/';
    const ASSETS_PATH = 'dist/assets/';
    const SCRIPTS_PATH = 'dist/scripts/';
    const TEMPLATES_DIR = 'templates';

    private $extensions = array('Theme', 'DataType', 'LazyLoad');
    private $hooks = array('');
    private $admins = array('');
    private $shortcodes = array();

    /**
     * Get relative path of webpack manifest based on environment
     *
     * @return string
     */
    public static function getWebpackManifestPath()
    {
        if (defined('WP_DEV_ENV')) {
            return self::WEBPACK_MANIFEST_DEV_PATH;
        } else {
            return self::WEBPACK_MANIFEST_PATH;
        }
    }

    public function __construct()
    {
        // $this->loadExtensions();
        // $this->loadHooks();
        // $this->loadAdmins();
        // $this->loadShortcodes();
    }

    /**
     * Instantiate and call all extensions listed in self::EXTENSIONS
     * @throws \Exception
     */
    private function loadExtensions()
    {
        foreach ($this->extensions as $extension) {
            $class = "\WpStarter\Extensions\\${extension}";
            $extension = new $class();
            if (!$extension instanceof Extensions\WpExtension) {
                throw new \Exception('Extension has to implement WpExtension interface');
            }
            $extension->extend();
        }
    }
    /**
     * Instantiate and call all hooks listed in self::HOOKS
     * @throws \Exception
     */
    private function loadHooks()
    {
        foreach ($this->hooks as $hook) {
            $class = "\WpStarter\Hooks\\${hook}";
            $hook = new $class();
            if (!$hook instanceof Hooks\WpHook) {
                throw new \Exception('Extension has to implement WpHook interface');
            }
            $hook->hook();
        }
    }
    /**
     * Instantiate and call all admin classes
     * @throws \Exception
     */
    private function loadAdmins()
    {
        foreach ($this->admins as $admin) {
            $class = "\WpStarter\Admin\\${admin}";
            $admin = new $class();
            if (!$admin instanceof Admin\WpAdmin) {
                throw new \Exception('Extension has to implement WpAdmin interface');
            }
            $admin->admin();
        }
    }
    /**
     * Instantiate and call all shortcodes
     * @throws \Exception
     */
    private function loadShortcodes()
    {
        foreach ($this->shortcodes as $shortcode) {
            $class = "\WpStarter\Shortcodes\\${shortcode}";
            $shortcode = new $class();
            if (!$shortcode instanceof Shortcodes\WpShortcode) {
                throw new \Exception('Extension has to implement WpShortcode interface');
            }
            $shortcode->shortcode();
        }
    }
}
