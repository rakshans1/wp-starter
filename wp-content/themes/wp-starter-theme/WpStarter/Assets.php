<?php

namespace WpStarter;

/**
 * Class Assets
 * @package WpStarter
 *
 * Add enque and localization of script, and styles
 */
class Assets
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('wp_enqueue_scripts', array($this, 'denqueueStyles'));
        add_action('wp_enqueue_scripts', array($this, 'enqueueVendor'));
        add_action('wp_enqueue_scripts', array($this, 'enqueueBundle'));
    }

    public function enqueueStyles()
    {
        // Register the styles
        wp_register_style('wp_styles', \WpStarter\Template::revisionedPath('styles/main.css'));
        wp_enqueue_style('wp_styles');
    }

    public function denqueueStyles()
    {
        // Deregister the styles
        $wpDeregister = array();
        foreach ($wpDeregister as $styles) {
            wp_deregister_style($styles);
        }
    }

    public function enqueueVendor()
    {
        if (\WpStarter\Template::hasVendor()) {
            // Register the script
            wp_register_script('wp_script_vendor', \WpStarter\Template::revisionedPath('scripts/vendor.js'), false, null, true);
            wp_enqueue_script('wp_script_vendor');
        }
    }

    public function enqueueBundle()
    {
        // Remove native version of jQuery and use custom CDN version instead
        wp_deregister_script('jquery');
        wp_register_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, null, true);
        // Register the script
        wp_register_script('wp_script_bundle', \WpStarter\Template::revisionedPath('scripts/app.bundle.js'), 'jquery', null, true);
        wp_enqueue_script('wp_script_bundle');
    }
}
