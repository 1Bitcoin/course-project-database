<?php

require_once(COMPONENT_BASE . 'Model.php');
require_once(CONNECTION . 'Connection.php');

class LoginModel extends Model 
{
    protected $connection;

    public function __construct(UserRepository $userRepository, $roleID) 
    {
        $this->connection = new Connection($roleID);
        $this->repo = $userRepository;
    }
    
    public function loginUser($infoUser)
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
            
            if (isset($response['response']))
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