<?php



session_start(); // Iniciar sesión

require_once 'core/Database.php';

require_once 'core/Router.php';



$url = isset($_GET['url']) ? rtrim(string: $_GET['url'], characters: '/') : 'home';



$router = new Router();

$router->route(url: $url);