<?php

namespace LaravelLiberu\Multitenancy\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;
use LaravelLiberu\Companies\Models\Company;
use LaravelLiberu\Multitenancy\Enums\Connections;
use LaravelLiberu\Multitenancy\Services\Tenant;

class Migrate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Company $tenant)
    {
        $this->queue = 'sync';
    }

    public function handle()
    {
        Tenant::set($this->tenant);

        Artisan::call('migrate', [
            '--database' => Connections::Tenant,
            '--path' => '/database/migrations/tenant',
            '--force' => true,
        ]);
    }
}
