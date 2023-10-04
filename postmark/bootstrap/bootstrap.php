<?php

namespace Cartrabbit\Postmark\Bootstrap;

use Cartrabbit\Postmark\Bootstrap\App;

// Define plugin constants


defined('ABSPATH') or exit;


//here __FILE__ Will Return the Included File Path so it the base of the starting point.
// To bootstrap the plugin
if (class_exists('Cartrabbit\Postmark\Bootstrap\App')) {
    $prefix_app = App::instance();
    $prefix_app->bootstrap(); // to load the plugin
} else {
    wp_die('Plugin is unable to find the App class.');
}
