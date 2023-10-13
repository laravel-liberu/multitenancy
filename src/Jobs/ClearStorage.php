<?php

namespace LaravelLiberu\Multitenancy\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use LaravelLiberu\Companies\Models\Company;
use LaravelLiberu\Multitenancy\Services\Tenant;
use LaravelLiberu\Multitenancy\Traits\ConnectionStoragePath;

class ClearStorage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, ConnectionStoragePath;

    public function __construct(private readonly Company $tenant)
    {
        $this->queue = 'light';
    }

    public function handle()
    {
        Tenant::set($this->tenant);

        Storage::deleteDirectory($this->tenantPath());
    }
}
