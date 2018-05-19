<?php

namespace WpStarter;

/**
 * Class Template
 * This class should not be changed during development.
 * @package WpStarter
 */
class Template
{
    /**
     * Get parsed manifest file content
     *
     * @return array
     */
    public static function getManifest()
    {
        return \WpStarter\Template::initManifest();
    }

    /**
     * Returns the real path of the revisioned file.
     * When WP_DEV_ENV is defined it returns
     *  path based on the manifest file content.
     *
     * @param $asset
     *
     * @return string
     */
    public static function revisionedPath($asset)
    {
        $pathinfo = pathinfo($asset);

        if (!defined('WP_DEV_ENV')) {
            $manifest = \WpStarter\Template::getManifest();
            if (!array_key_exists($pathinfo['basename'], $manifest)) {
                return 'FILE-NOT-REVISIONED';
            }

            return sprintf(
                '%s/%s%s/%s',
                get_template_directory_uri(),
                \WpStarter\Settings::DIST_PATH,
                $pathinfo['dirname'],
                $manifest[$pathinfo['basename']]
            );
        } else {
            return sprintf(
                '%s/%s%s',
                get_template_directory_uri(),
                \WpStarter\Settings::DIST_PATH,
                trim($asset, '/')
            );
        }
    }

    /**
     * Returns the real path of the asset file.
     *
     * @param $asset
     *
     * @return string
     */
    public static function assetPath($asset)
    {
        return sprintf(
            '%s/%s%s',
            get_template_directory_uri(),
            \WpStarter\Settings::ASSETS_PATH,
            trim($asset, '/')
        );
    }

    /**
     * Builds class string based on name and modifiers
     *
     * @param  string $name base class name
     * @param  string[] $modifiers,... class name modifiers
     *
     * @return string                built class
     */
    public static function className($name = '', $modifiers = null)
    {
        if (!is_string($name) || empty($name)) {
            return '';
        }
        $modifiers = array_slice(func_get_args(), 1);
        $classes = array($name);
        foreach ($modifiers as $modifier) {
            if (is_string($modifier) && !empty($modifier)) {
                $classes[] = $name . '--' . $modifier;
            }
        }

        return implode(' ', $classes);
    }

    /**
     * Verifies existence of the vendor.js file
     *
     * @return bool
     */
    public static function hasVendor()
    {
        if (defined('WP_DEV_ENV')) {
            return file_exists(
                sprintf(
                    '%s/%s%s',
                    get_template_directory(),
                    \WpStarter\Settings::DIST_PATH,
                    'scripts/vendor.js'
                )
            );
        } else {
            $manifest = \WpStarter\Template::getManifest();

            return array_key_exists('vendor.js', $manifest);
        }
    }

    /**
     * Returns the real path of the scripts directory.
     *
     * @return string
     */
    public static function getScriptsPath()
    {
        return sprintf(
            '%s/%s',
            get_template_directory_uri(),
            \WpStarter\Settings::SCRIPTS_PATH
        );
    }

    /**
     * Verifies existence of webpack manifest file.
     *
     * @return bool
     */
    public static function hasWebpackManifest()
    {
        return file_exists(
            sprintf(
                '%s/%s',
                get_template_directory(),
                \WpStarter\Settings::getWebpackManifestPath()
            )
        );
    }

    /**
     * Returns the contents of the webpack manifest file.
     *
     * @return string
     */
    public static function getWebpackManifest()
    {
        if ($this->hasWebpackManifest()) {
            return file_get_contents(
                sprintf(
                    '%s/%s',
                    get_template_directory(),
                    \WpStarter\Settings::getWebpackManifestPath()
                )
            );
        }
        return '';
    }

    /**
     * Loads data from manifest file.
     */
    public static function initManifest()
    {
        if (file_exists(get_template_directory() . '/' . \WpStarter\Settings::MANIFEST_PATH)) {
            return json_decode(
                file_get_contents(get_template_directory() . '/' . \WpStarter\Settings::MANIFEST_PATH),
                true
            );
        }
    }
}
