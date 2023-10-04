<?php
/**
 * Plugin Name:          Cartrabbit-postmark
 * Description:          Develop sAmple Plugin
 * Version:              1.0.0
 * Requires at least:    5.3
 * Requires PHP:         5.6
 * Author:               Benitto
 * Author URI:           https://www.benitto.org
 * Text Domain:          benitto.org
 * Domain Path:          /i18n/languages
 * License:              GPL v3 or later
 * License URI:          https://www.gnu.org/licenses/gpl-3.0.html
 *
 * WC requires at least: 4.3
 * WC tested up to:      8.0
 */


defined('ABSPATH') or exit;

defined('SP_PREFIX_PLUGIN_PATH') or define('SP_PREFIX_PLUGIN_PATH', plugin_dir_path(__FILE__));
defined('SP_PREFIX_PLUGIN_FILE') or define('SP_PREFIX_PLUGIN_FILE', __FILE__);
defined('SP_PREFIX_PLUGIN_NAME') or define('SP_PREFIX_PLUGIN_NAME', "Cartrabbit-postmark");
defined('SP_PREFIX_PLUGIN_SLUG') or define('SP_PREFIX_PLUGIN_SLUG', "cartrabbit_postmark");
defined('SP_PREFIX_VERSION') or define('SP_PREFIX_VERSION', "1.0");
defined('SP_PREFIX_PREFIX') or define('SP_PREFIX_PREFIX', "prefix_");


// To load PSR4 autoloader
if (file_exists(SP_PREFIX_PLUGIN_PATH . '/vendor/autoload.php')) {
    require SP_PREFIX_PLUGIN_PATH . '/vendor/autoload.php';
} else {
    wp_die('{plugin_name} is unable to find the autoload file.');
}

require __DIR__ . '/bootstrap/bootstrap.php';


