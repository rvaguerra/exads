<?php

namespace Rodrigo\Exads;

class Database
{
    /**
     * Holds the PDO connection instance.
     *
     * @var \PDO|null
     */
    protected static ?\PDO $instance = null;

    /**
     * Prevent instance creation outside the class scope.
     *
     * Singleton pattern.
     */
    protected function __construct()
    {
    }

    /**
     * Get the database instance.
     *
     * @return \PDO
     */
    public static function getInstance(): \PDO
    {
        if (is_null(Database::$instance)) {
            // fetch data from a .env or configuration system
            Database::$instance = new \PDO(
                'mysql:host=localhost',
                'root',
                'root'
            );
        }
        return Database::$instance;
    }

    /**
     * Set a PDO connection to be used instead of the default.
     *
     * @param \PDO $pdo
     * @return void
     */
    public static function setInstance(\PDO $pdo) : void
    {
        Database::$instance = $pdo;
    }
}
