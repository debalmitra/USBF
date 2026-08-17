<?php

declare(strict_types=1);

namespace Core;

use Medoo\Medoo;

final class Database
{
    private Medoo $connection;

    /** @param array<string, string> $env */
    public function __construct(array $env)
    {
        $this->connection = new Medoo([
            'type' => $env['DB_TYPE'] ?? 'mysql',
            'host' => $env['DB_HOST'] ?? '127.0.0.1',
            'database_name' => $env['DB_NAME'] ?? '',
            'username' => $env['DB_USER'] ?? '',
            'password' => $env['DB_PASSWORD'] ?? '',
            'port' => (int) ($env['DB_PORT'] ?? 3306),
            'charset' => 'utf8mb4',
            'option' => [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION],
        ]);
    }

    public function connection(): Medoo
    {
        return $this->connection;
    }
}
