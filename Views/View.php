<?php

namespace Views;

class View
{
    public function render()
    {
        $title = 'Work';
        require 'layouts/main-layout.php';
    }
}