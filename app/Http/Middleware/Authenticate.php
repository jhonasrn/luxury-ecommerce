<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Intercepts incoming requests and ensures authentication.
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        return parent::handle($request, $next, ...$guards);
    }

    /**
     * Returns the redirect path for unauthenticated users.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        if ($request->is('admin') || $request->is('admin/*')) {
            return route('admin.login');
        }

        return route('login');
    }
}
