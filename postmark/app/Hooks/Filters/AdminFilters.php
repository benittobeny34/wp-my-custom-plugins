<?php

namespace Cartrabbit\Postmark\app\Hooks\Filters;


class AdminFilters
{
    public static $filters = [
    ];

    public static function register()
    {
        foreach (static::$filters as $filter => $handler) {
            add_filter($filter, [$handler['class'], $handler['method']], $handler['priority'], $handler['arg_count']);
        }
    }
}