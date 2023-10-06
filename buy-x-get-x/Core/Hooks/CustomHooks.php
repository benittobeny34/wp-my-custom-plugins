<?php

namespace Cartrabbit\BuyXGetX\Core\Hooks;

use Cartrabbit\BuyXGetX\Core\App;
use Cartrabbit\BuyXGetX\Core\Helpers\PluginHelper;

class CustomHooks extends RegisterHooks
{
    public static function register()
    {
        $path = PluginHelper::pluginRoutePath();
        $hooks = require("{$path}/free/custom-hooks.php");

        //registering action hooks
        static::bindActions($hooks['actions']);
        static::bindFilters($hooks['filters']);

        if (App::make()->get('is_pro_plugin')) {
            $hooks = require("{$path}/pro/custom-hooks.php");

            //registering action hooks
            static::bindActions($hooks['actions']);
            static::bindFilters($hooks['filters']);
        }
    }
}