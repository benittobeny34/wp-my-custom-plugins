<?php


namespace Cartrabbit\BuyXGetX\App;


class App extends Container
{

    public static $app;

    public static function make(): static
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