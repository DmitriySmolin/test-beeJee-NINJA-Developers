<?php
return [
    '([0-9]+)' => [
        'controller' => 'main',
        'action' => 'indexWithSort',
    ],
    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    '([0-9]+)/sort=([A-z]+)' => [
        'controller' => 'main',
        'action' => 'indexWithSort',
    ],
    'sort=([A-z]+)' => [
        'controller' => 'main',
        'action' => 'indexWithSort',
    ],
    'create' => [
        'controller' => 'main',
        'action' => 'create',
    ],
    'login' => [
        'controller' => 'admin',
        'action' => 'login',
    ],
    'logout' => [
        'controller' => 'admin',
        'action' => 'logout',
    ],
    'admin/([0-9]+)' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],
    'admin' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],
    'admin/([0-9]+)/sort=([A-z]+)' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],
    'admin/sort=([A-z]+)' => [
        'controller' => 'admin',
        'action' => 'edit',
    ],
    'admin/update' => [
        'controller' => 'admin',
        'action' => 'update',
    ]
];