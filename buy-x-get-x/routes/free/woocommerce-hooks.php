<?php

//All routes actions will be performed in Route::handleAuthRequest method.
use Cartrabbit\BuyXGetX\App\Free\Controllers\HooksController\WooCommerce\CartController;
use Cartrabbit\BuyXGetX\App\Free\Controllers\HooksController\WooCommerce\ProductController;

$actions = [
    //define your woocommerce actions and filters here
    'woocommerce_product_options_general_product_data' => ['callable' => [ProductController::class, 'showBuyXGetXCheckBox'], 'priority' => 10, 'accepted_args' => 1],
    'woocommerce_process_product_meta' => ['callable' => [ProductController::class, 'saveBuyXGetXData'], 'priority' => 10, 'accepted_args' => 1],
    'woocommerce_product_meta_end' => ['callable' => [ProductController::class, 'notifyBuyXGetX'], 'priority' => 10, 'accepted_args' => 1],

    'woocommerce_before_calculate_totals' => function () {
        return [
            ['callable' => [CartController::class, 'updatePricesIfCartItemHasBuyXGetXEnabled'], 'priority' => 10, 'accepted_args' => 1],
        ];
    },

    'woocommerce_after_cart_item_quantity_update' => ['callable' => [CartController::class, 'updateQuantityInFreeProductAsWell'], 'priority' => 10, 'accepted_args' => 4],
    'woocommerce_remove_cart_item' => ['callable' => [CartController::class, 'deleteFreeCartItemIfItsFreeProduct'], 'priority' => 10, 'accepted_args' => 2],
    'woocommerce_add_to_cart' => function () {
        return [
            ['callable' => [CartController::class, 'duplicateProductAndAddToCart'], 'priority' => 10, 'accepted_args' => 6],
        ];
    },
];

$filters = [
    'woocommerce_cart_item_quantity' => ['callable' => [CartController::class, 'disableCartItemQuantityIfFree'], 'priority' => 10, 'accepted_args' => 3],
    'woocommerce_cart_item_remove_link' => ['callable' => [CartController::class, 'removeIconHtml'], 'priority' => 10, 'accepted_args' => 2],

];

return [
    'actions' => $actions,
    'filters' => $filters
];