<?php

use Core\Route;

///Enable cors
header('Access-Control-Allow-Origin: *'); 
include_once("./autoload.php");

$router = new Route();
$router->get("/profile", "Controller", "profile");
$router->get("/timeline", "Controller", "timeline");
$router->get("/friends", "Controller", "friends");
$router->get("/photos", "Controller", "photos");