<?php

use Fuel\Core\Lang;
use Fuel\Core\View;

class Controller_Admin_Permission extends Controller_Base_Admin
{

    public function before()
    {
        parent::before();
        $this->is_admin();
    }

    public function after($response)
    {
        $response = parent::after($response);
        return $response;
    }

    public function action_notice()
    {
        $this->template->content = View::forge($this->layout . '/permission/notice', $this->data);
    }

    public function action_list()
    {
        $this->data['groups'] = Model_Base_Group::get_all();
        $this->data['pages'] = Model_Base_Permission::get_page_list();
        $this->data['permission'] = Model_Base_Permission::get_permission_data();
        $this->template->content = View::forge($this->layout . '/permission/list', $this->data);
    }

    public function post_update()
    {
        $val = Validation::forge();
        $val->add_callable('MyRules');
        $val->add_field('action', Lang::get('label.permission_action'), 'required|valid_permission_action');
        $val->add_field('group', Lang::get('label.group'), 'valid_permission_group');
        if ($val->run()) {
            $props = [
                'action' => Model_Service_Util::mb_trim($val->validated('action')),
                'group' => empty($val->validated('group')) ? '' : json_encode($val->validated('group'))
            ];
            if (Model_Base_Permission::update($props)) {
                $this->data['success'] = Lang::get($this->controller . '.' . $this->action . '.success');
            } else {
                $this->data['error'] = Lang::get('system_error');
            }
        } else {
            $this->data['errors'] = $val->error_message();
        }

        return $this->response($this->data);
    }

}
