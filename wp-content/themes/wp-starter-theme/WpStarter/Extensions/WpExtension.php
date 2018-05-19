<?php

namespace WpStarter\Extensions;

/**
 * Interface WpExtension
 * @package WpStarter\Extensions
 */
interface WpExtension
{
    /**
     * Method used to run call Extension after instantiating
     */
    public function extend();
}
