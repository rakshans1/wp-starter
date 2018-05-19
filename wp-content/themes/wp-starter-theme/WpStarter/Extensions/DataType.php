<?php

namespace WpStarter\Extensions;

/**
 * Class DataType
 * Use this class to register custom post types and taxonomies
 * @package WpStarter\Extensions
 */
class DataType implements WpExtension
{
    public function extend()
    {
        add_action('init', array($this, 'registerPostTypes'));
        add_action('init', array($this, 'registerTaxonomies'));
    }

    /**
     * Use this method to register custom post types
     */
    public function registerPostTypes()
    {
    }

    /**
     * Use this method to register custom taxonomies
     */
    public function registerTaxonomies()
    {
    }
}
