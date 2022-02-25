<?php

use PHPUnit\Framework\TestCase;
use Rodrigo\Exads\Database;

class DatabaseTest extends TestCase
{
    public function testItHasADefaultDatabaseConnectionInstance()
    {
        $this->assertInstanceOf(\PDO::class, Database::getInstance());
    }

    public function testItGivesTheSameDatabaseConnectionInstance()
    {
        $this->assertSame(Database::getInstance(), Database::getInstance());
    }

    public function testItUpdatesTheDatabaseConnectionInstance()
    {
        $connection = new PDO('sqlite::memory:');
        Database::setInstance($connection);
        $this->assertSame($connection, Database::getInstance());
    }
}
