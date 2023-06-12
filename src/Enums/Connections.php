<?php

namespace LaravelEnso\Multitenancy\Enums;

use LaravelEnso\Enums\Services\Enum;

class Connections extends Enum
{
    final public const System = 'system';
    final public const Tenant = 'tenant';
    final public const Mixed = 'mixed';
    final public const Testing = 'sqlite';
}
