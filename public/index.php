<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');
require '../vendor/autoload.php';

use Thangphu\CarForRent\bootstrap\Application;
use Thangphu\CarForRent\Database\DatabaseConnect;

session_start();
$conn = DatabaseConnect::getConnection();
$application = new Application(dirname(__DIR__));
include "../src/Route/routes.php";

$application->run();
