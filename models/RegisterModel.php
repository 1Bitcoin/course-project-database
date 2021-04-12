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
        if ($infoUser['hash_password'] == $infoUser['repeat_hash_password'])
        {
            // Если такого пользователя нет в базе данных, то добавляем его.
            if (!$this->repo->checkUniquenessUser($infoUser))
            {
                $status = $this->repo->addUser($infoUser);
            }
        }
        else
        {

        }
    }

}