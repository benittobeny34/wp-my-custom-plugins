<?php

//All routes actions will be performed in Route::handleAuthRequest method.

use Cartrabbit\BuyXGetX\App\Hooks\AdminHooks;

$actions = [
    'admin_init' => ['callable' => [AdminHooks::class, 'init'], 'priority' => 10, 'accepted_args' => 1],
    'admin_head' => ['callable' => [AdminHooks::class, 'head'], 'priority' => 10, 'accepted_args' => 1],
    'admin_menu' => ['callable' => [AdminHooks::class, 'addMenu'], 'priority' => 10, 'accepted_args' => 1],
];

$filters = [

];

return [
    'actions' => $actions,
    'filters' => $filters
];