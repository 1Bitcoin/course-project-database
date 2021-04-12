<?php

require_once(MODEL_PATH . 'RegisterModel.php');
require_once(VIEW_PATH . 'RegisterView.php');
require_once(CONTROLLER_PATH . 'Controller.php');
require_once(ROOT . '/repository/UserRepository.php');
require_once(ROOT . '/repository/MySqlStorage.php');

class RegisterController extends Controller 
{
    public function __construct() 
    {
        $myStorage = new MySqlStorage();
        $userRepository = new UserRepository($myStorage);

        $this->model = new RegisterModel($userRepository);
        $this->view = new RegisterView();
    }

    public function registerPage() 
    {
        if (!empty($_POST))
        {
            $this->register();

        }
        else
            $this->view->render($this->pageData);
    }

    public function register()
    {
        $infoUser['email'] = htmlspecialchars($_POST['email']);
        $infoUser['hash_password'] = md5(htmlspecialchars($_POST['password']));
        $infoUser['repeat_hash_password'] = md5(htmlspecialchars($_POST['repeat_password']));

        $this->model->userRegister($infoUser);
    }
}