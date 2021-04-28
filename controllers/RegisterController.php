<?php

require_once(MODEL_PATH . 'RegisterModel.php');
require_once(VIEW_PATH . 'RegisterView.php');
require_once(VIEW_PATH . 'MainView.php');
require_once(CONTROLLER_PATH . 'Controller.php');
require_once(ROOT . '/repository/UserRepository.php');

class RegisterController extends Controller 
{
    public $mainView;
    public function __construct() 
    {
        $userRepository = new UserRepository();

        $this->model = new RegisterModel($userRepository);

        $this->view = new RegisterView();
        $this->mainView = new MainView();
    }

    public function registerPage() 
    {
        // Если нажата кнопка submit в форме регистрации, то вызываем метод-обработчик.
        if (isset($_POST['register']))
        {
            $this->register();
        }
        else
        {
            // Иначе отображаем форму для регистрации, если пользователь не авторизован.
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

    public function register()
    {
        // Получаем данные из формы, экранируем(для безопасности), пароли хэшируем.
        $infoUser['email'] = htmlspecialchars($_POST['email']);
        $infoUser['name'] = htmlspecialchars($_POST['name']);
        $infoUser['hash_password'] = htmlspecialchars($_POST['password']);
        $infoUser['repeat_hash_password'] = htmlspecialchars($_POST['repeat_password']);

        $this->pageData = $this->model->userRegister($infoUser);

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