<?php

namespace Cartrabbit\BuyXGetX\Core\Hooks;

use Cartrabbit\BuyXGetX\Core\App;
use Cartrabbit\BuyXGetX\Core\Helpers\PluginHelper;

class AdminHooks extends RegisterHooks
{
    public static function register()
    {
        $path = PluginHelper::pluginRoutePath();

        $hooks = require_once("{$path}/free/admin.php");
        //registering action hooks
        static::bindActions($hooks['actions']);
        static::bindFilters($hooks['filters']);

        if (App::make()->get('is_pro_plugin')) {
            $hooks = require_once("{$path}/pro/admin.php");
            //registering action hooks
            static::bindActions($hooks['actions']);
            static::bindFilters($hooks['filters']);

        }
    }

    public static function init()
    {

    }

    public static function head()
    {

    }

    public static function addMenu()
    {
        //Add Admin Menu if want
//        add_menu_page(
//            esc_html__("Post Mark", 'my_plugin_page'),
//            esc_html__("Post Mark", 'my_plugin_page'),
//            'manage_options',
//            'buy_x_get_x',
//            [PageController::class, 'show'],
//            'dashicons-cart',
//            56
//        );
    }
}