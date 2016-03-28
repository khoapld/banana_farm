<?php

return [
    '_root_' => 'admin/dashboard', // The default route
    '_404_' => 'welcome/404', // The main 404 route
    // admin
    'admin/signin' => 'admin/auth/signin',
    'admin/signout' => 'admin/auth/signout',
    'admin' => 'admin/dashboard',
    // admin - user
    'admin/user' => 'admin/user/list',
    'admin/profile' => 'admin/user/profile',
    // admin - group
    'admin/group' => 'admin/group/list',
    // admin - permission
    'admin/permission' => 'admin/permission/list',
];
