<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $is_child = $request->routeIs('child.*');
        $route = $is_child ? route('child.login') : route('login');

        return $request->expectsJson() ? null : $route;
    }
}
