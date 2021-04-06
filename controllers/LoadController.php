<?php

require_once(MODEL_PATH . 'LoadModel.php');
require_once(VIEW_PATH . 'LoadView.php');
require_once(CONTROLLER_PATH . 'Controller.php');

class LoadController extends Controller 
{
    public function __construct() 
    {
        $MyStorage = new MySqlStorage();
        $FileRepository = new FileRepository($MyStorage);

        $this->model = new LoadModel($FileRepository);
        $this->view = new LoadView();
    }

    public function loadFile()
    {
        $dataFiles = $_FILES;
        $infoFile = $this->model->loadFile($dataFiles);
        $this->model->addFile($infoFile);
    }

}