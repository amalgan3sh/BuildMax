<?php

namespace Config;

/**
 * Database Configuration
 */
class Database extends \CodeIgniter\Database\Config
{
    /**
     * The directory that holds the Migrations and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     *
     * @var array<string, mixed>
     */
    public array $default;

    /**
     * This database connection is used when running PHPUnit database tests.
     *
     * @var array<string, mixed>
     */
    public array $tests;

    public function __construct()
    {
        parent::__construct();

        // Set the default database connection using values from the .env file
        $this->default = [
            'DSN'          => '',
            'hostname'     => $_ENV['HOSTNAME'],
            'username'     => $_ENV['USERNAME'],
            'password'     => $_ENV['PASSWORD'],
            'database'     => $_ENV['DATABASE'],
            'DBDriver'     => 'MySQLi',
            'DBPrefix'     => '',
            'pConnect'     => false,
            'DBDebug'      => true,
            'charset'      => 'utf8mb4',
            'DBCollat'     => 'utf8mb4_general_ci',
            'swapPre'      => '',
            'encrypt'      => false,
            'compress'     => false,
            'strictOn'     => false,
            'failover'     => [],
            'port'         => 3306,
            'numberNative' => false,
            'dateFormat'   => [
                'date'     => 'Y-m-d',
                'datetime' => 'Y-m-d H:i:s',
                'time'     => 'H:i:s',
            ],
        ];

        // Set the testing database connection
        $this->tests = [
            'DSN'         => '',
            'hostname'    => '127.0.0.1',
            'username'    => '',
            'password'    => '',
            'database'    => ':memory:',
            'DBDriver'    => 'SQLite3',
            'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
            'pConnect'    => false,
            'DBDebug'     => true,
            'charset'     => 'utf8',
            'DBCollat'    => '',
            'swapPre'     => '',
            'encrypt'     => false,
            'compress'    => false,
            'strictOn'    => false,
            'failover'    => [],
            'port'        => 3306,
            'foreignKeys' => true,
            'busyTimeout' => 1000,
            'dateFormat'  => [
                'date'     => 'Y-m-d',
                'datetime' => 'Y-m-d H:i:s',
                'time'     => 'H:i:s',
            ],
        ];

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
