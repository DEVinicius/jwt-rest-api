<?php 

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Firebase\JWT\JWT;

$router = new Router(ROOT);
$router->namespace("Source\Controllers");

$router->group("/users");
$router->post("/login", "UsersController:checkLogin");
$router->post("/getData","UsersController:getData");
$router->get("/read","UsersController:read");
$router->post("/create","UsersController:create");


$router->group("/projects");
$router->get("/read","ProjectsController:read");
$router->post("/create","ProjectsController:create");

// Error Route
$router->group("ooops");
$router->get("/{errcode}", "ErrorController:error");


$router->dispatch();

if($router->error())
{
	$router->redirect("/ooops/{$router->error()}");
}