<?php

namespace Cartrabbit\DeleteDraftDaily\App\Services;

use Cartrabbit\DeleteDraftDaily\App\Helpers\Functions;
use Cartrabbit\DeleteDraftDaily\Bootstrap\App;

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
        $file = SG_MAIL_PREFIX_PLUGIN_PATH . 'resources/' . $path . '.php';
        return Functions::renderTemplate($file, $data);
    }
}