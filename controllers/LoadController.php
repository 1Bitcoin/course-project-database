<?php

require_once(MODEL_PATH . 'LoadModel.php');
require_once(VIEW_PATH . 'LoadView.php');
require_once(CONTROLLER_PATH . 'Controller.php');

class LoadController extends Controller 
{
    public function __construct() 
    {
        $this->model = new LoadModel();
        $this->view = new LoadView();
    }

    public function loadFile()
    {
        $this->model->load($_FILES);
    }
}