<?php

namespace Views;

class View
{
    public function render($data)
    {
        $title = 'Work';
        require 'layouts/main-layout.php';
    }
}