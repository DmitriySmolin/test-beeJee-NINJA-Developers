<?php

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
    public function saveTask(Connect $connect, string $login, string $email, string $descriptions):bool
    {
        $query = 'INSERT INTO `tasks` (login, email, descriptions) VALUES (:login, :email, :descriptions)';
        $params = [
            ':login' => $login,
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
}