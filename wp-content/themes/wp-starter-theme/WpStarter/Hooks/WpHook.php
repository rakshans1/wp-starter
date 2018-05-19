<?php

namespace WpStarter\Hooks;

/**
 * Interface WpHooks
 * @package WpStarter\Hooks
 */
interface WpHook
{
    /**
     * Method used to run call Hooks after instantiating
     */
    public function hook();
}
