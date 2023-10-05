<?php

namespace Cartrabbit\BuyXGetX\App\Hooks;

use Cartrabbit\BuyXGetX\App\Helpers\PluginHelper;

class WooCommerceHooks
{
    public static function register()
    {
        $path = PluginHelper::pluginRoutePath();

        $handlers = require_once("{$path}/woocommerce-hooks.php");

        foreach ($handlers as $name => $handler) {
            if (isset($handler['type']) && is_callable($handler['callable'])) {
                if ($handler['type'] == 'action') {
                    add_action($name, $handler['callable'], $handler['priority'], $handler['accepted_args']);
                } else if ($handler['type'] == 'filter') {
                    add_filter($name, $handler['callable'], $handler['priority'], $handler['accepted_args']);
                } else {
                    wp_die("The handler either should be action or filter when registering");
                }
            } else {
                if (isset($handler['type'])) {
                    wp_die("Error While Registering {$name} Not Callable");
                } else {
                    wp_die("Error While Registering {$name}");
                }
            }
        }
    }
}