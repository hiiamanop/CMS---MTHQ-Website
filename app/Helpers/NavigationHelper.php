<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route, $outputClass = 'active bg-gradient-dark text-white')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $outputClass : 'text-dark';
        }
        return Route::currentRouteName() == $route ? $outputClass : 'text-dark';
    }
}

if (!function_exists('isActiveGroup')) {
    function isActiveGroup($routes)
    {
        foreach ($routes as $route) {
            if (Route::is($route)) {
                return true;
            }
        }
        return false;
    }
}