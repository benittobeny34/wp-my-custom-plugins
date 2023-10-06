<?php

namespace Cartrabbit\BuyXGetX\Core\Hooks;

class RegisterHooks
{

    public static function bindActions($actions = []): void
    {
        static::bindHooks($actions, 'action');
    }

    public static function bindFilters($filters = []): void
    {
        static::bindHooks($filters, 'filter');
    }

    private static function bindHooks($hooks = [], $type = 'action')
    {
        foreach ($hooks as $name => $handler) {
            if (is_callable($handler)) {
                $nestedHandlers = $handler();
                foreach ($nestedHandlers as $nestedHandler) {
                    static::bind($name, $nestedHandler, $type);
                }
            } else {
                static::bind($name, $handler, $type);
            }
        }
    }

    public static function bind($name, $handler, $type = 'action'): void
    {
        if (is_callable($handler['callable'])) {
            if ($type == 'action') {
                add_action($name, $handler['callable'], $handler['priority'], $handler['accepted_args']);
            } else if ($type == 'filter') {
                add_filter($name, $handler['callable'], $handler['priority'], $handler['accepted_args']);
            } else {
                wp_die("The handler either should be action or filter when registering");
            }
        } else {
            wp_die("Error While Registering {$name}, It's Not Callable");
        }
    }


}