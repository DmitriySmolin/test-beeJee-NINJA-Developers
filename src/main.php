<?php

session_start();
include 'config/const.php';

spl_autoload_register(function ($class_name) {
    include 'Models/' . $class_name . '.php';
});