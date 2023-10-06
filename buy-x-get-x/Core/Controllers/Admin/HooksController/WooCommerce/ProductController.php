<?php

namespace Cartrabbit\BuyXGetX\Core\Controllers\Admin\HooksController\WooCommerce;


class ProductController
{
    public static function showBuyXGetXCheckBox()
    {
        global $post;

        $value = get_post_meta($post->ID, '_buy_x_get_x', true);
        woocommerce_wp_checkbox(array(
            'id' => '_buy_x_get_x',
            'label' => 'Enable Buy X Get X',
            'description' => 'Enable this to provide Buy X Get X',
            'desc_tip' => 'true',
            'cbvalue' => 1,
            'value' => $value
        ));
    }

    public static function saveBuyXGetXData($post_id)
    {
        $custom_checkbox_value = isset($_POST['_buy_x_get_x']) ? 1 : 0;
        // Update the product's post meta with the checkbox value
        update_post_meta($post_id, '_buy_x_get_x', $custom_checkbox_value);
    }

    public static function notifyBuyXGetX($value)
    {
        echo "<p>Buy X and Get X Enabled</p>";
    }
}