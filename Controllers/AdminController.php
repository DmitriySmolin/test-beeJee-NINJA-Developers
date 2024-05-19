<?php

namespace Controllers;

use Models\InputCleaning;
use Models\User;
use Models\Connect;
use Views\View;
use Models\Task;

class AdminController
{
    /**
     * displaying the admin panel page with sorting
     * @return void
     */
    public function edit(int $page):void
    {
        $sort = trim($_SERVER['REQUEST_URI'], '/');
        $sort = explode('/', $sort);
        if (isset($sort[2])) {
            $sort = explode('=', $sort[2]);
            $sort['sort'] = $sort[1];
        }
        if (array_key_exists('sort', $sort)) {
            $sort = $sort['sort'];
        } else {
            $sort = 'id';
        }
        $path = PATH_CONF;
        $task = new Task();
        $conn = new Connect();
        $tasks = $task->loadTasksForPaginationWithSort($conn, $page, $sort, $path);
        $countPage = $task->getCountPages($conn, $path);
        $view = new View;
        $view->renderAdmin($tasks, $countPage, $sort, $page);
    }

    /**
     * user authentication check
     * @return void
     */
    public function login():void
    {
        if(!empty($_POST['login']) && !empty($_POST['passwordForLogin'])) {
            $cleaning = new InputCleaning();

            $login = $cleaning->clean($_POST['login']);

            $password = $_POST['passwordForLogin'];
            $conn = new Connect();
            $user = new User();
            $path = PATH_CONF;
            $auth = $user->authUser($conn, $login, $password, $path);
            if ($auth) {
                header("Location: http://localhost:8000/");
            } else {
                $path = PATH_CONF;
                $error['auth'] = 'Authentication failed';
                $page = 0;
                $sort = explode('=', $_SERVER['REQUEST_URI']);
                $sort = $sort[0];
                $task = new Task();
                $conn = new Connect();
                $tasks = $task->loadTasksForPagination($conn, $page, $path);
                $countPage = $task->getCountPages($conn, $path);
                $view = new View;
                $view->renderPublic($tasks, $countPage, $sort, $page, $error);
            }
        }
    }

    /**
     * completes user authentication
     * @return void
     */
    public function logout():void
    {
        $user = new User();
        $user->logout();
    }

    /**
     * updates task fields
     * @return void
     */
    public function update():void
    {
        if(!empty($_POST['username']) || !empty($_POST['email']) || !empty($_POST['descriptions']) || !empty($_POST['implementation'])) {
            $cleaning = new InputCleaning();
            $newData = [];
            foreach ($_POST as $key=>$value) {
                if (!empty($value)) {
                    $value = $cleaning->clean($value);
                    $newData[$key] = $value;
                }
            }
            $path = PATH_CONF;
            $task_id = $newData['id'];
            unset($newData['id']);
            $newData['edited'] = true;
            $task = new Task();
            $conn = new Connect();
            $update = $task->updateTask($conn, $newData, $task_id, $path);
            if ($update) {
                header ("Location: http://localhost:8000/admin/");
            } else {
                header ("Location: http://localhost:8000/admin/");
            }
        } else {
            header ("Location: http://localhost:8000/admin/");
        }
    }
}