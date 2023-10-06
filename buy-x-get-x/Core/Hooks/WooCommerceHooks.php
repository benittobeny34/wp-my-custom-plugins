<?php

namespace Cartrabbit\BuyXGetX\Core\Hooks;

use Cartrabbit\BuyXGetX\Core\App;
use Cartrabbit\BuyXGetX\Core\Helpers\PluginHelper;

class WooCommerceHooks extends RegisterHooks
{
    public static function register()
    {
        $path = PluginHelper::pluginRoutePath();
        $hooks = require_once("{$path}/free/woocommerce-hooks.php");

        //registering action hooks
        static::bindActions($hooks['actions']);
        static::bindFilters($hooks['filters']);

        if (cartrabbit_buy_x_get_x()->get('is_pro_plugin')) {
            $hooks = require_once("{$path}/pro/woocommerce-hooks.php");
            //registering action hooks
            static::bindActions($hooks['actions']);
            static::bindFilters($hooks['filters']);
        }
    }

}