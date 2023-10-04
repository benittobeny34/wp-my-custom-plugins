<?php

namespace Cartrabbit\DeleteDraftDaily\App\Hooks;

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
        add_action('wp_enqueue_scripts', function () {
        });
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_script('my-plugin-script', '/wp-content/plugins/send-grid-mail/build/index.js', array('wp-element'), '1.0.0', true);
            wp_enqueue_style('my-plugin-css', '/wp-content/plugins/send-grid-mail/build/index.css');
        });

    }
}