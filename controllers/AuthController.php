<?php

require_once(MODEL_PATH . 'AuthModel.php');
require_once(VIEW_PATH . 'AuthView.php');

class AuthController extends Controller 
{
    public function __construct() 
    {
        $this->model = new AuthModel();
        $this->view = new AuthView();
    }

    public function login() 
    {
        $this->pageData['title'] = "Главная страница";
        $this->view->render($this->pageData);
    }
}