<?php

namespace Cartrabbit\BuyXGetX\App\Hooks;

defined('ABSPATH') or exit;

class AssetsActions
{
    public static function register()
    {
        static::enqueue();
    }

    /**
     * Enqueue scripts
     */
    public static function enqueue()
    {
        add_action('admin_enqueue_scripts', [__CLASS__, 'addPluginAssets']);
    }

    public static function addPluginAssets()
    {
//        wp_enqueue_script('my-plugin-script', '/wp-content/plugins/postmark/build/index.js', array('wp-element'), '1.0.0', true);
//        wp_enqueue_style('my-plugin-css', '/wp-content/plugins/postmark/build/index.css');
    }
}