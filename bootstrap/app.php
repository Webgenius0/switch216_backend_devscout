<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        channels: __DIR__ . '/../routes/channels.php',
        health: '/up',
        then: function () {
            Route::middleware(['web'])
                ->group(base_path('routes/helal.php'));
        }
    )
    ->withBroadcasting(
        __DIR__ . '/../routes/channels.php',
        ['prefix' => 'api', 'middleware' => ['auth:api']],
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role_check' => \App\Http\Middleware\RoleCheckMiddleWare::class,
            'is_contractor' => \App\Http\Middleware\CheckIsContractorMiddleWare::class,
            'is_customer' => \App\Http\Middleware\CheckIsCostomerMiddleWare::class,
            'is_customer_or_contractor' => \App\Http\Middleware\CheckIsCustomerOrContractorMiddleWare::class,
            'check_contractor_subscription' => \App\Http\Middleware\CheckContractorSubscription::class,
        ]);
        $middleware->validateCsrfTokens(
            except: [
                'api/payment/webhook/stripe',
                '/payment/webhook/stripe',
            ]
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
