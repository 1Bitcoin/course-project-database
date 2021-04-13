<?php

require_once(VIEW_PATH . 'MainView.php');
require_once(MODEL_PATH . 'LogoutModel.php');
require_once(CONTROLLER_PATH . 'Controller.php');

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