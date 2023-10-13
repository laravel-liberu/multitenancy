<?php

namespace LaravelLiberu\Multitenancy\Services;

use Illuminate\Support\Facades\DB;
use LaravelLiberu\Multitenancy\Enums\Connections;

class MixedConnection
{
    public static function set($user, $tenant)
    {
        if (! $user->belongsToAdminGroup() || $tenant) {
            self::connection(Connections::Tenant);
        } else {
            self::connection(Connections::System);
        }

        DB::purge(Connections::Mixed);

        DB::reconnect(Connections::Mixed);
    }

    private static function connection($connection)
    {
        $key = 'database.connections.'.Connections::Mixed;
        $value = config("database.connections.{$connection}");
        config([$key => $value]);
    }
}
