<?php
/**
 *  Plugin Name:           Cartrabbit-Delete-Draft-Daily
 *   Description:          Deleting Draft Posts Daily
 *   Version:              1.0.0
 *   Requires at least:    5.3
 *   Requires PHP:         5.6
 *   Author:               Benitto
 *   Author URI:           https://www.benitto.org
 *   Text Domain:          benitto.org
 *   Domain Path:          /i18n/languages
 *   License:              GPL v3 or later
 *   License URI:          https://www.gnu.org/licenses/gpl-3.0.html
 *
 * WC requires at least: 4.3
 * WC tested up to:      8.0
 */


defined('ABSPATH') or exit;

defined('CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_PATH') or define('CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_PATH', plugin_dir_path(__FILE__));
defined('CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_FILE') or define('CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_FILE', __FILE__);
defined('CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_NAME') or define('CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_NAME', "Cartrabbit-postmark");
defined('CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_SLUG') or define('CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_SLUG', "cartrabbit_postmark");
defined('CB_DELETE_DRAFT_DAILY_PREFIX_VERSION') or define('CB_DELETE_DRAFT_DAILY_PREFIX_VERSION', "1.0");
defined('CB_DELETE_DRAFT_DAILY_PREFIX_PREFIX') or define('CB_DELETE_DRAFT_DAILY_PREFIX_PREFIX', "prefix_");


// To load PSR4 autoloader
if (file_exists(CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_PATH . '/vendor/autoload.php')) {
    require CB_DELETE_DRAFT_DAILY_PREFIX_PLUGIN_PATH . '/vendor/autoload.php';
} else {
    wp_die('{plugin_name} is unable to find the autoload file.');
}

require __DIR__ . '/bootstrap/bootstrap.php';


