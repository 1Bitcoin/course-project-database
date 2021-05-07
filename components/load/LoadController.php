<?php

require_once(COMPONENT_LOAD . 'LoadModel.php');
require_once(COMPONENT_LOAD . 'LoadView.php');
require_once(COMPONENT_BASE . 'Controller.php');

class LoadController extends Controller 
{
    public function __construct() 
    {
        // Необходимо для авторизации на уровне БД
        $roleID = $this->getRole();
        
        $fileRepository = new FileRepository();

        $this->model = new LoadModel($fileRepository, $roleID);
        $this->view = new LoadView();
    }

    public function loadFile()
    {
        $dataFiles = $_FILES;
        $data = json_decode($_COOKIE['logged_user'], true);

        $dataFiles['user_id'] = $data['id'];
        $infoFile = $this->model->loadFile($dataFiles);
        $this->model->addFile($infoFile);
    }

}