<?php

namespace LaravelLiberu\Multitenancy\Traits;

use Illuminate\Support\Facades\DB;
use LaravelLiberu\Multitenancy\Enums\Connections;

trait SystemResolver
{
    public function systemTable(string $table)
    {
        return $this->systemDatabase().'.'.$table;
    }

    public function systemDatabase()
    {
        return DB::connection(Connections::System)
            ->getDatabaseName();
    }
}
