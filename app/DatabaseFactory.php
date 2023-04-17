<?php

namespace App;

class DatabaseFactory
{
    public static function create(array $config): IDatabaseAdapter
    {
        $driver = $config['db_driver'];

        switch ($driver) {
            case 'sqlite':
                return new SQLiteAdapter($config[$driver]);
            default:
                throw new \InvalidArgumentException("Unsupported database driver: $driver");
        }
    }
}