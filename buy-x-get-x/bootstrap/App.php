<?php


namespace Cartrabbit\BuyXGetX\Bootstrap;


class App
{

    public static $app;

    public function bootPlugin()
    {

    }

    public static function instance()
    {
        if (!isset(self::$app)) {
            self::$app = new static();
        }

        return self::$app;
    }

    /**
     * Bootstrap plugin
     */
    public function bootstrap()
    {
        Setup::init();

        add_action('plugins_loaded', function () {
            do_action('cuw_before_init');

            do_action('cuw_after_init');
        }, 1);
    }
}