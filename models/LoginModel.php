<?php

require_once(MODEL_PATH . 'Model.php');

class LoginModel extends Model 
{
    public function __construct(UserRepository $userRepository) 
    {
        $this->repo = $userRepository;
    }
    

}