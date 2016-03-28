<?php

use Fuel\Core\Log;
use Fuel\Core\Date;
use Auth\Auth;

class Model_Base_User
{

    public static function is_login()
    {
        return (Auth::check());
    }

    public static function is_admin()
    {
        // list(list(, $group)) = Auth::get_groups();
        list(, $user_id) = Auth::get_user_id();
        return ($user_id == 1);
    }

    public static function check_permission($action)
    {
        // Get user_id
        list(, $user_id) = Auth::get_user_id();

        // Get group
        list(list(, $group)) = Auth::get_groups();

        // Get permission
        $permission = Model_Base_Permission::get_permission_data();

        return ($user_id == 1 || (isset($permission[$action]) && in_array($group, $permission[$action])));
    }

    public static function user_login($username_or_email, $password, $is_remember = false)
    {
        if (Auth::instance()->login($username_or_email, $password)) {
            if ($is_remember) {
                Auth::remember_me();
            }
            return true;
        }
        return false;
    }

    public static function admin_login($username_or_email, $password)
    {
        if (Auth::instance()->login($username_or_email, $password)) {
            list(list(, $group_id)) = Auth::get_groups();
            if ($group_id == 1) {
                return true;
            }
        }
        return false;
    }

    public static function insert($data)
    {
        try {
            $props = [
                'code' => Model_Service_Util::gen_code(),
                'username' => $data['username'],
                'password' => $data['password'],
                'group' => empty($data['group']) ? 2 : $data['group'],
                'status' => empty($data['status']) ? 0 : $data['status'],
                'full_name' => $data['full_name'],
                'gender' => empty($data['gender']) ? 0 : $data['gender'],
                'email' => $data['email'],
                'telephone' => $data['telephone'],
                'address' => $data['address'],
                'created_at' => date('Y-m-d H:i:s', Date::forge()->get_timestamp())
            ];

            $new = Model_User::forge($props);
            $new->save();
            return $new->id;
        } catch (Exception $e) {
            Log::write('ERROR', $e->getMessage());
            return false;
        }
    }

    public static function update($id, $data)
    {
        try {
            $data['updated_at'] = date('Y-m-d H:i:s', Date::forge()->get_timestamp());
            $query = Model_User::find($id);
            $query->set($data);
            $query->save();
        } catch (Exception $e) {
            Log::write('ERROR', $e->getMessage());
            return false;
        }

        return true;
    }

    public static function get_all($order = [], $offset = _DEFAULT_OFFSET_, $limit = _DEFAULT_LIMIT_)
    {
        $users = Model_User::find('all', [
                'where' => [['id', '<>', 1]],
                'order_by' => empty($order) ? ['id' => 'desc'] : $order,
                'offset' => $offset,
                'limit' => $limit
        ]);

        return $users;
    }

    public static function count_all()
    {
        $total = Model_User::query()->count();
        return $total > 0 ? $total - 1 : 0;
    }

    public static function get_user_info($id)
    {
        $user = Model_User::find($id);
        if ($user) {
            $user_config = Model_Service_Util::get_app_config('user');
            return [
                'id' => $user->id,
                'code' => $user->code,
                'username' => $user->username,
                'email' => $user->email,
                'group' => $user->group,
                'status' => $user->status,
                'full_name' => $user->full_name,
                'gender' => $user->gender,
                'gender_display' => empty($user_config['gender'][$user->gender]) ? '' : $user_config['gender'][$user->gender],
                'address' => $user->address,
                'telephone' => $user->telephone,
                'user_photo_display' => empty($user->user_photo) ? _PATH_NO_ICON_ : _PATH_ICON_ . $user->user_photo
            ];
        }

        return false;
    }

    public static function valid_field($field, $val)
    {
        $result = Model_User::query()->where([$field => $val]);
        return ($result->count() > 0);
    }

    public static function map_user($users)
    {
        $data = [];
        foreach ($users as $user) {
            $data[$user->id]['id'] = $user->id;
        }

        return array_values($data);
    }

}
