<?php 

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Firebase\JWT\JWT;

$router = new Router(ROOT);

$router->dispatch();