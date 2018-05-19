<?php

namespace WpStarter;

/**
 * This class adds localization data needed in theme.
 *
 *
 * @package    WpStarter
 * @subpackage include
 * @author     Rakshan Shetty <shetty.raxx555@gmail.com>
 */
class Localize
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', array($this, 'globalThemeLocalize'));
    }

    /**
     * Adds Global object needed in theme
     *
     * @return  void
     *
     * @since 1.0.0
     *
     * @author Rakshan Shetty <shetty.raxx555@gmail.com>
     */
    public function globalThemeLocalize()
    {
        $wp_script_bundle = array(
            'template_directory_uri' => get_template_directory_uri(),
            'base_url' => site_url(),
            'home_url' => home_url('/'),
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('wp_rest'),
            'api_url' => esc_url_raw(get_rest_url())
        );
        wp_localize_script('wp_script_bundle', 'wp', $wp_script_bundle);
    }
}
