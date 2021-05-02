<?php

require_once(VIEW_PATH . 'IndexView.php');
require_once(CONTROLLER_PATH . 'Controller.php');

class IndexController extends Controller 
{
    public function __construct() 
    {
        $this->view = new IndexView();
    }

    public function indexPage() 
    {
        $this->pageData['title'] = "Главная страница";

        if (isset($_SESSION['logged_user']))
        {
            $this->view->render($this->pageData);
        }
        else
        {
            $this->view->renderGuestPage($this->pageData);
        }
    }
}