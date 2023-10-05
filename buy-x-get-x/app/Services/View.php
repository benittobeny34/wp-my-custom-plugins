<?php

namespace Cartrabbit\BuyXGetX\App\Services;

use Cartrabbit\Postmark\App\Helpers\Functions;
use Cartrabbit\Postmark\Bootstrap\App;

class View
{
    public static function instance()
    {
        return new static();
    }

    public static function render($path, $data = [])
    {
        return static::instance()->view($path, array_merge(['app' => App::instance()], $data));
    }

    public function view($path, $data, $print = true)
    {
        $file = BUY_X_GET_X_PREFIX_PLUGIN_PATH . 'resources/' . $path . '.php';
        return Functions::renderTemplate($file, $data);
    }
}