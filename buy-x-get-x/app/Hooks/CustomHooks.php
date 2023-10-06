<?php

namespace Cartrabbit\BuyXGetX\App\Hooks;

use Cartrabbit\BuyXGetX\App\App;
use Cartrabbit\BuyXGetX\App\Helpers\PluginHelper;

class CustomHooks extends RegisterHooks
{
    public static function register()
    {
        static::registerCoreHooks('custom-hooks.php');

        if (cartrabbit_buy_x_get_x()->get('is_pro_plugin')) {
            static::registerProHooks('custom-hooks.php');
        }
    }
}