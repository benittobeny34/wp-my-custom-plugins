<?php
/**
 * Checkout Upsell for WooCommerce
 *
 * @package   checkout-upsell-woocommerce
 * @author    Anantharaj B <anantharaj@flycart.org>
 * @copyright 2023 Flycart
 * @license   GPL-3.0-or-later
 * @link      https://flycart.org
 */

namespace Cartrabbit\Postmark\App\Helpers;

defined('ABSPATH') or exit;

class Functions
{
    /**
     * Render template file
     *
     * @param string $file
     * @param array $data
     * @return false|string
     */
    public static function renderTemplate($file, $data = [])
    {
        if (file_exists($file)) {
            ob_start();
            extract($data);
            include $file;
            return ob_get_clean();
        }
        return false;
    }

    public static function snakeCaseToCamelCase($string)
    {
        return lcfirst(str_replace(' ', '', ucwords(str_replace('_', ' ', $string))));
    }
}