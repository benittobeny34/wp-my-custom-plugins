<?php

namespace Cartrabbit\BuyXGetX\Core;

use Cartrabbit\BuyXGetX\Core\Helpers\PluginHelper;
use Cartrabbit\BuyXGetX\Core\Hooks\AdminHooks;
use Cartrabbit\BuyXGetX\Core\Hooks\CustomHooks;
use Cartrabbit\BuyXGetX\Core\Hooks\WooCommerceHooks;
use Cartrabbit\BuyXGetX\Core\Helpers\Functions;
use Cartrabbit\BuyXGetX\Core\Helpers\WordpressHelper;
use Cartrabbit\BuyXGetX\Core\Hooks\AssetsActions;

class Route
{
    //declare the below constants with unique refernce for your plugin
    const AJAX_NAME = 'auth_ajax';
    const AJAX_NO_PRIV_NAME = 'nopriv_prefix_ajax';

    public static function register()
    {
        add_action('wp_ajax_' . static::AJAX_NAME, [__CLASS__, 'handleAuthRequests']);
        add_action('wp_ajax_' . static::AJAX_NO_PRIV_NAME, [__CLASS__, 'handleGuestRequests']);

        //if we use admin it only take effect in dashboard page
//        if (is_admin()) {
        AdminHooks::register();
        AssetsActions::register();
        WooCommerceHooks::register();
        CustomHooks::register();
//        }
    }

    public static function handleAuthRequests()
    {

        $method = $_REQUEST['method'];

        $_nonce = $_REQUEST['_wp_nonce'];

        static::verifyNonce($_nonce); // to verify nonce

        //loading auth routes
        $handlers = require_once(PluginHelper::pluginRoutePath() . '/free/auth-api.php');


        if (!empty($method) && isset($handlers[$method]) && is_callable($handlers[$method])) {
            return wp_send_json_success(call_user_func($handlers[$method]));
        }

        return wp_send_json_error(['message' => 'Method not exists']);
    }

    public static function handleGuestRequests()
    {

        $method = $_REQUEST['method'];

        $camel = Functions::snakeCaseToCamelCase($method);

        //loading guest routes
        $handlers = include(__DIR__ . '/../routes/free/guest-api.php');

        if (!empty($method) && isset($handlers[$method]) && is_callable($handlers[$method])) {
            wp_send_json_success(call_user_func($handlers[$method]));
        }

        wp_send_json_error(['message' => __("Method not exists.", 'checkout-upsell-woocommerce')]);
    }

    private static function verifyNonce($nonce = '')
    {
        if (empty($nonce) || !WordpressHelper::verifyNonce($nonce, 'auth_ajax')) {
            wp_send_json_error(['message' => 'Security Check Failed']);
        }
    }

}