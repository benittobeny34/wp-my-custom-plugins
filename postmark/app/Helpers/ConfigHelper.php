<?php

namespace Cartrabbit\Postmark\App\Helpers;

class ConfigHelper
{
    /**
     * To hold local config data.
     *
     * @var array
     */
    private static $config;

    /**
     * Get config from local or options table.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public static function get($key, $default = false)
    {
    }

    /**
     * Set config to options table.
     *
     * @param string $key
     * @param mixed $value
     * @return bool
     */
    public static function set($key, $value)
    {
    }
}