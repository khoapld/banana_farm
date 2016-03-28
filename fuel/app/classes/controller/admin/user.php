<?php

use Fuel\Core\Lang;
use Fuel\Core\View;
use Fuel\Core\Response;
use Fuel\Core\Input;

class Controller_Admin_User extends Controller_Base_Admin
{

    public function before()
    {
        parent::before();
    }

    public function after($response)
    {
        $response = parent::after($response);
        return $response;
    }

    public function action_profile()
    {
        $user_config = Model_Service_Util::get_app_config('user', array('status', 'gender', 'group'));
        $user = Model_Base_User::get_user_info($this->user_id);
        View::set_global('user_config', $user_config);
        View::set_global('user', $user);
        $this->template->content = View::forge($this->layout . '/user/profile', $this->data);
    }

    public function action_list()
    {
        $total_page = ceil(Model_Base_User::count_all() / _DEFAULT_LIMIT_);
        View::set_global('total_page', $total_page);
        $this->data['users'] = Model_Base_User::get_all(['group' => 'asc', 'id' => 'desc']);
        $this->data['user_config'] = Model_Service_Util::get_app_config('user', array('status', 'group'));
        $this->template->content = View::forge($this->layout . '/user/list', $this->data);
    }

    public function action_new()
    {
        $user_config = Model_Service_Util::get_app_config('user', array('status', 'gender', 'group'));
        View::set_global('user_config', $user_config);
        $this->template->content = View::forge($this->layout . '/user/new', $this->data);
    }

    public function action_edit($id = false)
    {
        if (empty($id) || !Model_Base_User::valid_field('id', $id)) {
            Response::redirect('/admin/user');
        }
        $user_config = Model_Service_Util::get_app_config('user', array('status', 'gender', 'group'));
        $user = Model_Base_User::get_user_info($id);
        View::set_global('user_config', $user_config);
        View::set_global('user', $user);
        $this->template->content = View::forge($this->layout . '/user/new', $this->data);
    }

    public function post_list()
    {
        $page = (int) Input::post('page') !== 0 ? (int) Input::post('page') : 1;
        $total = Model_Base_User::count_all();
        $limit = _DEFAULT_LIMIT_;
        $offset = ($page - 1) * $limit < $total ? ($page - 1) * $limit : _DEFAULT_OFFSET_;
        $this->data['users'] = Model_Base_User::get_all(['group' => 'asc', 'id' => 'desc'], $offset, $limit);
        $this->data['user_config'] = Model_Service_Util::get_app_config('user', array('status', 'group'));

        return new Response(View::forge($this->layout . '/user/partial/_list', $this->data));
    }

    public function post_create()
    {
        $val = Validation::forge();
        $val->add_callable('MyRules');
        $val->add_field('username', Lang::get('label.username'), 'required|valid_username|min_length[3]|max_length[50]|unique_username');
        $val->add_field('password', Lang::get('label.password'), 'required|valid_password|min_length[3]|max_length[50]');
        $val->add_field('status', Lang::get('label.status'), 'required|valid_status');
        $val->add_field('group', Lang::get('label.group'), 'required|valid_group');
        $val->add_field('full_name', Lang::get('label.full_name'), 'required|max_length[255]');

        $val->add_field('gender', Lang::get('label.gender'), 'trim|valid_gender');
        $val->add_field('email', Lang::get('label.email'), 'trim|valid_email|max_length[255]|unique_email');
        $val->add_field('telephone', Lang::get('label.telephone'), 'trim|valid_numeric|max_length[12]');
        $val->add_field('address', Lang::get('label.address'), 'trim|max_length[255]');
        if ($val->run()) {
            $props = [
                'username' => $val->validated('username'),
                'password' => Model_Service_Util::hash_password($val->validated('password')),
                'status' => $val->validated('status'),
                'group' => $val->validated('group'),
                'full_name' => Model_Service_Util::mb_trim($val->validated('full_name')),
                'gender' => $val->validated('gender'),
                'email' => strtolower($val->validated('email')),
                'telephone' => $val->validated('telephone'),
                'address' => Model_Service_Util::mb_trim($val->validated('address'))
            ];
            if (Model_Base_User::insert($props)) {
                $this->data['success'] = true;
            } else {
                $this->data['error'] = Lang::get('system_error');
            }
        } else {
            $this->data['errors'] = $val->error_message();
        }

        return $this->response($this->data);
    }

    public function post_update($id)
    {
        $val = Validation::forge();
        $val->add_callable('MyRules');
        $val->add_field('username', Lang::get('label.username'), 'required|valid_username|min_length[3]|max_length[50]|update_username[' . $id . ']');
        $val->add_field('password', Lang::get('label.password'), 'valid_password|min_length[3]|max_length[50]');
        $val->add_field('status', Lang::get('label.status'), 'required|valid_status');
        $val->add_field('group', Lang::get('label.group'), 'required|valid_group');
        $val->add_field('full_name', Lang::get('label.full_name'), 'required|max_length[255]');

        $val->add_field('gender', Lang::get('label.gender'), 'valid_gender');
        $val->add_field('email', Lang::get('label.email'), 'valid_email|max_length[255]|update_email[' . $id . ']');
        $val->add_field('telephone', Lang::get('label.telephone'), 'valid_numeric|max_length[12]');
        $val->add_field('address', Lang::get('label.address'), 'max_length[255]');
        if ($val->run()) {
            $gender = $val->validated('gender');
            $props = [
                'username' => $val->validated('username'),
                'status' => $val->validated('status'),
                'group' => $val->validated('group'),
                'full_name' => Model_Service_Util::mb_trim($val->validated('full_name')),
                'gender' => empty($gender) ? 0 : $gender,
                'email' => strtolower($val->validated('email')),
                'telephone' => $val->validated('telephone'),
                'address' => Model_Service_Util::mb_trim($val->validated('address'))
            ];
            if (!empty($val->validated('password'))) {
                $props['password'] = Model_Service_Util::hash_password($val->validated('password'));
            }
            if (Model_Base_User::update($id, $props)) {
                $this->data['success'] = true;
            } else {
                $this->data['error'] = Lang::get('system_error');
            }
        } else {
            $this->data['errors'] = $val->error_message();
        }

        return $this->response($this->data);
    }

    public function post_profile()
    {
        $val = Validation::forge();
        $val->add_callable('MyRules');
        $val->add_field('password', Lang::get('label.password'), 'valid_password|min_length[3]|max_length[50]');
        $val->add_field('full_name', Lang::get('label.full_name'), 'required|max_length[255]');
        $val->add_field('gender', Lang::get('label.gender'), 'valid_gender');
        $val->add_field('email', Lang::get('label.email'), 'valid_email|max_length[255]|update_email[' . $this->user_id . ']');
        $val->add_field('telephone', Lang::get('label.telephone'), 'valid_numeric|max_length[12]');
        $val->add_field('address', Lang::get('label.address'), 'max_length[255]');
        if ($val->run()) {
            $gender = $val->validated('gender');
            $props = [
                'full_name' => Model_Service_Util::mb_trim($val->validated('full_name')),
                'gender' => empty($gender) ? 0 : $gender,
                'email' => strtolower($val->validated('email')),
                'telephone' => $val->validated('telephone'),
                'address' => Model_Service_Util::mb_trim($val->validated('address'))
            ];
            if (!empty($val->validated('password'))) {
                $props['password'] = Model_Service_Util::hash_password($val->validated('password'));
            }
            if (Model_Base_User::update($this->user_id, $props)) {
                $this->data['success'] = Lang::get($this->controller . '.' . $this->action . '.success');
            } else {
                $this->data['error'] = Lang::get('system_error');
            }
        } else {
            $this->data['errors'] = $val->error_message();
        }

        return $this->response($this->data);
    }

    public function post_group()
    {
        $val = Validation::forge();
        $val->add_callable('MyRules');
        $val->add_field('group', Lang::get('label.group'), 'required|valid_group');
        $val->add_field('user_id', Lang::get('label.user'), 'required|valid_user');
        if ($val->run()) {
            Model_Base_User::update($val->validated('user_id'), ['group' => $val->validated('group')]);
            $this->data['success'] = Lang::get($this->controller . '.' . $this->action . '.success');
        } else {
            $this->data['errors'] = $val->error_message();
        }

        return $this->response($this->data);
    }

    public function post_status()
    {
        $val = Validation::forge();
        $val->add_callable('MyRules');
        $val->add_field('status', Lang::get('label.status'), 'required|valid_status');
        $val->add_field('user_id', Lang::get('label.user'), 'required|valid_user');
        if ($val->run()) {
            Model_Base_User::update($val->validated('user_id'), ['status' => $val->validated('status')]);
            $this->data['success'] = Lang::get($this->controller . '.' . $this->action . '.success');
        } else {
            $this->data['errors'] = $val->error_message();
        }

        return $this->response($this->data);
    }

}
