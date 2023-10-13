<?php

namespace LaravelLiberu\Multitenancy\Commands;

use LaravelLiberu\Companies\Models\Company;
use LaravelLiberu\Multitenancy\Jobs\DropTables as Job;

class DropTables extends Tenant
{
    protected $signature = 'liberu:tenant:drop-tables {--all=false} {--tenantId}';

    protected $description = 'Drops all tables from tenant database(s)';

    public function dispatch(Company $company): void
    {
        $this->line(__('Dropping tables for company :company', ['company' => $company->name]));

        Job::dispatch($company);
    }
}
