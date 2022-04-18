<?php

session_start();
ob_start();

require dirname(__DIR__, 1) . "/vendor/autoload.php";

use CoffeeCode\Router\Router;

$router = new Router(url());
$router->namespace("Src\Admin");

// Autenticação
$router->get("/", "AuthController:login");
$router->get("/entrar", "AuthController:login", "auth.login");
$router->get("/recuperar", "AuthController:forget", "auth.forget");
$router->get("/recuperar/{code}", "AuthController:reset", "auth.reset");
$router->get("/sair", "UserController:logout", "auth.logout");

$router->post("/entrar", "AuthController:login", "auth.login");
$router->post("/recuperar", "AuthController:forget", "auth.forget");
$router->post("/recuperar/{code}", "AuthController:reset", "auth.reset");

// Painel de controle
$router->get("/painel", "PanelController:index", "panel.index");

// Usuários
$router->get("/usuarios", "UserController:index", "user.index");
$router->get("/usuario/modal", "UserController:modal", "user.modal");

$router->post("/usuarios", "UserController:create", "user.create");
$router->put("/usuarios/{id}", "UserController:update", "user.update");
$router->delete("/usuarios/{id}", "UserController:delete", "user.delete");

// Error
$router->get("/ops/{errcode}", "ErrorController:index", "error.index");

// Executando rotas
$router->dispatch();

// Redirencia errors
if ($router->error()) {
    $router->redirect("/ops/{$router->error()}");
}

ob_end_flush();
