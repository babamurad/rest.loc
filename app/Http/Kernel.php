<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $middleware = [
        // ... другие middleware
        \App\Http\Middleware\TrackUserActivity::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            // Web middleware group
        ],

        'api' => [
            // API middleware group
        ],
    ];

    /**
     * The application's route middleware aliases.
     *
     * Aliases may be used instead of class names to assign middleware to routes and groups.
     *
     * @var array
     */
    protected $middlewareAliases = [
        // ... другие middleware
        'track.activity' => \App\Http\Middleware\TrackUserActivity::class,
    ];

    /**
     * Register the application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @return void
     */
    public function registerMiddleware()
    {
        //
    }
}
