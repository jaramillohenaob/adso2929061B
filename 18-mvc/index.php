<?php
require_once 'application/mvc.php';
require_once "application/database.php";
require_once "application/model.php";
require_once "application/load.php";
require_once "routes.php";

$router = new Router();
$router->run();