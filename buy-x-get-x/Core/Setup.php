<?php

namespace Cartrabbit\BuyXGetX\Core;
class Setup
{
    /**
     * Init setup
     */
    public static function init()
    {
        register_activation_hook(BUY_X_GET_X_PREFIX_PLUGIN_FILE, [__CLASS__, 'activate']);
        register_deactivation_hook(BUY_X_GET_X_PREFIX_PLUGIN_FILE, [__CLASS__, 'deactivate']);
        register_uninstall_hook(BUY_X_GET_X_PREFIX_PLUGIN_FILE, [__CLASS__, 'uninstall']);

        add_action('plugins_loaded', [__CLASS__, 'maybeRunMigration']);
        add_action('upgrader_process_complete', [__CLASS__, 'maybeRunMigration']);

        Route::register();
    }

    /**
     * Run plugin activation scripts
     */
    public static function activate()
    {
        self::maybeRunMigration();
    }

    /**
     * Run plugin activation scripts
     */
    public static function deactivate()
    {
    }

    /**
     * Run plugin activation scripts
     */
    public static function uninstall()
    {
        // silence is golden
    }

    /**
     * Maybe run database migration
     */
    public static function maybeRunMigration()
    {
        if (!is_admin()) {
            return;
        }

        //run migration if you need
    }

    /**
     * Run database migration
     */
    private static function runMigration()
    {
        $models = [
            //list of models to run migrations
        ];

        foreach ($models as $model) {
            $model->create();
        }
    }
}