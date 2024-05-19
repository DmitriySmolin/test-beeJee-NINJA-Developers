<?php

namespace Controllers;

use Views\View;
use Models\Task;
use Models\Connect;
use Models\InputCleaning;

class MainController
{
    /**
     * handles the homepage request
     * @param int $page
     * @return void
     */
    public function index(int $page):void
    {
        $sort = explode('=', $_SERVER['REQUEST_URI']);
        $sort = $sort[0];
        $path = PATH_CONF;
        $task = new Task();
        $conn = new Connect();
        $tasks = $task->loadTasksForPagination($conn, $page, $path);
        $countPage = $task->getCountPages($conn, $path);
        $view = new View;
        $view->renderPublic($tasks, $countPage, $sort, $page);
    }

    /**
     * creates a task based on user input
     * @return void
     */
    public function create():void
    {
        if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['descriptions'])) {
            $cleaning = new InputCleaning();

            $username = $cleaning->clean($_POST['username']);
            $email = $cleaning->clean($_POST['email']);
            $descriptions = $cleaning->clean($_POST['descriptions']);

            $path = PATH_CONF;
            $task = new Task();
            $conn = new Connect();

            $task->saveTask($conn, $username, $email, $descriptions, $path);
            header ("Location: http://localhost:8000");
        }
    }

    /**
     * displaying the main page with sorting
     * @return void
     */
    public function indexWithSort(int $page):void
    {
        $sort = explode('=', $_SERVER['REQUEST_URI']);
        $sort = $sort[1];
        $path = PATH_CONF;
        $task = new Task();
        $conn = new Connect();
        $tasks = $task->loadTasksForPaginationWithSort($conn, $page, $sort, $path);
        $countPage = $task->getCountPages($conn, $path);
        $view = new View;
        $view->renderPublic($tasks, $countPage, $sort, $page);
    }

    /**
     * 404 page output
     * @return void
     */
    public function notFound():void
    {
        $view = new View;
        $view->page404();
    }
}