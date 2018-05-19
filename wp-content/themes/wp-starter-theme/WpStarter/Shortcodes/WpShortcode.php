<?php

namespace WpStarter\Shortcodes;

/**
 * Interface WpShortcode
 * @package WpStarter\Shortcodes
 */
interface WpShortcode
{
    /**
     * Method used to run call shortcode after instantiating
     */
    public function shortcode();
}
