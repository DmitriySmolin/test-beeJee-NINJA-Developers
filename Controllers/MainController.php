<?php

namespace Controllers;

use Views\View;
use Models\Task;
use Models\Connect;

class MainController
{
    public function index()
    {
        $task = new Task();
        $conn = new Connect();
        $tasks = $task->loadTasksData($conn);
        $view = new View;
        $view->render($tasks);
    }
}