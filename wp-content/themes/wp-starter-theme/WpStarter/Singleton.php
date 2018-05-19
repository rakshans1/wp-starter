<?php
namespace WpStarter;

trait Singleton
{
    private static $Instance;
    final public static function getInstance()
    {
        if (!self::$Instance) {
            self::$Instance = new self;
            self::$Instance->init();
        }
        return self::$Instance;
    }
}
