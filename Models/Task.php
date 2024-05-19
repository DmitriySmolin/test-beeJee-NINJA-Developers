<?php

namespace Models;

use PDO;

class Task
{
    /**
     * downloading data of all tasks
     * @param Connect $connect
     * @return array
     */
    public function loadTasksData(Connect $connect):array
    {
        $query = 'SELECT * FROM `tasks`';
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    /**
     * output of tasks for pagination
     * @param Connect $connect
     * @param int $page
     * @return array
     */
    public function loadTasksForPagination(Connect $connect, int $page):array
    {
        $start = 0;
        $tasksPerPage = 3;
        if($page != 0){
            $start = ($page - 1) * $tasksPerPage;
        }
        $query = "SELECT * FROM `tasks` LIMIT :start,:tasksPerPage";
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->bindValue(':start', (int) $start, PDO::PARAM_INT);
        $stmt->bindValue(':tasksPerPage', (int) $tasksPerPage, PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return($tasks);
    }

    /**
     * loading data of one task
     * @param Connect $connect
     * @param int $id
     * @return array
     */
    public function loadOneTaskData(Connect $connect, int $id):array
    {
        $query = 'SELECT * FROM `tasks` WHERE `id` = :id';
        $params = [
            ':id' => $id
        ];
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->execute($params);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
    }

    /**
     * save task data
     * @param Connect $connect
     * @param string $login
     * @param string $email
     * @param string $descriptions
     * @return bool
     */
    public function saveTask(Connect $connect, string $username, string $email, string $descriptions):bool
    {
        $query = 'INSERT INTO `tasks` (username, email, descriptions) VALUES (:username, :email, :descriptions)';
        $params = [
            ':username' => $username,
            ':email' => $email,
            ':descriptions' => $descriptions
        ];
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->execute($params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * sets the execution mark of the task
     * @param Connect $connect
     * @param int $task_id
     * @param int $implementation
     * @return bool
     */
    public function setImplementation(Connect $connect, int $task_id, int $implementation):bool
    {
        $query = 'UPDATE `tasks` SET `implementation` = :implementation WHERE `id` = ' . $task_id;
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $params = [
            ':implementation' => $implementation
        ];
        $stmt->execute($params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * calculates the number of pages to paginate
     * @param Connect $connect
     * @return int
     */
    public function getCountPages(Connect $connect):int
    {
        $countPage = intval(ceil(count($this->loadTasksData($connect))/3));
        return $countPage;
    }

    /**
     * output tasks for pagination with sorting
     * @param Connect $connect
     * @param int $page
     * @param string $sort
     * @return array
     */
    public function loadTasksForPaginationWithSort(Connect $connect, int $page, string $sort):array
    {
        $sort_list = array(
            'id' => '`id`',
            'username_asc'   => '`username`',
            'username_desc'  => '`username` DESC',
            'email_asc'  => '`email`',
            'email_desc' => '`email` DESC',
            'descriptions_asc'   => '`descriptions`',
            'descriptions_desc'  => '`descriptions` DESC',
            'implementation_asc'   => '`implementation`',
            'implementation_desc'  => '`implementation` DESC'
        );

        if (array_key_exists($sort, $sort_list)) {
            $sort_sql = $sort_list[$sort];
        } else {
            $sort_sql = reset($sort_list);
        }

        $start = 0;
        $tasksPerPage = 3;
        if($page != 0){
            $start = ($page - 1) * $tasksPerPage;
        }

        $query = "SELECT * FROM `tasks` ORDER BY " . $sort_sql . " LIMIT :start,:tasksPerPage";
        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->bindValue(':start', (int) $start, PDO::PARAM_INT);
        $stmt->bindValue(':tasksPerPage', (int) $tasksPerPage, PDO::PARAM_INT);
        $stmt->execute();
        $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return($tasks);
    }

    /**
     * updates task data
     * @param Connect $connect
     * @param array $newData
     * @param int $task_id
     * @return bool
     */
    public function updateTask(Connect $connect, array $newData, int $task_id):bool
    {
        $keys = array_keys($newData);
        $query = 'UPDATE `tasks` SET ';
        $params = [];
        foreach ($keys as $key) {
            $query .= '`' . $key . '` = :' . $key . ', ';
            $params[':' . $key] = $newData[$key];
        }
        $query = mb_substr($query, 0, -2);
        $query .= ' WHERE `id` = ' . $task_id;

        $stmt = $connect->connect(PATH_CONF)->prepare($query);
        $stmt->execute($params);
        if ($stmt) {
            return true;
        } else {
            return false;
        }
    }
}