<?php

require_once(MODEL_PATH . 'LoginModel.php');
require_once(VIEW_PATH . 'LoginView.php');
require_once(VIEW_PATH . 'MainView.php');
require_once(CONTROLLER_PATH . 'Controller.php');
require_once(ROOT . '/repository/UserRepository.php');
require_once(ROOT . '/repository/MySqlStorage.php');


class LoginController extends Controller 
{
    public $mainView;
    public function __construct() 
    {
        $myStorage = new MySqlStorage();
        $userRepository = new UserRepository($myStorage);

        $this->model = new LoginModel($userRepository);

        $this->view = new LoginView();
        $this->mainView = new MainView();
    }

    public function loginPage() 
    {
        if (isset($_POST['login']))
        {
            $this->login();
        }
        else
        {
            // Иначе отображаем форму для авторизации, если пользователь не авторизован.
            if (isset($_SESSION['logged_user']))
            {
                $this->mainView->render($this->pageData);
            }
            else
            {
                $this->view->render($this->pageData);
            } 
        }
    }

    public function login()
    {
        // Получаем данные из формы, экранируем(для безопасности), пароли хэшируем.
        $infoUser['email'] = htmlspecialchars($_POST['email']);
        $infoUser['hash_password'] = htmlspecialchars($_POST['password']);

        $this->pageData = $this->model->userLogin($infoUser);

       if (empty($this->pageData))
        {
            $this->mainView->render($this->pageData);
        }
        else
        {
            $this->view->render($this->pageData);
        }
    }
}