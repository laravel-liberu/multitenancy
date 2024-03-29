<?php

namespace LaravelLiberu\Multitenancy\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use LaravelLiberu\Companies\Models\Company;
use LaravelLiberu\Multitenancy\Enums\Connections;
use LaravelLiberu\Multitenancy\Services\Tenant;

class DropTables implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private readonly Company $tenant)
    {
        $this->queue = 'light';
    }

    public function handle()
    {
        Tenant::set($this->tenant);

        DB::connection(Connections::Tenant)
            ->getSchemaBuilder()
            ->dropAllTables();
    }
}
