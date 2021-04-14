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

        // Существует ли пользователь с таким email.
        $result = $this->repo->checkExistsUser($infoUser);

        if ($result['nums'])
        {
            // Если существует, то проверить подходит ли пароль.
            $response = $this->repo->checkCoincidenceUser($infoUser);
            
            if ($response['response'])
            {
                // Если пароль верный, авторизуем.
                $_SESSION['logged_user'] = $response['response'];
            }
            else
            {
                $errors[] = "Неверный пароль!";
            }          
        }
        else
        {
            $errors[] = "Пользователь не зарегестрирован!";
        }

        return $errors;
    }
}