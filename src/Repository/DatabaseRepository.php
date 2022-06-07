<?php

namespace Thangphu\CarForRent\Repository;

use PDO;
use Thangphu\CarForRent\Database\DatabaseConnect;

abstract class DatabaseRepository
{
    protected PDO $connection;

    public function __construct()
    {
        $this->connection = DatabaseConnect::getConnection();
    }
}