<?php

namespace LaravelLiberu\Multitenancy\Traits;

use LaravelLiberu\Multitenancy\Enums\Connections;

trait MixedConnection
{
    public function __construct()
    {
        parent::__construct(...func_get_args());

        if (app()->environment('testing')) {
            $this->connection = Connections::Testing;

            return;
        }

        $this->connection = empty(config('database.connections.'.Connections::Mixed))
            ? Connections::System
            : Connections::Mixed;
    }

    public function hasTenantConnection()
    {
        return $this->getConnection()->getName() === Connections::Tenant;
    }

    public function hasSystemConnection()
    {
        return $this->getConnection()->getName() === Connections::System;
    }
}
