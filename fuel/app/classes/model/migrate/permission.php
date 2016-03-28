<?php

use Fuel\Core\DBUtil;

class Model_Migrate_Permission extends Model_Migrate_Migratebase
{

    public static $_table_name = 'permissions';

    public static function up()
    {
        $table_exists = DBUtil::table_exists(self::$_table_name);
        if ($table_exists) {
            return false;
        }

        DBUtil::create_table(
            self::$_table_name, [
            'id' => ['constraint' => 11, 'type' => 'int', 'auto_increment' => true],
            'action' => ['constraint' => 255, 'type' => 'varchar'],
            'group' => ['type' => 'text'],
            ], ['id'], true, 'InnoDB', 'utf8_general_ci'
        );

        DBUtil::create_index(self::$_table_name, 'action', 'action');
    }

    public static function down()
    {
        parent::down_run(self::$_table_name);
    }

}
