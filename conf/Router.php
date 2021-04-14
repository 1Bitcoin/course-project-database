<?php

require(CONTROLLER_PATH . "IndexController.php");
require(CONTROLLER_PATH . "LoginController.php");
require(CONTROLLER_PATH . "LoadController.php");
require(CONTROLLER_PATH . "ErrorController.php");
require(CONTROLLER_PATH . "FileController.php");
require(CONTROLLER_PATH . "RegisterController.php");
require(CONTROLLER_PATH . "LogoutController.php");

class Routing 
{
    public static function run() 
    {
        $url = parse_url($_SERVER['REQUEST_URI']);

        switch ($url["path"]) 
        {
            case "/":                    
                $controller = new IndexController();
                $controller->indexPage();  
                break;

            case "/login":
                $controller = new LoginController();
                $controller->loginPage();  
                break;

            case "/load":
                $controller = new LoadController();
                $controller->loadFile();  
                break;  

            case "/register":
                $controller = new RegisterController();
                $controller->registerPage();  
                break; 

            case "/list":
                $controller = new FileController();
                $controller->showFiles();  
                break;  

            case "/file":
                $controller = new FileController();
                $controller->getFile();  
                break;  

            case "/logout":
                $controller = new LogoutController();
                $controller->logout();  
                break;  

            default:
                $controller = new ErrorController();
                $controller->errorPage();
        }
    }
}