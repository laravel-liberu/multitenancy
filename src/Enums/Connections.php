<?php

namespace LaravelLiberu\Multitenancy\Enums;

use LaravelLiberu\Enums\Services\Enum;

class Connections extends Enum
{
    final public const System = 'system';
    final public const Tenant = 'tenant';
    final public const Mixed = 'mixed';
    final public const Testing = 'sqlite';
}
