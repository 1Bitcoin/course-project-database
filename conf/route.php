<?php

class Routing 
{
	public static function run() 
    {
		// Контроллер и его метод по умолчанию
		$controllerName = "IndexController";
		$action = "indexPage";

        // Получить имя необходимого контроллера
		$route = explode("/", $_SERVER['REQUEST_URI']);

		if (empty($route)) 
        {
			$controllerName = ucfirst($route[1] . "Controller");
		}

        // Подключить файл нужного контроллера
		require_once(CONTROLLER_PATH . $controllerName . ".php"); 

        // Получить имя необходимого метода
		if (isset($route[2])) 
        {
			$action = $route[2];
		}

		$controller = new $controllerName();
		$controller->$action();
	}

	public function errorPage() 
    {

	}


}