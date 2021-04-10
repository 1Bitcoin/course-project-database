<?php

require_once(MODEL_PATH . 'FileModel.php');
require_once(VIEW_PATH . 'FileView.php');
require_once(CONTROLLER_PATH . 'Controller.php');
require_once(ROOT . '/repository/FileRepository.php');
require_once(ROOT . '/repository/MySqlStorage.php');

class FileController extends Controller 
{
    public function __construct() 
    {
        $myStorage = new MySqlStorage();
        $fileRepository = new FileRepository($myStorage);

        $this->model = new FileModel($fileRepository);
        $this->view = new FileView();
    }

    public function showFiles() 
    {
        $limit = 15;
        $page = $_GET['page'];
 
        $this->pageData = $this->model->filesPagination($limit, $page);  
        $this->view->render($this->pageData);
    }
}