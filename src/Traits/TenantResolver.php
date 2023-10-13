<?php

namespace LaravelLiberu\Multitenancy\Traits;

use Illuminate\Support\Facades\DB;
use LaravelLiberu\Multitenancy\Enums\Connections;

trait TenantResolver
{
    public function tenantTable(string $table)
    {
        return $this->tenantDatabase().'.'.$table;
    }

    public function tenantDatabase()
    {
        return DB::connection(Connections::Tenant)
            ->getDatabaseName();
    }
}
