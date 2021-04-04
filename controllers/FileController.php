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
        $this->pageData['users'] = $this->model->getUsers();
        $this->view->render($this->pageData);
    }
}