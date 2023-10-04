<?php


use Cartrabbit\DeleteDraftDaily\App\Controllers\MailGunController;

//All routes actions will be performed in Route::handleAuthRequest method.
return [
    //define your route actions here
    'send_email_via_mail_gun' => [MailGunController::class, 'sendEmail'],
];