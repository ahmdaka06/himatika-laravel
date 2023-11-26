<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {

        // return $request->expectsJson() ? null : route('login');
        if (auth()->check()) return redirect()->route('user.dashboard.index');
        return redirect()->route('user.auth.loginGET');
    }
}
