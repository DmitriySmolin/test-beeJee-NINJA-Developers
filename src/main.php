<?php

session_start();
include 'config/const.php';

/*spl_autoload_register(function ($class_name) {
    include 'models/' . $class_name . '.php';
});*/
spl_autoload_register();

$router = new Models\Router;
$router->run();