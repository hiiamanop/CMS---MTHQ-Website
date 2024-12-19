<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('isActiveRoute')) {
    function isActiveRoute($route, $outputClass = 'active bg-gradient-dark text-white')
    {
        if (is_array($route)) {
            return in_array(Route::currentRouteName(), $route) ? $outputClass : '';
        }
        return Route::currentRouteName() == $route ? $outputClass : '';
    }
}

// Anda bisa menambahkan helper functions lain di sini
if (!function_exists('formatRupiah')) {
    function formatRupiah($nominal) {
        return "Rp " . number_format($nominal, 0, ',', '.');
    }
}