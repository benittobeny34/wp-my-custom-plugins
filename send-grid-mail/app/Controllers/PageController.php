<?php

namespace Cartrabbit\Mail\Custom\App\Controllers;

use Cartrabbit\Mail\Custom\App\Services\View;

class PageController
{
    /*
     *
     * instead of return just use echo when returning page in word-press plugin
     */

    public static function show()
    {
        echo View::render('admin');
    }
}