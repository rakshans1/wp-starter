<?php

namespace WpStarter;

/**
 * Class Media
 * @package WpStarter
 *
 * Default media settings for Wp
 */
class Media
{

    public function __construct()
    {
        // $this->addImagesSizes();
        // add_action( 'after_setup_theme', array( $this, 'defaultMediaSetting' ) );
        // add_filter( 'image_size_names_choose', array( $this, 'customImageSizes' ) );
        add_action('jpeg_quality', array($this, 'customJpegQuality'));
    }

    /**
     * Use this method to register custom image sizes
     */
    public function addImagesSizes()
    {
        // add_image_size( 'small', 225, 9999 );
        // add_image_size( 'hero', 1600, 9999 );
    }

    /**
     * Add custom image sizes option to WP admin
     *
     * @param  array $sizes Default sizes
     *
     * @return array        Updated sizes
     */
    public function customImageSizes($sizes)
    {
        return array_merge($sizes, array(
            'small' => __('Small'),
        ));
    }

    /**
     * Default settings when adding or editing post images
     */
    public function defaultMediaSetting()
    {
        update_option('image_default_align', 'center');
        update_option('image_default_link_type', 'none');
        update_option('image_default_size', 'full');
    }

    /**
     * Sets custom JPG quality when resizing images
     * @return number JPG Quality
     */
    public function customJpegQuality()
    {
        return 80;
    }
}
