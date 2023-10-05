<?php

namespace Cartrabbit\BuyXGetX\Bootstrap;

use Cartrabbit\BuyXGetX\Bootstrap\App;

// Define plugin constants


defined('ABSPATH') or exit;


//here __FILE__ Will Return the Included File Path so it the base of the starting point.
// To bootstrap the plugin
if (class_exists('Cartrabbit\BuyXGetX\Bootstrap\App')) {
    $prefix_app = App::instance();
    $prefix_app->bootstrap(); // to load the plugin
} else {
    wp_die('Plugin is unable to find the App class.');
}
