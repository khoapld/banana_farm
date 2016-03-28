<?php

return [
    'page' => [
        'Controller_Admin_Dashboard' => [
            'index' => 'Admin | Trang chính'
        ],
        'Controller_Admin_User' => [
            'profile' => 'Admin | Thông tin cá nhân',
            'list' => 'Admin | Xem danh sách nhân viên',
            'new' => 'Admin | Thêm nhân viên mới',
            'edit' => 'Admin | Thay đổi thông tin nhân viên',
            'group' => 'Admin | Cập nhật thông tin nhóm của nhân viên',
            'status' => 'Admin | Cập nhật thông tin trạng thái của nhân viên'
        ],
        'Controller_Admin_Group' => [
            'list' => 'Admin | Xem danh sách nhóm',
            'create' => 'Admin | Thêm nhóm mới',
            'update' => 'Admin | Cập nhật thông tin nhóm'
        ],
        'Controller_Admin_Permission' => [
            'list' => 'Admin | Quản lý quyền truy cập',
            'update' => 'Admin | Thiết lập quyền truy cập'
        ],
    ],
    'image' => [
        'icon' => 160,
        'photo' => ['l' => '1024', 'm' => '640', 's' => '320'],
    ],
    'path' => [
        'no_icon' => 'assets/img/no_icon.png',
        'no_image' => 'assets/img/no_image.png',
        'icon' => 'upload/icon/',
        'photo' => 'upload/photo/s/'
    ],
    'user' => [
        'group' => [
            1 => 'admin',
            2 => 'staff'
        ],
        'gender' => [
            1 => 'male',
            2 => 'female'
        ],
        'status' => [
            0 => 'not_active',
            1 => 'actived',
            2 => 'banned',
            3 => 'deleted'
        ]
    ],
];
