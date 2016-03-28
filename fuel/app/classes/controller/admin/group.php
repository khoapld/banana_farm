<?php

use Fuel\Core\Lang;
use Fuel\Core\View;
use Fuel\Core\Response;

class Controller_Admin_Group extends Controller_Base_Admin
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

    public function action_list()
    {
        $this->data['groups'] = Model_Base_Group::get_all();
        $this->template->content = View::forge($this->layout . '/group/list', $this->data);
    }

    public function post_create()
    {
        $val = Validation::forge();
        $val->add_callable('MyRules');
        $val->add_field('group', Lang::get('label.group'), 'required|max_length[50]');
        if ($val->run()) {
            $props = [
                'group' => Model_Service_Util::mb_trim($val->validated('group'))
            ];
            if (Model_Base_Group::insert($props)) {
                $this->data['success'] = true;
                $this->data['groups'] = Model_Base_Group::get_all();
                return new Response(View::forge($this->layout . '/group/partial/_list', $this->data));
            } else {
                $this->data['error'] = Lang::get('system_error');
            }
        } else {
            $this->data['errors'] = $val->error_message();
        }

        return $this->response($this->data);
    }

    public function post_update()
    {
        $val = Validation::forge();
        $val->add_callable('MyRules');
        $val->add_field('id', Lang::get('label.id'), 'required|valid_group');
        $val->add_field('group', Lang::get('label.group_name'), 'required|max_length[50]');
        if ($val->run()) {
            $props = [
                'group' => $val->validated('group')
            ];
            if (Model_Base_Group::update($val->validated('id'), $props)) {
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
