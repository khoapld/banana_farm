<?php

use Fuel\Core\Controller_Hybrid;
use Fuel\Core\Config;
use Fuel\Core\Lang;
use Fuel\Core\Request;
use Fuel\Core\Response;
use Fuel\Core\View;
use Auth\Auth;

class Controller_Base_Admin extends Controller_Hybrid
{

    protected $format = 'json';
    protected $layout = 'admin';
    public static $method;
    public $controller;
    public $action;
    public $data = [];
    public $login;
    public $permission;
    public $is_permission;
    public $user_id;
    public $user_info;

    public function before()
    {
        $this->controller = Request::active()->controller;
        $this->action = Request::active()->action;
        static::$method = $this->controller . '_' . $this->action;
        $this->data['success'] = false;
        Lang::load('app');
        $this->render_template();
        parent::before();
        $this->set_title();
        $this->set_path();
        $this->check_permission();
        $this->init();
    }

    public function after($response)
    {
        $response = parent::after($response);
        if (is_object($this->template) && $this->is_permission === false) {
            $this->template->content = View::forge($this->layout . '/global/notice', $this->data);
        }
        return $response;
    }

    public function is_admin()
    {
        list(list(, $group_id)) = Auth::get_groups();
        if ($group_id != 1) {
            Response::redirect('/admin/signin');
        }
    }

    public function render_template()
    {
        switch ($this->action) {
            case 'signin':
                $this->template = $this->layout . '/auth/signin';
                break;
            default:
                $this->template = $this->layout . '/template';
                break;
        }
    }

    public function set_title()
    {
        if (is_object($this->template)) {
            $this->template->title = Lang::get($this->controller . '.' . $this->action . '.title');
        }
    }

    public function set_path()
    {
        $path_config = Config::get('app.path');
        $base_url = Config::get('base_url');
        if (!defined('_PATH_NO_ICON_')) {
            define('_PATH_NO_ICON_', $base_url . $path_config['no_icon']);
            define('_PATH_NO_IMAGE_', $base_url . $path_config['no_image']);
        }
    }

    public function check_permission()
    {
        $this->login = Model_Base_User::is_login();
        $this->permission = Model_Base_User::check_permission(self::$method);
        $pages = ['signin', 'notice'];
        if ($this->login === false && !in_array($this->action, $pages)) {
            $url = '/admin/signin';
        } elseif ($this->permission === false && !in_array($this->action, $pages)) {
            $url = true;
        }

        if (is_object($this->template) && isset($url) && $url !== true) {
            Response::redirect($url);
        } elseif (isset($url)) {
            $this->is_permission = false;
        } else {
            $this->is_permission = true;
        }

        return true;
    }

    public function init()
    {
        if ($this->login) {
            list(, $user_id) = Auth::get_user_id();
            $this->user_id = $user_id;
            $this->user_info = Model_Base_User::get_user_info($user_id);
            View::set_global('user_info', $this->user_info);
            View::set_global('head', View::forge($this->layout . '/global/head'));
            View::set_global('header', View::forge($this->layout . '/global/header'));
            View::set_global('sidebar', View::forge($this->layout . '/global/sidebar'));
            View::set_global('breadcrumb', View::forge($this->layout . '/global/breadcrumb'));
            View::set_global('footer', View::forge($this->layout . '/global/footer'));
            View::set_global('script', View::forge($this->layout . '/global/script'));
        }
        View::set_global('controller', $this->controller);
        View::set_global('action', $this->action);
        View::set_global('base_url', Config::get('base_url'));
    }

}
