<?php

use Fuel\Core\DBUtil;

class Model_Migrate_Group extends Model_Migrate_Migratebase
{

    public static $_table_name = 'groups';

    public static function up()
    {
        $table_exists = DBUtil::table_exists(self::$_table_name);
        if ($table_exists) {
            return false;
        }

        DBUtil::create_table(
            self::$_table_name, [
            'id' => ['constraint' => 11, 'type' => 'int', 'auto_increment' => true],
            'group' => ['constraint' => 50, 'type' => 'varchar'],
            'order' => ['constraint' => 3, 'type' => 'tinyint', 'default' => 0],
            ], ['id'], true, 'InnoDB', 'utf8_general_ci'
        );
    }

    public static function down()
    {
        parent::down_run(self::$_table_name);
    }

    public static function add_group()
    {
        $group_props = [
            [
                'group' => 'Quản lý',
                'order' => 1
            ],
            [
                'group' => 'Nhân viên',
                'order' => 2
            ]
        ];
        foreach ($group_props as $prop) {
            $user = Model_Group::forge($prop);
            $user->save();
        }
    }

}
