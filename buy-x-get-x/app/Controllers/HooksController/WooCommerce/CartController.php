<?php

namespace Cartrabbit\BuyXGetX\App\Controllers\HooksController\WooCommerce;

class CartController
{

    public static function duplicateProductAndAddToCart($cart_item_key, $product_id, $quantity, $variation_id, $variation, $cart_item_data)
    {
        $isBuyXGetXEnabled = get_post_meta($product_id, '_buy_x_get_x', true);

        if (!$isBuyXGetXEnabled) return $cart_item_data;

        //This check important otherwise it leads to infinite loop
        if (isset($cart_item_data['cartrabbit_buy_x_get_x']['free_product']) && $cart_item_data['cartrabbit_buy_x_get_x']['free_product']) {
            return $cart_item_data;
        }


        $cart_item_data['cartrabbit_buy_x_get_x']['free_product'] = 1;
        $cart_item_data['cartrabbit_buy_x_get_x']['reference_cart_item_key'] = $cart_item_key;


        //If the product is Already added remove the cart item and again add it.
        foreach (WC()->cart->get_cart() as $cart_key => $cart_data) {
            if (isset($cart_data['cartrabbit_buy_x_get_x']['free_product']) && $cart_data['cartrabbit_buy_x_get_x']['free_product']) {
                if (isset($cart_data['cartrabbit_buy_x_get_x']['reference_cart_item_key']) && $cart_data['cartrabbit_buy_x_get_x']['reference_cart_item_key'] == $cart_item_key) {

                    //The Reason why we are returning here is becaue if the cart key is existing already it will be handled in woocommerce_after_cart_item_quantity_update hook
                    return;
                }
            }
        }

        // Add the free product to the cart with the same quantity.
        WC()->cart->add_to_cart($product_id, $quantity, $variation_id, $variation, $cart_item_data);

        return $cart_item_data;
    }

    public static function updatePricesIfCartItemHasBuyXGetXEnabled($cart)
    {
        foreach ($cart->get_cart() as $cart_item_data) {
            if (isset($cart_item_data['cartrabbit_buy_x_get_x']['free_product']) && $cart_item_data['cartrabbit_buy_x_get_x']['free_product']) {
                $cart_item_data['data']->set_price(0);
            }
        }
    }

    public static function disableCartItemQuantityIfFree($product_quantity, $cart_item_key, $cart_item_data)
    {
        if (isset($cart_item_data['cartrabbit_buy_x_get_x']['free_product']) && $cart_item_data['cartrabbit_buy_x_get_x']['free_product']) {
            return "<span>{$cart_item_data['quantity']}</span>";
        }

        return $product_quantity;
    }

    public static function removeIconHtml($html, $cart_item_key)
    {
        $cart_item_data = WC()->cart->get_cart_item($cart_item_key);

        if (isset($cart_item_data['cartrabbit_buy_x_get_x']['free_product']) && $cart_item_data['cartrabbit_buy_x_get_x']['free_product']) {
            return '';
        }

        return $html;
    }

    public static function updateQuantityInFreeProductAsWell($cart_item_key, $quantity, $old_quantity, $that)
    {

        $updated_cart_item = WC()->cart->get_cart_item($cart_item_key);

        $productId = $updated_cart_item['product_id'];

        $isBuyXGetXEnabled = get_post_meta($productId, '_buy_x_get_x', true);

        //If the updated Cart Item Product is not a Buy X Get X Product we just simply return it.
        if (!$isBuyXGetXEnabled) return;

        foreach (WC()->cart->get_cart() as $cart_key => $cart_item_data) {

            if (isset($cart_item_data['cartrabbit_buy_x_get_x']['free_product']) && $cart_item_data['cartrabbit_buy_x_get_x']['free_product']) {
                if (isset($cart_item_data['cartrabbit_buy_x_get_x']['reference_cart_item_key']) && $cart_item_data['cartrabbit_buy_x_get_x']['reference_cart_item_key'] == $cart_item_key) {
                    WC()->cart->set_quantity($cart_key, $quantity);
                }
            }
        }
    }

    public static function deleteFreeCartItemIfItsFreeProduct($cart_item_key, $cart)
    {
        $cart_item = WC()->cart->get_cart_item($cart_item_key);

        $productId = $cart_item['product_id'];

        $isBuyXGetXEnabled = get_post_meta($productId, '_buy_x_get_x', true);

        //If the updated Cart Item Product is not a Buy X Get X Product we just simply return it.
        if (!$isBuyXGetXEnabled) return;

        foreach ($cart->get_cart() as $cart_key => $cart_item_data) {
            if (isset($cart_item_data['cartrabbit_buy_x_get_x']['free_product']) && $cart_item_data['cartrabbit_buy_x_get_x']['free_product']) {
                if (isset($cart_item_data['cartrabbit_buy_x_get_x']['reference_cart_item_key']) && $cart_item_data['cartrabbit_buy_x_get_x']['reference_cart_item_key'] == $cart_item_key) {
                    WC()->cart->remove_cart_item($cart_key);
                }
            }
        }
    }
}