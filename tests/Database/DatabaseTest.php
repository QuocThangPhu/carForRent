<?php

namespace Thangphu\Test\Database;

use PHPUnit\Framework\TestCase;
use Thangphu\CarForRent\Database\DatabaseConnect;

class DatabaseTest extends TestCase
{
    public function testDatabase()
    {
        $connection = DatabaseConnect::getConnection();
        self::assertNotNull($connection);
    }
    public function testDatabaseSingleTon()
    {
        $connection1 = DatabaseConnect::getConnection();
        $connection2 = DatabaseConnect::getConnection();
        self::assertEquals($connection1,$connection2);
    }
}