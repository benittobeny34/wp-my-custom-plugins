<?php

namespace Cartrabbit\BuyXGetX\Core\Helpers;

class PluginHelper
{

    public static function isPRO()
    {
        return cartrabbit_buy_x_get_x()->get('is_pro_plugin');
    }

    public static function pluginBasePath()
    {
        return __DIR__ . '/../buy-x-get-x/';
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