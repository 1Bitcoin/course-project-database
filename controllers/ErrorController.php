<?php

require_once(VIEW_PATH . 'ErrorView.php');
require_once(CONTROLLER_PATH . 'Controller.php');

class ErrorController extends Controller 
{
    public function __construct() 
    {
        $this->view = new ErrorView();
    }

    public function errorPage() 
    {
        $this->pageData['title'] = "Страница не найдена";
        $this->view->render($this->pageData);
    }
}