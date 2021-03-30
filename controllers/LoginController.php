<?php

require_once(MODEL_PATH . 'LoginModel.php');
require_once(VIEW_PATH . 'LoginView.php');

class LoginController extends Controller 
{
    public function __construct() 
    {
        $this->model = new LoginModel();
        $this->view = new LoginView();
    }

    public function loginPage() 
    {
        $this->pageData['title'] = "Страница авторизации";
        $this->view->render($this->pageData);
    }
}