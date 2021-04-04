<?php

require_once(MODEL_PATH . 'IndexModel.php');
require_once(VIEW_PATH . 'IndexView.php');
require_once(CONTROLLER_PATH . 'Controller.php');

class IndexController extends Controller 
{
    public function __construct() 
    {
        $this->model = new IndexModel();
        $this->view = new IndexView();
    }

    public function indexPage() 
    {
        $this->pageData['title'] = "Главная страница";
        $this->pageData['users'] = $this->model->getUsers();

        $this->view->render($this->pageData);
    }
}