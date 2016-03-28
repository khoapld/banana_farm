<?php

use Fuel\Core\Str;

class MyRules
{

    public static function _empty($val)
    {
        return ($val === false or $val === null or $val === '' or $val === []);
    }

    public static function _validation_required($val)
    {
        return !self::_empty($val);
    }

    public static function _validation_valid_numeric($val)
    {
        if (self::_empty($val)) {
            return true;
        }
        $pattern = '/^([0-9])+$/';
        return preg_match($pattern, $val) > 0;
    }

    public static function _validation_valid_password($val)
    {
        if (self::_empty($val)) {
            return true;
        }
        $pattern = '/^([a-zA-Z0-9])+$/u';
        return preg_match($pattern, $val) > 0;
    }

    public static function _validation_valid_username($val)
    {
        if (self::_empty($val)) {
            return true;
        }
        $pattern = '/^([a-z0-9])+$/u';
        return (preg_match($pattern, $val) > 0);
    }

    public static function _validation_unique_username($val)
    {
        return !Model_Base_User::valid_field('username', $val);
    }

    public static function _validation_valid_user($val)
    {
        return Model_Base_User::valid_field('id', $val);
    }

    public static function _validation_update_username($val, $id)
    {
        if (self::_empty($val)) {
            return true;
        }
        $user = Model_User::find($id);
        if ($user->username == $val) {
            return true;
        }
        return !Model_Base_User::valid_field('username', $val);
    }

    public static function _validation_unique_email($val)
    {
        if (self::_empty($val)) {
            return true;
        }
        return !Model_Base_User::valid_field('email', $val);
    }

    public static function _validation_update_email($val, $id)
    {
        if (self::_empty($val)) {
            return true;
        }
        $user = Model_User::find($id);
        if ($user->email == $val) {
            return true;
        }
        return !Model_Base_User::valid_field('email', $val);
    }

    public static function _validation_valid_status($val)
    {
        if (self::_empty($val)) {
            return true;
        }
        $_config = Model_Service_Util::get_app_config('user', array('status'));
        return array_key_exists($val, $_config['status']);
    }

    public static function _validation_valid_gender($val)
    {
        if (self::_empty($val)) {
            return true;
        }
        $_config = Model_Service_Util::get_app_config('user', array('gender'));
        return array_key_exists($val, $_config['gender']);
    }

    public static function _validation_valid_group($val)
    {
        return Model_Base_Group::valid_field('id', $val);
    }

    public static function _validation_valid_permission_action($val)
    {
        if (self::_empty($val)) {
            return true;
        }
        $pages = Model_Base_Permission::get_page_list();
        $pattern = '/^([a-z_A-Z])+$/';
        return (preg_match($pattern, $val) > 0 && array_key_exists($val, $pages));
    }

    public static function _validation_valid_permission_group($val)
    {
        if (self::_empty($val)) {
            return true;
        }
        return is_array($val);
    }

//    public static function _validation_required($val)
//    {
//        $val = Model_Service_Util::mb_trim($val);
//        return !Model_Service_Util::_empty($val);
//    }
//
//
//    public static function _validation_max_length($val, $length)
//    {
//        $val = preg_replace('/\r\n/', ' ', $val);
//        $val = html_entity_decode($val, ENT_QUOTES);
//        return Model_Service_Util::_empty($val) || Str::length($val) <= $length;
//    }
//
//    public static function _validation_input_notcontain_email($val)
//    {
//        $matches = array();
//        $pattern = '/[A-Za-z0-9_-]+@[A-Za-z0-9_-]+\.([A-Za-z0-9_-][A-Za-z0-9_]+)/';
//        preg_match($pattern, $val, $matches);
//        if (!empty($matches) && count($matches) > 0) {
//            return false;
//        } else {
//            return true;
//        }
//    }
}
