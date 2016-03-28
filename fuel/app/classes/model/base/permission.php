<?php

use Fuel\Core\Log;

class Model_Base_Permission
{

    public static function update($data)
    {
        try {

            $query = Model_Permission::query()->where('action', $data['action'])->get_one();
            if (empty($query)) {
                $new = Model_Permission::forge($data);
                $new->save();
                return $new->id;
            } else {
                $query->set($data);
                $query->save();
            }
        } catch (Exception $e) {
            Log::write('ERROR', $e->getMessage());
            return false;
        }

        return true;
    }

    public static function get_all()
    {
        return Model_Permission::find('all', ['order_by' => ['id' => 'asc']]);
    }

    public static function get_permission_data()
    {
        $permissions = Model_Permission::find('all', ['order_by' => ['id' => 'asc']]);
        return self::map_permission($permissions);
    }

    public static function map_permission($permissions)
    {
        $data = [];
        foreach ($permissions as $permission) {
            $data[$permission->action] = empty($permission->group) ? [] : json_decode($permission->group);
        }

        return $data;
    }

    public static function valid_field($field, $val)
    {
        $result = Model_Permission::query()->where([$field => $val]);
        return ($result->count() > 0);
    }

    public static function get_page_list()
    {
        $data = [];
        $controllers = Model_Service_Util::get_app_config('page');
        foreach ($controllers as $controller => $actions) {
            foreach ($actions as $action => $value) {
                $data[$controller . '_' . $action] = $value;
            }
        }

        return $data;
    }

}
