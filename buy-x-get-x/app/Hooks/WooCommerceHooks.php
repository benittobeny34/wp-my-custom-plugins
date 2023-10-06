<?php

namespace Cartrabbit\BuyXGetX\App\Hooks;

use Cartrabbit\BuyXGetX\App\Helpers\PluginHelper;

class WooCommerceHooks extends RegisterHooks
{
    public static function register()
    {
        static::registerCoreHooks('woocommerce-hooks.php');

        if (cartrabbit_buy_x_get_x()->get('is_pro_plugin')) {
            static::registerProHooks('woocommerce-hooks.php');
        }
    }
}