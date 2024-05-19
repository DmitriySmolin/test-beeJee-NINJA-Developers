<?php
//require 'vendor/autoload.php';

namespace Models;

require 'vendor/autoload.php';
session_start();
include 'config/const.php';

//spl_autoload_register();

$router = new Router();
$router->run();