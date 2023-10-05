<?php

namespace Cartrabbit\BuyXGetX\App\Hooks;

use Cartrabbit\BuyXGetX\App\Helpers\PluginHelper;

class CustomHooks extends RegisterHooks
{
    public static function register()
    {

        $path = PluginHelper::pluginRoutePath();
        $handlers = require_once("{$path}/custom-hooks.php");
        static::bindHooksToMethods($handlers);
    }
}