<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Auth;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Register your Admin Middleware alias
        $middleware->alias([
            'admin' => \App\Http\Middleware\AdminMiddleware::class,
        ]);

        // Define global redirection for authenticated users (Guest Middleware)
        $middleware->redirectUsersTo(function () {
            if (Auth::user() && Auth::user()->role === 'admin') {
                return route('admin.dashboard');
            }
            return route('home');
        });
    })
    
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();