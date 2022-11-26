<?php

use App\Lib\Container;
use App\Middleware\AuthenticateMiddleware;

$router = Container::get("router");

// Path: app\routes.php
$router->get("/api/auth/init", "AuthController@init");
$router->post("/api/auth/login", "AuthController@login");
$router->post("/api/auth/register", "AuthController@register");
$router->post("/api/todos/create", "TodoController@create");
$router->post("/api/todos/{id}/markComplete", "TodoController@markComplete");
$router->post("/api/todos/{id}/delete", "TodoController@deleteTodo");
$router->get("/api/todos/list", "TodoController@list");
$router->get("/api/user", "HomeController@getUser")->middleware(AuthenticateMiddleware::class);
$router->get("/api/users", "HomeController@getUsers");
$router->get("/api/users/paginate", "HomeController@getUsersPaginate")->middleware(AuthenticateMiddleware::class);
$router->get("/api/users/{id}", "HomeController@getUserById")->middleware(AuthenticateMiddleware::class);
$router->get("/", "HomeController@index");

return $router;