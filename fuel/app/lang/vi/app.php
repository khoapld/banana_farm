<?php

return [
    'system_error' => 'Có lỗi xảy ra. Vui lòng liên hệ người quản lý.',
    'Controller_Admin_Auth' => [
        'signin' => [
            'title' => 'Admin | Trang đăng nhập',
            'error' => 'Tên đăng nhập hoặc mật khẩu không đúng.',
        ]
    ],
    'Controller_Admin_Dashboard' => [
        'index' => [
            'title' => 'Admin | Trang chính',
        ],
    ],
    'Controller_Admin_User' => [
        'profile' => [
            'title' => 'Admin | Thông tin cá nhân',
            'success' => 'Cập nhật thông tin cá nhân thành công',
        ],
        'list' => [
            'title' => 'Admin | Quản lý nhân viên',
        ],
        'new' => [
            'title' => 'Admin | Thêm nhân viên mới',
        ],
        'edit' => [
            'title' => 'Admin | Thay đổi thông tin nhân viên',
        ],
        'group' => [
            'success' => 'Cập nhật nhóm thành công',
        ],
        'status' => [
            'success' => 'Cập nhật trạng thái thành công',
        ],
    ],
    'Controller_Admin_Group' => [
        'list' => [
            'title' => 'Admin | Quản lý nhóm',
        ],
        'create' => [
            'success' => 'Thêm nhóm mới thành công',
        ],
        'update' => [
            'success' => 'Cập nhật nhóm thành công',
            'error' => 'Nhóm đã tồn tại'
        ],
    ],
    'Controller_Admin_Permission' => [
        'list' => [
            'title' => 'Admin | Quản lý quyền truy cập',
        ],
        'update' => [
            'success' => 'Thiết lập quyền truy cập thành công',
        ],
    ],
    'menu' => [
        'home_page' => 'Trang chủ',
        'user' => 'Quản lý nhân viên',
        'group' => 'Quản lý nhóm',
        'permission' => 'Phân quyền',
        'profile' => 'Thông tin cá nhân',
        'sign_up' => 'Đăng ký',
        'sign_in' => 'Đăng nhập',
        'sign_out' => 'Đăng xuất',
        'dashboard' => 'Trang chính',
    ],
    'title' => [
        'profile' => 'Thông tin cá nhân',
        'user_list' => 'Danh sách nhân viên',
        'user_info' => 'Thông tin nhân viên',
        'group_list' => 'Danh sách nhóm',
        'group_info' => 'Thông tin nhóm',
        'permission_list' => 'Danh sách quyền truy cập',
        'sign_in' => 'Thông tin đăng nhập',
        'account_info' => 'Thông tin tài khoản',
        'status' => 'Trạng thái',
        'action' => 'Chức năng',
        'photo' => 'Hình ảnh',
        'group' => 'Nhóm',
    ],
    'label' => [
        'id' => 'ID',
        'user' => 'Nhân viên',
        'username' => 'Tên đăng nhập',
        'email' => 'Email',
        'group' => 'Nhóm',
        'full_name' => 'Họ Tên',
        'gender' => 'Giới tính',
        'birthday' => 'Ngày sinh',
        'telephone' => 'Điện thoại',
        'address' => 'Địa chỉ',
        'password' => 'Mật khẩu',
        'confirm_password' => 'Nhập lại mật khẩu',
        'action' => 'Chức năng',
        'maintenance' => 'Bảo trì hệ thống',
        'status' => 'Trạng thái',
        'photo' => 'Hình ảnh',
        'group_name' => 'Tên nhóm',
        'permission_action' => 'Đường dẫn trang truy cập',
    ],
    'button' => [
        'sign_in' => 'Đăng nhập',
        'update' => 'Cập nhật',
        'submit' => 'Cập nhật',
        'edit' => 'Chỉnh sửa',
        'create' => 'Tạo',
        'reset' => 'Làm lại',
        'delete' => 'Xóa',
        'new_user' => 'Thêm nhân viên mới',
    ],
    'notice' => [
        'upload' => [
            'no_file' => 'Vui lòng chọn tập tin.',
            'save_icon_error' => 'Cập nhật hình đại diện không thành công',
            'save_photo_error' => 'Thêm hình ảnh không thành công',
        ],
    ],
    'validation_error' => [
        'empty' => [
            'email' => 'Vui lòng nhập thông tin',
        ],
    ],
    'text' => [
        'male' => 'Nam',
        'female' => 'Nữ',
        'not_active' => 'Chưa kích hoạt',
        'actived' => 'Đã kích hoạt',
        'banned' => 'Bị cấm',
        'deleted' => 'Đã xóa',
        'select' => '--- Vui lòng chọn ---',
        'welcome' => 'Chào, ',
        'select_file' => 'Chọn hình',
        'cancel' => 'Hủy',
        'on' => 'Có',
        'off' => 'Không',
        'show' => 'Hiện',
        'hide' => 'Ẩn',
        'confirm_detele_user' => 'Bạn muốn xóa nhân viên này phải không?',
        'confirm_detele_group' => 'Bạn muốn xóa nhóm này phải không?',
    ],
    'placeholder' => [
        'group' => 'Vui lòng nhập tên nhóm'
    ]
];
