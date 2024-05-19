<?php

namespace Models;

class Router {

    protected $routes = [];
    protected $params = [];

    /**
     * adds hardcoded routes from file a file with its own method
     */
    public function __construct()
    {
        $arr = require 'routes/routes.php';
        foreach ($arr as $key => $val) {
            $this->add($key, $val);
        }
    }

    /**
     * prepares the pattern for verification
     * @return void
     */
    public function add($route, $params):void
    {
        $route = '@^' . $route . '$@';
        $this->routes[$route] = $params;
    }

    /**
     * checks uri against own routes
     * @return bool
     */
    public function match():bool
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        foreach ($this->routes as $route => $params) {
            if (preg_match($route, $url)) {
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    /**
     * produces result based on uri matching
     * @return void
     */
    public function run():void
    {
        if ($this->match()) {
            $path = 'Controllers\\'.ucfirst($this->params['controller']).'Controller';
            $action = $this->params['action'];
            if ($action != 'edit') {
                $controller = new $path;
                $page = (int)trim($_SERVER['REQUEST_URI'], '/');
                $controller->$action($page);
            } elseif ($action == 'edit') {
                $controller = new $path;
                $page = trim($_SERVER['REQUEST_URI'], '/');
                $page = explode('/', $page);
                if (isset($page[1])) {
                    $page = $page[1];
                } else {
                    $page = 0;
                }
                $controller->$action($page);
            }
        } else {
            $path = 'Controllers\\'.'MainController';
            $action = 'notFound';
            $controller = new $path;
            $controller->$action();
        }
    }
}