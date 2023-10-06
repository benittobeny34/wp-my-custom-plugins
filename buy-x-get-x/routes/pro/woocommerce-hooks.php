<?php


//All routes actions will be performed in Route::handleAuthRequest method.

use Cartrabbit\BuyXGetX\App\Pro\Controllers\HooksController\WooCommerce\CouponController;

$actions = [
    'woocommerce_calculate_totals' => ['callable' => [CouponController::class, 'applyCouponIfExist'], 'priority' => 10, 'accepted_args' => 4],
    'woocommerce_init' => ['callable' => [CouponController::class, 'setCouponInSession'], 'priority' => 10, 'accepted_args' => 1],
];

$filters = [
    //filters
];

return [
    'actions' => $actions,
    'filters' => $filters
];