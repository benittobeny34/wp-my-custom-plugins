<?php

namespace Cartrabbit\BuyXGetX\App\Hooks;

use Cartrabbit\BuyXGetX\App\Helpers\PluginHelper;

class WooCommerceHooks extends RegisterHooks
{
    public static function register()
    {
        $path = PluginHelper::pluginRoutePath();
        $handlers = require_once("{$path}/woocommerce-hooks.php");
        static::bindHooksToMethods($handlers);
    }

}