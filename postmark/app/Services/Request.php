<?php

namespace Cartrabbit\Postmark\App\Services;


class Request
{
    protected static $request;

    public static function instance()
    {
        if (!isset(self::$request)) {
            //Going to be use symphonyRequest component From packagist
        }
        return self::$request;
    }
}