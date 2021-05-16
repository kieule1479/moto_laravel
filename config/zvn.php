<?php

return [

    'url' => [
        'prefix_admin' => 'admin',
        'prefix_news'   => 'news69',

    ],

    'format' => [
        'long_time'  => 'H:m:s d/m/Y',
        'short_time' => 'd:m:Y',
    ],

    'templates' => [

        'button' => [
            'edit'   => ['class' => 'btn-info', 'title' => 'Edit', 'icon' => 'fa-pencil-alt', 'route-name' => '/form'],
            'delete' => ['class' => 'btn-danger btn-delete', 'title' => 'Delete', 'icon' => 'fa-trash-alt', 'route-name' => '/delete'],
            'info'   => ['class' => 'btn-info', 'title' => 'View', 'icon' => 'fa-pencil', 'route-name' => '/delete'],
        ],
        'status' => [
            'all'      => ['name' => 'Tất cả', 'class' => 'btn-success'],
            'active'   => ['name' => 'Kích hoạt', 'class' => 'btn-success'],
            'inactive' => ['name' => 'Chưa Kích hoạt', 'class' => 'btn-info'],
            'block'    => ['name' => 'Bị khoá', 'class' => 'btn-danger'],
            'default'  => ['name' => 'Chưa xác định', 'class' => 'btn-success'],
        ],
        'search' => [
            'all'         => ['name' => 'Search by All'],
            'id'          => ['name' => 'Search by ID'],
            'name'        => ['name' => 'Search by Name'],
            'username'    => ['name' => 'Search by Username'],
            'fullname'    => ['name' => 'Search by Fullname'],
            'email'       => ['name' => 'Search by Email'],
            'description' => ['name' => 'Search by Description'],
            'link'        => ['name' => 'Search by Link'],
            'content'     => ['name' => 'Search by Content'],
        ],
        'search2Val' => [

            'all'     => ['name' => 'Search Group ACP'],
            'yes'     => ['name' => 'Yes'],
            'no'     => ['name' => 'No'],
        ],

    ],

    'config' => [

        'button' => [
            'default'  => ['edit', 'delete'],
            'group'    => ['edit', 'delete'],
            'slider'   => ['edit', 'delete'],
            'category' => ['edit', 'delete'],
            'article'  => ['edit', 'delete'],
            'user'     => ['edit'],
        ],
        'search' => [
            'default'  => ['all', 'id', 'fullname'],
            'group'  => ['all', 'id', 'name'],
        ],
        'search2Val' => [
            'default'  => ['yes', 'no'],
            'group'  => ['all','yes', 'no'],
        ],

    ]


];
