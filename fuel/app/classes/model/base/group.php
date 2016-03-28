<?php

use Fuel\Core\Log;

class Model_Base_Group
{

    public static function insert($data)
    {
        try {
            $props = [
                'group' => $data['group'],
                'order' => Model_Group::query()->max('order') + 1,
            ];

            $new = Model_Group::forge($props);
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
            $query = Model_Group::find($id);
            $query->set($data);
            $query->save();
        } catch (Exception $e) {
            Log::write('ERROR', $e->getMessage());
            return false;
        }

        return true;
    }

    public static function get_all()
    {
        return Model_Group::find('all', ['order_by' => ['order' => 'asc']]);
    }

    public static function get_group_data()
    {
        $groups = Model_Group::find('all', ['order_by' => ['order' => 'asc']]);
        return self::map_group($groups);
    }

    public static function map_group($groups)
    {
        $data = [];
        foreach ($groups as $group) {
            $data[$group->id] = $group->group;
        }
        return $data;
    }

    public static function valid_field($field, $val)
    {
        $result = Model_Group::query()->where([$field => $val]);
        return ($result->count() > 0);
    }

}
