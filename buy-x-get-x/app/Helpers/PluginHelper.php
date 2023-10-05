<?php

namespace Cartrabbit\BuyXGetX\App\Helpers;

class PluginHelper
{
    public static function pluginBasePath()
    {
        return __DIR__ . '/../../';
    }

    public static function pluginControllerPath()
    {
        return __DIR__ . '/../Controllers/';
    }

    public static function pluginRoutePath()
    {
        return __DIR__ . '/../../routes';
    }
}