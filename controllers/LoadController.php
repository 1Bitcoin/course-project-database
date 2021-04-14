<?php

require_once(MODEL_PATH . 'LoadModel.php');
require_once(VIEW_PATH . 'LoadView.php');
require_once(CONTROLLER_PATH . 'Controller.php');

class LoadController extends Controller 
{
    public function __construct() 
    {
        $myStorage = new MySqlStorage();
        $fileRepository = new FileRepository($myStorage);

        $this->model = new LoadModel($fileRepository);
        $this->view = new LoadView();
    }

    public function loadFile()
    {
        $dataFiles = $_FILES;
        $dataFiles['user_id'] = $_SESSION['logged_user']['id'];
        $infoFile = $this->model->loadFile($dataFiles);
        $this->model->addFile($infoFile);
    }

}