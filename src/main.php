<?php

session_start();
include 'config/const.php';

spl_autoload_register();

$router = new Models\Router;
$router->run();

if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['descriptions'])) {
    $cleaning = new Models\InputCleaning();

    $username = $cleaning->clean($_POST['username']);
    $email = $cleaning->clean($_POST['email']);
    $descriptions = $cleaning->clean($_POST['descriptions']);

    $task = new Models\Task();
    $conn = new Models\Connect();

    $saveTask = $task->saveTask($conn, $username, $email, $descriptions);
}