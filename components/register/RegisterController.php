<?php

require_once(COMPONENT_REGISTER . 'RegisterModel.php');
require_once(COMPONENT_REGISTER . 'RegisterView.php');
require_once(COMPONENT_BASE . 'Controller.php');
require_once(REPOSITORY . 'user/UserRepository.php');

class RegisterController extends Controller 
{
    public function __construct() 
    {
        // Необходимо для авторизации на уровне БД
        $roleID = $this->getRole();

        $userRepository = new UserRepository();

        $this->model = new RegisterModel($userRepository, $roleID);

        $this->view = new RegisterView();
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
                $this->view->main($this->pageData);
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

        $this->pageData = $this->model->registerUser($infoUser);

        if (empty($this->pageData))
        {
            $this->view->main($this->pageData);
        }
        else
        {
            $this->view->render($this->pageData);
        }
    }
}