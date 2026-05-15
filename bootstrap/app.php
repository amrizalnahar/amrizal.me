<?php

use App\Console\Commands\LivewireCleanupTemporaryFiles;
use App\Console\Commands\QueueDemoFail;
use App\Http\Middleware\DecryptPasswordMiddleware;
use App\Http\Middleware\SetLocale;
use App\Http\Middleware\TrackVisitor;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schedule;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Spatie\Permission\Middleware\PermissionMiddleware;
use Spatie\Permission\Middleware\RoleMiddleware;
use Spatie\Permission\Middleware\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withCommands([
        QueueDemoFail::class,
        LivewireCleanupTemporaryFiles::class,
    ])
    ->withSchedule(function (Schedule $schedule): void {
        $schedule->command(LivewireCleanupTemporaryFiles::class)->hourly();
    })
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'role' => RoleMiddleware::class,
            'permission' => PermissionMiddleware::class,
            'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);

        $middleware->appendToGroup('web', [
            SetLocale::class,
            DecryptPasswordMiddleware::class,
            TrackVisitor::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            if (str_starts_with($request->path(), 'admin')) {
                return response()->view('errors.404-admin', [], 404);
            }
        });
    })->create();
