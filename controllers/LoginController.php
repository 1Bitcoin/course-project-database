<?php

require_once(MODEL_PATH . 'LoginModel.php');
require_once(VIEW_PATH . 'LoginView.php');
require_once(VIEW_PATH . 'MainView.php');
require_once(CONTROLLER_PATH . 'Controller.php');
require_once(ROOT . '/repository/user/UserRepository.php');


class LoginController extends Controller 
{
    public $mainView;
    public function __construct() 
    {
        // Необходимо для авторизации на уровне БД
        $roleID = $this->getRole();

        $userRepository = new UserRepository();

        $this->model = new LoginModel($userRepository, $roleID);

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

        $this->pageData = $this->model->loginUser($infoUser);

       if (empty($this->pageData['errors']))
        {
            $_SESSION['logged_user'] = $this->pageData['userInfo'];
            $this->mainView->render($this->pageData);
        }
        else
        {
            $this->view->render($this->pageData);
        }
    }
}