<?php

use Fuel\Core\Lang;
use Fuel\Core\View;

class Controller_Admin_Dashboard extends Controller_Base_Admin
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

    public function action_index()
    {
        $this->template->content = View::forge($this->layout . '/dashboard/index', $this->data);
    }

}
