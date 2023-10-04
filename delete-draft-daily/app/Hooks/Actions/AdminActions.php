<?php

namespace Cartrabbit\DeleteDraftDaily\App\Hooks\Actions;

use Cartrabbit\DeleteDraftDaily\App\Controllers\PageController;

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

        add_menu_page(
            esc_html__("CartRabbit SendGrid", 'cb_send_grid_custom_mail'),
            esc_html__("CartRabbit SendGrid", 'cb_send_grid_custom_mail'),
            'manage_options',
            'cb_send_grid_custom_mail',
            [PageController::class, 'show'],
            'dashicons-cart',
            56
        );
    }
}