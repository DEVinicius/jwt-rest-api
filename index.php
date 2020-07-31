<?php 

require __DIR__."/vendor/autoload.php";

use CoffeeCode\Router\Router;
use Firebase\JWT\JWT;

$router = new Router(ROOT);
$router->namespace("Source/Controllers");

$router->group("users");
$router->get("read","UsersController:read");
$router->post("create","UsersController:create");
$router->put("update","UsersController:update");
$router->delete("delete", "UsersController:delete");


$router->group("projects");
$router->get("read","ProjectsController:read");
$router->post("create","ProjectsController:create");
$router->put("update","ProjectsController:update");
$router->delete("delete", "ProjectsController:delete");

$router->dispatch();