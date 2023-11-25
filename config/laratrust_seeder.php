<?php

return [

    'create_admins' => false,


    'truncate_tables' => true,

    'roles_structure' => [
        'super_admin' => [
            'admins' => 'c,r,u,d',
            'profile' => 'r,u',
            'companies' => 'c,r,u,d',
            'slides' => 'c,r,u,d',
            'sliders' => 'c,r,u,d',
            'properties' => 'r,u,d',
            'users' => 'r',
            'articles' => 'c,r,u,d',
            'messages' => 'r',
            "user_plans_requests" => 'r,u,d',
            "user_plans" => 'r,u',
            "company_plans" => 'r,u',
            "company_plans_requests" => 'r,u',
            "single_services_requests" => "r,u,d",
            "banners" => "c,r,u,d"
        ],
        "admin" => []
    ],

    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
    ],
];
