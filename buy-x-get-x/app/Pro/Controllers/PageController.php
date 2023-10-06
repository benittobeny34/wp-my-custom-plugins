<?php

namespace Cartrabbit\BuyXGetX\App\Pro\Controllers;


use Cartrabbit\BuyXGetX\Core\Services\View;

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