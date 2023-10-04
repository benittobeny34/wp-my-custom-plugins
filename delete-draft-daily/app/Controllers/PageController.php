<?php

namespace Cartrabbit\DeleteDraftDaily\App\Controllers;

use Cartrabbit\DeleteDraftDaily\App\Services\View;

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