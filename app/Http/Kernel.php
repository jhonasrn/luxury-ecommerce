<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * Global HTTP middleware stack.
     * These middleware run during every request to your application.
     */
    protected $middleware = [
        \Illuminate\Http\Middleware\HandleCors::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * Route middleware groups.
     */
    protected $middlewareGroups = [
        'web' => [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Route middleware aliases.
     */
    protected $middlewareAliases = [
        // Laravel default (optional)
        'auth.original' => \Illuminate\Auth\Middleware\Authenticate::class,

        // Custom admin middleware using your App\Http\Middleware\Authenticate
        'admin.auth'    => \App\Http\Middleware\Authenticate::class,

        // Standard Laravel middlewares
        'auth'          => \App\Http\Middleware\Authenticate::class, // keep this active too for user auth
        'guest'         => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified'      => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,

        // Custom admin guard check
        'is_admin'      => \App\Http\Middleware\IsAdmin::class,
    ];
}
