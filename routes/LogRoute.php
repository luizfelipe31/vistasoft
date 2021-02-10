<?php

$router->namespace("Source\App");
$router->group(null);

$router->group("/");

$router->get("/", "LogIn:root", "login.root");
$router->get("/login", "LogIn:login", "login.login");
$router->post("/login", "LogIn:login", "login.loginPost");


