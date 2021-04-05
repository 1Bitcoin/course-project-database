<?php

require_once(MODEL_PATH . 'FileModel.php');
require_once(VIEW_PATH . 'FileView.php');
require_once(CONTROLLER_PATH . 'Controller.php');

class FileController extends Controller 
{
    public function __construct() 
    {
        $this->model = new FileModel();
        $this->view = new FileView();
    }

    public function showFiles() 
    {
        $limit = 2;
        $page = 1;

        // Получить номер страницы из url
        if (isset($_GET['page'])) 
        {  
            $page = $_GET['page'];  
        } 

        $this->pageData = $this->model->getUsers($limit, $page);  
        $this->view->render($this->pageData);
    }
}