<?php

namespace LaravelEnso\Multitenancy\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use LaravelEnso\Companies\Models\Company;
use LaravelEnso\Multitenancy\Services\Tenant;
use LaravelEnso\Multitenancy\Traits\TenantResolver;

class CreateDatabase implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, TenantResolver;

    public function __construct(private readonly Company $tenant)
    {
        $this->queue = 'light';
    }

    public function handle()
    {
        Tenant::set($this->tenant);

        DB::statement('CREATE DATABASE '.$this->tenantDatabase());
    }
}
