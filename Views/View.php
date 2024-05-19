<?php

namespace Views;

use \Models\SortLinkCreator;

class View
{
    /**
     * template output with data passing to it
     * @param array $data
     * @param int $countPages
     * @return void
     */
    public function renderPublic(array $data, int $countPages, string $sort, int $page, array $error = []):void
    {
        if (($sort == '/')) {
            $sort = 'id';
        }
        $title = 'Task list';
        $sortLinks = new SortLinkCreator();

        require 'layouts/main-layout.php';
    }

    /**
     * template output with data passing to it
     * @param array $data
     * @param int $countPages
     * @return void
     */
    public function renderAdmin(array $data, int $countPages, string $sort, int $page, array $error = []):void
    {
        if (($sort == '/')) {
            $sort = 'id';
        }
        $title = 'Admin list';
        $sortLinks = new SortLinkCreator();

        require 'layouts/admin-layout.php';
    }

    /**
     * 404 page output
     * @return void
     */
    public function page404():void
    {
        $title = '404';
        require 'layouts/404.php';
    }
}