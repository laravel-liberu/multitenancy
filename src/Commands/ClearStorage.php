<?php

namespace LaravelLiberu\Multitenancy\Commands;

use LaravelLiberu\Companies\Models\Company;
use LaravelLiberu\Multitenancy\Jobs\ClearStorage as Job;

class ClearStorage extends Tenant
{
    protected $signature = 'liberu:tenant:clear-storage {--all=false} {--tenantId}';

    protected $description = 'Clears tenant storage';

    public function dispatch(Company $company): void
    {
        $this->line(__('Clearing storage for company :company', ['company' => $company->name]));

        Job::dispatch($company);
    }
}
