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
        $answer = array();

        if ($infoUser['email'] == "")
            $answer['errors'] = "Введите email!";

        if ($infoUser['hash_password'] == "")
            $answer['errors'] = "Введите пароль!";

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
                $answer['userInfo'] = $response['response'];
            }
            else
            {
                $answer['errors'] = "Неверный пароль!";
            }          
        }
        else
        {
            $answer['errors'] = "Пользователь не зарегестрирован!";
        }

        return $answer;
    }
}