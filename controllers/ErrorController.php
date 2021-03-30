<?php

require_once(VIEW_PATH . 'ErrorView.php');
require_once(MODEL_PATH . 'ErrorModel.php');

class ErrorController extends Controller 
{
    public function __construct() 
    {
        $this->view = new ErrorModel();
        $this->view = new ErrorView();
    }

    public function errorPage() 
    {
        $this->pageData['title'] = "Страница не найдена";
        $this->view->render($this->pageData);
    }
}