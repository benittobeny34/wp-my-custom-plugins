<?php

/**
 * Plugin Name:          Woo-Commerce-Buy-X-Get-X
 * Description:          Buy X Product and Get X Same Product
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


use Cartrabbit\BuyXGetX\Core\App;

defined('ABSPATH') or exit;

defined('BUY_X_GET_X_PREFIX_PLUGIN_PATH') or define('BUY_X_GET_X_PREFIX_PLUGIN_PATH', plugin_dir_path(__FILE__));
defined('BUY_X_GET_X_PREFIX_PLUGIN_FILE') or define('BUY_X_GET_X_PREFIX_PLUGIN_FILE', __FILE__);
defined('BUY_X_GET_X_PREFIX_PLUGIN_NAME') or define('BUY_X_GET_X_PREFIX_PLUGIN_NAME', "Buy X Get X");
defined('BUY_X_GET_X_PREFIX_PLUGIN_SLUG') or define('BUY_X_GET_X_PREFIX_PLUGIN_SLUG', "Buy X Get X");
defined('BUY_X_GET_X_PREFIX_VERSION') or define('BUY_X_GET_X_PREFIX_VERSION', "1.0");
defined('BUY_X_GET_X_PREFIX_PREFIX') or define('BUY_X_GET_X_PREFIX_PREFIX', "prefix_");


// To load PSR4 autoloader
if (file_exists(BUY_X_GET_X_PREFIX_PLUGIN_PATH . '/vendor/autoload.php')) {
    require BUY_X_GET_X_PREFIX_PLUGIN_PATH . '/vendor/autoload.php';
} else {
    wp_die('{plugin_name} is unable to find the autoload file.');
}

defined('ABSPATH') or exit;

if (!function_exists('cartrabbit_buy_x_get_x')) {
    function cartrabbit_buy_x_get_x(): App
    {
        return App::make();
    }
}

//here __FILE__ Will Return the Included File Path so it the base of the starting point.
// To bootstrap the plugin
if (class_exists('Cartrabbit\BuyXGetX\Core\App')) {
    $app = cartrabbit_buy_x_get_x();
    //Check Whether it is PRO USER
//    $isPro = $app->set('is_pro_plugin', true);

    $app->bootstrap(); // to load the plugin
} else {
    wp_die('Plugin is unable to find the App class.');
}


