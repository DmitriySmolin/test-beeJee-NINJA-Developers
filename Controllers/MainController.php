<?php

namespace Controllers;

use Views\View;

class MainController
{
    public function index()
    {
        $view = new View;
        $view->render();
    }
}