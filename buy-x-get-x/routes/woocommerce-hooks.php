<?php


//All routes actions will be performed in Route::handleAuthRequest method.
use Cartrabbit\BuyXGetX\App\Controllers\HooksController\WooCommerce\CartController;
use Cartrabbit\BuyXGetX\App\Controllers\HooksController\WooCommerce\CouponController;
use Cartrabbit\BuyXGetX\App\Controllers\HooksController\WooCommerce\ProductController;

$actions = [
    //define your woocommerce actions and filters here
    'woocommerce_product_options_general_product_data' => ['type' => 'action', 'callable' => [ProductController::class, 'showBuyXGetXCheckBox'], 'priority' => 10, 'accepted_args' => 1],
    'woocommerce_process_product_meta' => ['type' => 'action', 'callable' => [ProductController::class, 'saveBuyXGetXData'], 'priority' => 10, 'accepted_args' => 1],
    'woocommerce_product_meta_end' => ['type' => 'action', 'callable' => [ProductController::class, 'notifyBuyXGetX'], 'priority' => 10, 'accepted_args' => 1],

    'woocommerce_before_calculate_totals' => function () {
        return [
            ['type' => 'action', 'callable' => [CartController::class, 'updatePricesIfCartItemHasBuyXGetXEnabled'], 'priority' => 10, 'accepted_args' => 1],
        ];
    },
    'woocommerce_calculate_totals' => ['type' => 'action', 'callable' => [CouponController::class, 'applyCouponIfExist'], 'priority' => 10, 'accepted_args' => 4],
    'woocommerce_after_cart_item_quantity_update' => ['type' => 'action', 'callable' => [CartController::class, 'updateQuantityInFreeProductAsWell'], 'priority' => 10, 'accepted_args' => 4],
    'woocommerce_remove_cart_item' => ['type' => 'action', 'callable' => [CartController::class, 'deleteFreeCartItemIfItsFreeProduct'], 'priority' => 10, 'accepted_args' => 2],

    'woocommerce_init' => ['type' => 'action', 'callable' => [CouponController::class, 'setCouponInSession'], 'priority' => 10, 'accepted_args' => 1],
    'woocommerce_add_to_cart' => function () {
        return [
            ['type' => 'action', 'callable' => [CartController::class, 'duplicateProductAndAddToCart'], 'priority' => 10, 'accepted_args' => 6],
        ];
    },

    //coupons
];

$filters = [
    'woocommerce_cart_item_quantity' => ['type' => 'filter', 'callable' => [CartController::class, 'disableCartItemQuantityIfFree'], 'priority' => 10, 'accepted_args' => 3],
    'woocommerce_cart_item_remove_link' => ['type' => 'filter', 'callable' => [CartController::class, 'removeIconHtml'], 'priority' => 10, 'accepted_args' => 2],

    //coupons
];

return array_merge($actions, $filters);