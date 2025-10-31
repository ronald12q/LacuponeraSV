<?php

// Entry point for the MVC application

session_start(); // Iniciar sesión

require_once 'core/Database.php';

require_once 'core/Router.php';

// Get the URL from the query string

$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'home';

// Route the request

$router = new Router();

$router->route($url);