<?php

namespace Cartrabbit\Postmark\App\Controllers;

use Cartrabbit\Postmark\App\Services\View;

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