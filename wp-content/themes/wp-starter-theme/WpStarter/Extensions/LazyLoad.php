<?php

namespace WpStarter\Extensions;

/**
 * Class LazyLoad
 * this class adds lady load functionality to theme
 * @package WpStarter\Extensions
 */
class LazyLoad implements WpExtension
{
    public function extend()
    {
        add_action('wp_head', array($this, 'setupFilters'), 9999);
        add_filter('wp_kses_allowed_html', array($this, 'allowLazyattributes'));
    }

    /**
     * This method adds all filters
     *
     * @since  1.0.0
     * @access public
     * @return null
     */
    public function setupFilters()
    {
        add_filter('the_content', array($this, 'addImagePlaceholders'), PHP_INT_MAX);
        add_filter('post_thumbnail_html', array($this, 'addImagePlaceholders'), PHP_INT_MAX);
        add_filter('get_avatar', array($this, 'addImagePlaceholders'), PHP_INT_MAX);
        add_filter('widget_text', array($this, 'addImagePlaceholders'), PHP_INT_MAX);
        add_filter('get_image_tag', array($this, 'addImagePlaceholders'), PHP_INT_MAX);
        add_filter('wp_get_attachment_image_attributes', array($this, 'processImageAttributes'), PHP_INT_MAX);
    }
    /**
     * Ensure that our lazy image attributes are not filtered out of image tags.
     *
     * @param array $allowed_tags The allowed tags and their attributes.
     * @return array
     */
    public function allowLazyattributes($allowed_tags)
    {
        if (!isset($allowed_tags['img'])) {
            return $allowed_tags;
        }

        // But, if images are allowed, ensure that our attributes are allowed!
        $img_attributes = array_merge($allowed_tags['img'], array(
        'data-lazy-src' => 1,
        'data-lazy-srcset' => 1,
        'data-lazy-sizes' => 1,
        ));

        $allowed_tags['img'] = $img_attributes;

        return $allowed_tags;
    }
    public function addImagePlaceholders($content)
    {
        // Don't lazyload for feeds, previews
        if (is_feed() || is_preview()) {
            return $content;
        }

        // Don't lazy-load if the content has already been run through previously
        if (false !== strpos($content, 'data-lazy-src')) {
            return $content;
        }

        // Don't lazyload for amp-wp content
        if (function_exists('is_amp_endpoint') && is_amp_endpoint()) {
            return $content;
        }

        $content = preg_replace_callback('#<(img)([^>]+?)(>(.*?)</\\1>|[\/]?>)#si', array(__class__, 'processImage'), $content);

        return $content;
    }
    /**
     * Processes images in content by acting as the preg_replace_callback
     *
     * @since 1.0.0
     *
     * @param array $matches
     *
     * @return string The image with updated lazy attributes
     */
    public static function processImage($matches)
    {
        $old_attributes_str = $matches[2];
        $old_attributes_kses_hair = wp_kses_hair($old_attributes_str, wp_allowed_protocols());

        if (empty($old_attributes_kses_hair['src'])) {
            return $matches[0];
        }

        $old_attributes = self::flattenKsesHairData($old_attributes_kses_hair);
        $new_attributes = self::processImageAttributes($old_attributes);
        $new_attributes_str = self::buildAttributesString($new_attributes);

        return sprintf('<img %1$s><noscript>%2$s</noscript>', $new_attributes_str, $matches[0]);
    }
    /**
     * Given an array of image attributes, updates the `src`, `srcset`, and `sizes` attributes so
     * that they load lazily.
     *
     * @since 1.0.0
     *
     * @param array $attributes
     *
     * @return array The updated image attributes array with lazy load attributes
     */
    public static function processImageAttributes($attributes)
    {
        if (empty($attributes['src'])) {
            return $attributes;
        }

        // check for gazette featured images, which are incompatible
        if (isset($attributes['class']) && false !== strpos($attributes['class'], 'gazette-featured-content-thumbnail')) {
            return $attributes;
        }

        $old_attributes = $attributes;

        // Set placeholder and lazy-src
        $attributes['src'] = self::getPlaceholderImage();
        $attributes['data-lazy-src'] = $old_attributes['src'];

        // Handle `srcset`
        if (!empty($attributes['srcset'])) {
            $attributes['data-lazy-srcset'] = $old_attributes['srcset'];
            unset($attributes['srcset']);
        }

        // Handle `sizes`
        if (!empty($attributes['sizes'])) {
            $attributes['data-lazy-sizes'] = $old_attributes['sizes'];
            unset($attributes['sizes']);
        }

        return $attributes;
    }

    private static function getPlaceholderImage()
    {
      /**
       * Allows plugins and themes to modify the placeholder image.
       *
       * @since 1.0.0
       *
       * @param string The URL to the placeholder image
       */
        return apply_filters(
            'lazyload_images_placeholder_image',
            \WpStarter\Template::assetPath('images/trans.gif')
        );
    }

    private static function flattenKsesHairData($attributes)
    {
        $flattened_attributes = array();
        foreach ($attributes as $name => $attribute) {
            $flattened_attributes[$name] = $attribute['value'];
        }
        return $flattened_attributes;
    }

    private static function buildAttributesString($attributes)
    {
        $string = array();
        foreach ($attributes as $name => $value) {
            if ('' === $value) {
                $string[] = sprintf('%s', $name);
            } else {
                $string[] = sprintf('%s="%s"', $name, esc_attr($value));
            }
        }
        return implode(' ', $string);
    }
}
