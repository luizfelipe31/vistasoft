<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";

date_default_timezone_set("America/Sao_Paulo");

use Source\Core\Session;
use CoffeeCode\Router\Router;

$router = new Router(url(), ":");

require_once("routes/LogRoute.php");
require_once("routes/DashRoute.php");

/**
 * ERRORS
 */
$router->namespace("Source\App")->group("/ops");
$router->get("/{errcode}", "LogIn:error", "login.error");

/**
 * ROUTE PROCESS
 */
$router->dispatch();

/**
 * ERROR PROCESS
 */
if ($router->error()) {
    $router->redirect("login.error", ["errcode" => $router->error()]);
}

ob_end_flush();