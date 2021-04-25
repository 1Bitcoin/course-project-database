<?php

require_once(MODEL_PATH . 'Model.php');

class RegisterModel extends Model 
{
    public function __construct(UserRepository $userRepository) 
    {
        $this->repo = $userRepository;
    }

    public function userRegister($infoUser)
    {
        $errors = array();

        if ($infoUser['email'] == "")
            $errors[] = "Введите email!";

        if ($infoUser['name'] == "")
            $errors[] = "Введите name!";

        if ($infoUser['hash_password'] == "")
            $errors[] = "Введите пароль!";

        $result = $this->repo->checkExistsUser($infoUser); 

        if (!$result['nums'])
        {           
            if ($infoUser['hash_password'] == $infoUser['repeat_hash_password'])
            {
                $infoUser['hash_password'] = md5($infoUser['hash_password']);
                $infoUser['repeat_hash_password'] = md5($infoUser['repeat_hash_password']);
                
                $this->repo->addUser($infoUser);
            }
            else
            {
                // Введенные пароли не совпадают
                $errors[] = "Пароли не совпадают!";
            }
        }
        else
        {
            // Пользователь уже зарегистрирован
            $errors[] = "Пользователь уже зарегистрирован!";
        }

        return $errors;
    }
}