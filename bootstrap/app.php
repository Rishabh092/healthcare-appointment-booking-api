<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',

        // ✅ Modular route loading for feature-based structure
        then: function (\Illuminate\Foundation\Application $app) {
            foreach (['auth', 'user', 'appointment', 'professional'] as $file) {
                $app->router->middleware('api')
                    ->prefix('api')
                    ->group(base_path("routes/{$file}.php"));
            }
        }
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Optionally define middleware groups or aliases here
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Optionally define exception handling
    })
    ->create();
