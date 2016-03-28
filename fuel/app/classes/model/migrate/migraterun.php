<?php

use Fuel\Core\Model;

class Model_Migrate_MigrateRun extends Model
{

    public static function all_up()
    {
        Model_Migrate_User::up();
        Model_Migrate_Group::up();
        Model_Migrate_Permission::up();
    }

    public static function all_down()
    {
        Model_Migrate_User::down();
        Model_Migrate_Group::down();
        Model_Migrate_Permission::down();
    }

    public static function all_nice()
    {
        Model_Migrate_User::add_user();
        Model_Migrate_Group::add_group();
    }

}
