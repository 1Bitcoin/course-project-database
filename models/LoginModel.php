<?php

require_once(MODEL_PATH . 'Model.php');

class LoginModel extends Model 
{
    public function __construct(UserRepository $userRepository) 
    {
        $this->repo = $userRepository;
    }
    
    public function userLogin($infoUser)
    {
        $errors = array();

        if ($infoUser['email'] == "")
            $errors[] = "Введите email!";

        if ($infoUser['hash_password'] == "")
            $errors[] = "Введите пароль!";

        $infoUser['hash_password'] = md5($infoUser['hash_password']);

        $result = $this->repo->checkExistsUser($infoUser);

        if ($result['nums'])
        {
            $_SESSION['logged_user'] = $result['response'];
        }
        else
        {
            // Пользователь не зарегестрирован
            $errors[] = "Пользователь не зарегестрирован!";
        }

        return $errors;
    }
}