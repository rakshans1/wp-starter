<?php

/**
 * This file contains a class for theme helper
 */


namespace WpStarter;

/**
 * Class Helpers
 *
 * @package WpStarter
 * @author  WisdmLabs
 * @since   1.0.0
 *
 * Defines helper methods used by Wp
 */

class Helpers
{
    /**
     * This method sets env is proxy is present
     *
     * @since  1.0.0
     * @access public
     * @return string
     */
    public static function setWpEnv()
    {
        if (isset($_SERVER['HTTP_X_WP_PROXY'])) {
            define('WP_DEV_ENV', true);
        }
    }

    public static function trim($string, $length, $trimmarker = '...')
    {
        $strlen = strlen($string);
        $string = trim(mb_substr($string, 0, $strlen));
        if ($strlen > $length) {
            preg_match('/^.{1,' . ($length - strlen($trimmarker)) . '}\b/su', $string, $match);
            $string = trim($match['0']) . $trimmarker;
        } else {
            $string = trim($string);
        }
        return $string;
    }
}
