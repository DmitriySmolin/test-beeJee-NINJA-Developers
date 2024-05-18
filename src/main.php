<?php

session_start();
include 'config/const.php';

spl_autoload_register(function ($class_name) {
    include 'classes/' . $class_name . '.php';
});