<?php

//require_once(CONTROLLER_PATH . "ErrorController.php");

class Routing 
{
    public static function run() 
    {
        // Контроллер и его метод по умолчанию
        $controllerName = "IndexController";
        $action = "indexPage";

        // Получить имя необходимого контроллера
        $route = explode("/", $_SERVER['REQUEST_URI']);

        if ($route[1] != '') 
        {
            $controllerName = ucfirst($route[1] . "Controller");
            $action = $route[1] . "Page";
        }

        // Проверка существования контроллера
        if (!file_exists(CONTROLLER_PATH . $controllerName . ".php"))
        {
            require_once(CONTROLLER_PATH . "ErrorController" . ".php"); 
            $controller = new ErrorController();
            $controller->errorPage();

            return -1;
        }

        // Подключить файл нужного контроллера
        require_once(CONTROLLER_PATH . $controllerName . ".php"); 
        
        $controller = new $controllerName();
        $controller->$action();  
    }
}