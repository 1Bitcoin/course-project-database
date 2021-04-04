<?php

require(CONTROLLER_PATH . "IndexController.php");
require(CONTROLLER_PATH . "LoginController.php");
require(CONTROLLER_PATH . "LoadController.php");
require(CONTROLLER_PATH . "ErrorController.php");
require(CONTROLLER_PATH . "FileController.php");

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

            case "/list":
                $controller = new FileController();
                $controller->showFiles();  
                break;  

            default:
                $controller = new ErrorController();
                $controller->errorPage();
        }
    }
}