<?php
ob_start();

require __DIR__ . "/vendor/autoload.php";


/**
 * BOOTSTRAP
 */

use Source\Core\Session;
use CoffeeCode\Router\Router;

$session = new Session();
$route = new Router(url(), ":");

/**
 * WEB ROUTES
 */
$route->namespace("Source\App");
$route->get("/", "Web:root");
$route->get("/br", "Web:index");
$route->get("/painel", "Web:home");
$route->get("/pdf/{code}", "Web:pdf");
$route->post("/cadastrar", "Web:insertClients");
$route->get("/listagem-notas", "Web:listOrder");
$route->post("/remover-notas/{code}", "Web:removeOrder");
$route->get("/nota", "Web:order");
$route->post("/nota", "Web:order");
$route->get("/registrar", "Web:register");
$route->post("/registrar", "Web:register");
$route->get("/entrar", "Web:login");
$route->post("/entrar", "Web:login");

//Enviar para assinatura
$route->post("/signer", "Web:signer");
$route->get("/sair", "Web:logout");


/**
 * ERROR ROUTES
 */
$route->namespace("Source\App")->group("/ops");
$route->get("/{errcode}", "Web:error");

/**
 * ROUTE
 */
$route->dispatch();


/**
 * ERROR REDIRECT
 */
if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}


ob_end_flush();