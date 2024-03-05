<?php

if (!function_exists('isRoute')) {
    function isRoute($routeName)
    {
        return request()->routeIs($routeName);
    }
}
