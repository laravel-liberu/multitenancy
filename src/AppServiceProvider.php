<?php

namespace LaravelLiberu\Multitenancy;

use Illuminate\Support\ServiceProvider;
use LaravelLiberu\Multitenancy\Commands\ClearStorage;
use LaravelLiberu\Multitenancy\Commands\CreateDatabase;
use LaravelLiberu\Multitenancy\Commands\DropDatabase;
use LaravelLiberu\Multitenancy\Commands\DropTables;
use LaravelLiberu\Multitenancy\Commands\Migrate;
use LaravelLiberu\Multitenancy\Http\Middleware\Multitenancy;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->commands(
            CreateDatabase::class,
            DropDatabase::class,
            ClearStorage::class,
            DropTables::class,
            Migrate::class
        );

        $this->app['router']->aliasMiddleware(
            'multitenancy',
            Multitenancy::class
        );
    }
}
