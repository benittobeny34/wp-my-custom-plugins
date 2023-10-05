<?php

namespace Cartrabbit\BuyXGetX\App\Hooks;

class RegisterHooks
{

    public static function bindHooksToMethods($handlers): void
    {
        foreach ($handlers as $name => $handler) {
            if (is_callable($handler)) {
                $nestedHandlers = $handler();
                foreach ($nestedHandlers as $nestedHandler) {
                    static::bind($name, $nestedHandler);
                }
            } else {
                static::bind($name, $handler);
            }
        }
    }

    public static function bind($name, $handler): void
    {
        if (isset($handler['type']) && is_callable($handler['callable'])) {
            if ($handler['type'] == 'action') {
                add_action($name, $handler['callable'], $handler['priority'], $handler['accepted_args']);
            } else if ($handler['type'] == 'filter') {
                add_filter($name, $handler['callable'], $handler['priority'], $handler['accepted_args']);
            } else {
                wp_die("The handler either should be action or filter when registering");
            }
        } else {
            if (isset($handler['type'])) {
                wp_die("Error While Registering {$name} Not Callable");
            } else {
                wp_die("Error While Registering {$name}");
            }
        }
    }


}