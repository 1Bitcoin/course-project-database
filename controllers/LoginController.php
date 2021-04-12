<?php

require_once(MODEL_PATH . 'LoginModel.php');
require_once(VIEW_PATH . 'LoginView.php');
require_once(CONTROLLER_PATH . 'Controller.php');
require_once(ROOT . '/repository/UserRepository.php');
require_once(ROOT . '/repository/MySqlStorage.php');


class LoginController extends Controller 
{
    public function __construct() 
    {
        $myStorage = new MySqlStorage();
        $userRepository = new UserRepository($myStorage);

        $this->model = new LoginModel($userRepository);
        $this->view = new LoginView();
    }

    public function loginPage() 
    {
        /*if (!empty($_POST))
            login();
        else*/
            $this->view->render($this->pageData);
    }

    public function login()
    {
        $username = htmlspecialchars($_POST['name']);
        $password = htmlspecialchars($_POST['password']);

    }
}