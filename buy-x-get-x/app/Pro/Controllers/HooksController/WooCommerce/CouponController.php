<?php

namespace Cartrabbit\BuyXGetX\App\Pro\Controllers\HooksController\WooCommerce;

class CouponController
{
    public static function setCouponInSession()
    {
        if (!isset($_GET['coupon_code'])) {
            return;
        }

        if (!WC()->session) {
            return;
        }

        // Ensure that customer session is started
        if (!WC()->session->has_session())
            WC()->session->set_customer_session_cookie(true);

        // Check and register coupon code in a custom session variable
        $coupon_code = $_GET['coupon_code'];

        WC()->session->set('coupon_code', $coupon_code); // Set the coupon code in session
    }

    public static function applyCouponIfExist()
    {
        $coupon_code = WC()->session->get('coupon_code');

        if (!empty($coupon_code) && !WC()->cart->has_discount($coupon_code)) {
            WC()->cart->add_discount($coupon_code); // apply the coupon discount
            WC()->session->__unset('coupon_code'); // remove coupon code from session
        }
    }
}