<?php

namespace Cartrabbit\DeleteDraftDaily\Bootstrap;

use WP_Query;

class Setup
{

    /**
     * Init setup
     */
    public static function init()
    {
        register_activation_hook(CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_FILE, [__CLASS__, 'activate']);
        register_deactivation_hook(CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_FILE, [__CLASS__, 'deactivate']);
        register_uninstall_hook(CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_FILE, [__CLASS__, 'uninstall']);

        add_action('plugins_loaded', [__CLASS__, 'maybeRunMigration']);
        add_action('upgrader_process_complete', [__CLASS__, 'maybeRunMigration']);

        //register the action when daily draft delete cron event execute
        add_action('delete_drafts_daily_event', [__CLASS__, 'deleteDrafts']);
    }

    /**
     * Run plugin activation scripts
     */
    public static function activate()
    {

        add_filter('cron_schedules', function () {
            $schedules['every_five_minutes'] = array(
                'interval' => 60, // 300 seconds = 1 minute
                'display' => __('Every Minute', 'textdomain')
            );

            return $schedules;
        });

        self::maybeRunMigration();
        if (!wp_next_scheduled('delete_drafts_daily_event')) {
            wp_schedule_event(time(), 'every_five_minutes', 'delete_drafts_daily_event');
        }
    }

    /**
     * Run plugin activation scripts
     */
    public static function deactivate()
    {
        // silence is golden
        wp_clear_scheduled_hook('delete_drafts_daily_event');
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

    public static function deleteDrafts()
    {
        // Delete draft posts
        $args = array(
            'post_type' => 'post', // Change to your post type if needed
            'post_status' => 'draft',
            'posts_per_page' => -1,
        );

        $drafts = new WP_Query($args);

        if ($drafts->have_posts()) {
            while ($drafts->have_posts()) {
                $drafts->the_post();
                wp_delete_post(get_the_ID(), true); // True parameter to move to trash
            }
        }

        wp_reset_postdata();
    }
}