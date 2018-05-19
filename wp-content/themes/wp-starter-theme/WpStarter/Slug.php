<?php

namespace WpStarter;

/**
 * Class Slug
 * @package WpStarter
 *
 * Use this class register new slug
 */
class Slug
{

    /**
     * slugs
     *
     * Format array('rule', 'query', 'template path relative to theme')
     */
    private $slugs = array();

    public function __construct()
    {
        add_filter('init', array($this, 'registerSlug'));
        add_filter('query_vars', array($this, 'filterQuery'));
        add_filter('template_include', array($this, 'includeTemplate'));
        add_action('after_switch_theme', array($this, 'flushRewrite'));
    }

    /**
     * registerSlug
     *
     * @return void
     */
    public function registerSlug()
    {
        foreach ($this->slugs as $slug) {
            $options = explode(",", $slug[0]);
            add_rewrite_rule($options[0], $options[1], $options[2]);
        }
    }
    /**
     * filterQuery
     *
     * @param mixed $vars
     * @return void
     */
    public function filterQuery($vars)
    {
        foreach ($this->slugs as $slug) {
            $vars[] = $slug[1];
        }
        return $vars;
    }
    /**
     * includeTemplate
     *
     * @param mixed $template
     * @return void
     */
    public function includeTemplate($template)
    {
        global $wp_query;
        foreach ($this->slugs as $slug) {
            if (array_key_exists($slug[1], $wp_query->query_vars)) {
                $template = get_template_directory() . '/' . $slug[2];
            }
        }
        return $template;
    }
    /**
     * flushRewrite
     *
     * @return void
     */
    public function flushRewrite()
    {
        flush_rewrite_rules(true);
    }
}
