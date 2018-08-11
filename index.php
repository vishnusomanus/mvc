<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

define('ROOT_PATH', dirname(__FILE__));
require_once __DIR__ . '/app/App.php';

$obj = new App();
$obj->require_all();
$route = new Router();
$route->routes();