<?php

namespace Models;

class SortLinkCreator
{
    /**
     * creating sort links
     * @param string $title
     * @param string $a
     * @param string $b
     * @param int $page
     * @return string
     */
    public function creatingSortLinks(string $title, string $a, string $b, int $page):string
    {
        $sort = explode('=', $_SERVER['REQUEST_URI']);
        if (!isset($sort[1])) {
            $sort = $a;
        }
        $sort = $sort[1];
        if ($sort == $a) {
            return '<a class="active" href="http://localhost:8000/' . $page . '/sort=' . $b . '">' . $title . ' <i>▲</i></a>';
        } elseif ($sort == $b) {
            return '<a class="active" href="http://localhost:8000/' . $page . '/sort=' . $a . '">' . $title . ' <i>▼</i></a>';
        } else {
            return '<a href="http://localhost:8000/' . $page . '/sort=' . $a . '">' . $title . '</a>';
        }
    }

    /**
     * creating sorting links for the admin panel
     * @param string $title
     * @param string $a
     * @param string $b
     * @param int $page
     * @return string
     */
    public function creatingSortLinksForAdmin(string $title, string $a, string $b, int $page):string
    {
        $sort = explode('=', $_SERVER['REQUEST_URI']);
        if (!isset($sort[1])) {
            $sort = $a;
        }
        $sort = $sort[1];
        if ($sort == $a) {
            return '<a class="active" href="http://localhost:8000/admin/' . $page . '/sort=' . $b . '">' . $title . ' <i>▲</i></a>';
        } elseif ($sort == $b) {
            return '<a class="active" href="http://localhost:8000/admin/' . $page . '/sort=' . $a . '">' . $title . ' <i>▼</i></a>';
        } else {
            return '<a href="http://localhost:8000/admin/' . $page . '/sort=' . $a . '">' . $title . '</a>';
        }
    }
}