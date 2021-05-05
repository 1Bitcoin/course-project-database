<?php

require_once(COMPONENT_LOGOUT . 'LogoutModel.php');
require_once(COMPONENT_BASE . 'Controller.php');

class LogoutController extends Controller 
{
    public function __construct() 
    {
        $this->model = new LogoutModel();
        $this->view = new MainView();
    }

    public function logout() 
    {
        unset($_SESSION['logged_user']);
        $this->view->render($this->pageData);
    }
}