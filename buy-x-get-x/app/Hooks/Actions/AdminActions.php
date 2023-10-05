<?php

namespace Cartrabbit\BuyXGetX\App\Hooks\Actions;

use Cartrabbit\BuyXGetX\App\Controllers\PageController;

class AdminActions
{
    public static $actions = [
        'admin_init' => ['class' => __CLASS__, 'method' => 'init', 'priority' => 10, 'arg_count' => 1],
        'admin_head' => ['class' => __CLASS__, 'method' => 'head', 'priority' => 10, 'arg_count' => 1],
        'admin_menu' => ['class' => __CLASS__, 'method' => 'addMenu', 'priority' => 10, 'arg_count' => 1],
    ];

    public static function register()
    {
        foreach (static::$actions as $action => $handler) {
            add_action($action, [$handler['class'], $handler['method']], $handler['priority'], $handler['arg_count']);
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