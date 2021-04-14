<?php

require_once(MODEL_PATH . 'FileModel.php');
require_once(VIEW_PATH . 'FileView.php');
require_once(VIEW_PATH . 'ErrorView.php');
require_once(CONTROLLER_PATH . 'Controller.php');
require_once(ROOT . '/repository/FileRepository.php');
require_once(ROOT . '/repository/UserRepository.php');
require_once(ROOT . '/repository/RoleRepository.php');
require_once(ROOT . '/repository/MySqlStorage.php');

class FileController extends Controller 
{
    public $errorView;
    public function __construct() 
    {
        $myStorage = new MySqlStorage();
        $fileRepository = new FileRepository($myStorage);
        $userRepository = new UserRepository($myStorage);
        $roleRepository = new RoleRepository($myStorage);

        $this->model = new FileModel($fileRepository, $userRepository, $roleRepository);

        $this->view = new FileView();
        $this->errorView = new ErrorView();
    }

    public function showFiles() 
    {
        $limit = 15;
        $page = $_GET['page'];
 
        $this->pageData = $this->model->filesPagination($limit, $page);  
        $this->view->render($this->pageData);
    }

    public function getFile() 
    {
        $hash = $_GET['hash'];
        $this->pageData = $this->model->getFileByHash($hash);

        if (!empty($this->pageData))
            $this->view->filePage($this->pageData);
        else
            $this->errorView->render();
    }
}