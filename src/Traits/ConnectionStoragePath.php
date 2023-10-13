<?php

namespace LaravelLiberu\Multitenancy\Traits;

use LaravelLiberu\Multitenancy\Services\Tenant;

trait ConnectionStoragePath
{
    public function storagePath($folder)
    {
        return $this->hasTenantConnection()
            ? config('liberu.files.paths.'.$folder)
            : $this->tenantPath().DIRECTORY_SEPARATOR
                .config('liberu.files.paths.'.$folder);
    }

    public function tenantPath()
    {
        return config('liberu.files.paths.tenants')
            .DIRECTORY_SEPARATOR
            .Tenant::tenantDatabase();
    }
}
