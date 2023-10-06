<?php

namespace Cartrabbit\BuyXGetX\App\Hooks;

use Cartrabbit\BuyXGetX\App\App;
use Cartrabbit\BuyXGetX\App\Helpers\PluginHelper;

class AdminHooks extends RegisterHooks
{
    public static function register()
    {
        static::registerCoreHooks('admin-hooks.php');

        if (cartrabbit_buy_x_get_x()->get('is_pro_plugin')) {
            static::registerProHooks('admin-hooks.php');
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