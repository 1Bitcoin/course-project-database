<?php

class Controller 
{
    public $model;
    public $view;
    protected $pageData = array();

    public function __construct() 
    {
        $this->view = new View();
        $this->model = new Model();
    }	

    public function getRole()
    {
        // roleID = 0 - гость
        $roleID = 0;

        if (isset($_SESSION['logged_user']))
        {
            $roleID = $_SESSION['logged_user']['role_id'];
        }

        return $roleID;
    }
}