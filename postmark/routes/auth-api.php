<?php


use Cartrabbit\Postmark\App\Controllers\PostMarkController;

//All routes actions will be performed in Route::handleAuthRequest method.
return [
    //define your route actions here
    'save_post_mark_settings' => [PostMarkController::class, 'savePostMarkSettings'],
    'get_post_mark_settings' => [PostMarkController::class, 'getPostMarkSettings'],
    'post_mark_get_bounces' => [PostMarkController::class, 'listBounces'],
    'post_bounces' => [PostMarkController::class, 'postBounces'],
];