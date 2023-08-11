<?php

return [
    'settings' => ['site_name', 'site_keywords', 'site_description', 'site_logo', 'mail_type', 'mail_host', 'mail_port', 'mail_username', 'mail_password', 'about_us', 'terms_condition', 'privacy_policy'],
    'status' => [
        [
            'name' => 'Active',
            'value' => '1'
        ], [
            'name' => 'Not Active',
            'value' => '0'
        ]
    ],
    'role' => ['Admin', 'User'],
    'permissions' => [
        [
            'name_key' => 'gallery_list',
            'name' => 'Gallery List',
            'roles' => ['Admin', 'User'],
            'controller' => 'Gallery',
            'method' => 'List'
        ], [
            'name_key' => 'gallery_create',
            'name' => 'Create Gallery',
            'roles' => ['Admin'],
            'controller' => 'Gallery',
            'method' => 'Create'
        ], [
            'name_key' => 'gallery_update',
            'name' => 'Update Gallery',
            'roles' => ['Admin'],
            'controller' => 'Gallery',
            'method' => 'Update'
        ], [
            'name_key' => 'gallery_delete',
            'name' => 'Delete Gallery',
            'roles' => ['Admin'],
            'controller' => 'Gallery',
            'method' => 'Delete'
        ],
        [
            'name_key' => 'news_category_list',
            'name' => 'News Category List',
            'roles' => ['Admin'],
            'controller' => 'News Category',
            'method' => 'List'
        ], [
            'name_key' => 'news_category_create',
            'name' => 'Create News Category',
            'roles' => ['Admin'],
            'controller' => 'News Category',
            'method' => 'Create'
        ], [
            'name_key' => 'news_category_update',
            'name' => 'Update News Category',
            'roles' => ['Admin'],
            'controller' => 'News Category',
            'method' => 'Update'
        ], [
            'name_key' => 'news_category_delete',
            'name' => 'Delete News Category',
            'roles' => ['Admin'],
            'controller' => 'News Category',
            'method' => 'Delete'
        ],
        [
            'name_key' => 'news_list',
            'name' => 'News List',
            'roles' => ['Admin', 'User'],
            'controller' => 'News',
            'method' => 'List'
        ], [
            'name_key' => 'news_create',
            'name' => 'Create News',
            'roles' => ['Admin'],
            'controller' => 'News',
            'method' => 'Create'
        ], [
            'name_key' => 'news_view',
            'name' => 'View News',
            'roles' => ['Admin', 'User'],
            'controller' => 'News',
            'method' => 'View'
        ], [
            'name_key' => 'news_update',
            'name' => 'Update News',
            'roles' => ['Admin'],
            'controller' => 'News',
            'method' => 'Update'
        ], [
            'name_key' => 'news_delete',
            'name' => 'Delete News',
            'roles' => ['Admin'],
            'controller' => 'News',
            'method' => 'Delete'
        ],
        [
            'name_key' => 'profile_view',
            'name' => 'View Profile',
            'roles' => ['Admin', 'User'],
            'controller' => 'Profile',
            'method' => 'View'
        ], [
            'name_key' => 'profile_update',
            'name' => 'Update Profile',
            'roles' => ['Admin', 'User'],
            'controller' => 'Profile',
            'method' => 'Update'
        ],
        [
            'name_key' => 'role_permission_list',
            'name' => 'Role Permission List',
            'roles' => ['Admin'],
            'controller' => 'Role Permission',
            'method' => 'List'
        ], [
            'name_key' => 'role_permission_create',
            'name' => 'Create Role Permission',
            'roles' => ['Admin'],
            'controller' => 'Role Permission',
            'method' => 'Create'
        ], [
            'name_key' => 'role_permission_view',
            'name' => 'View Role Permission',
            'roles' => ['Admin'],
            'controller' => 'Role Permission',
            'method' => 'View'
        ], [
            'name_key' => 'role_permission_update',
            'name' => 'Update Role Permission',
            'roles' => ['Admin'],
            'controller' => 'Role Permission',
            'method' => 'Update'
        ], [
            'name_key' => 'role_permission_delete',
            'name' => 'Delete Role Permission',
            'roles' => ['Admin'],
            'controller' => 'Role Permission',
            'method' => 'Delete'
        ],
        [
            'name_key' => 'setting_update',
            'name' => 'Update Setting',
            'roles' => ['Admin'],
            'controller' => 'Setting',
            'method' => 'Update'
        ],
        [
            'name_key' => 'user_list',
            'name' => 'Users List',
            'roles' => ['Admin'],
            'controller' => 'User',
            'method' => 'List'
        ], [
            'name_key' => 'user_create',
            'name' => 'Create User',
            'roles' => ['Admin'],
            'controller' => 'User',
            'method' => 'Create'
        ], [
            'name_key' => 'user_view',
            'name' => 'View User',
            'roles' => ['Admin'],
            'controller' => 'User',
            'method' => 'View'
        ], [
            'name_key' => 'user_update',
            'name' => 'Update User',
            'roles' => ['Admin'],
            'controller' => 'User',
            'method' => 'Update'
        ], [
            'name_key' => 'user_delete',
            'name' => 'Delete User',
            'roles' => ['Admin'],
            'controller' => 'User',
            'method' => 'Delete'
        ], [
            'name_key' => 'user_role_permission_view',
            'name' => 'View User Role Permission',
            'roles' => ['Admin'],
            'controller' => 'User Role Permission',
            'method' => 'View'
        ], [
            'name_key' => 'user_role_permission_update',
            'name' => 'Update User Role Permission',
            'roles' => ['Admin'],
            'controller' => 'User Role Permission',
            'method' => 'Update'
        ]
    ],
    'image_instructions' => [
        '*allowed file types - jpg, jpeg, png',
        '*allowed file size - 2MB',
    ]
];
