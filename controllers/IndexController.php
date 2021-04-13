<?php

require_once(VIEW_PATH . 'IndexView.php');
require_once(VIEW_PATH . 'GuestView.php');
require_once(CONTROLLER_PATH . 'Controller.php');

class IndexController extends Controller 
{
    public $guestView;
    public function __construct() 
    {
        $this->view = new IndexView();
        $this->guestView = new GuestView();
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
            $this->guestView->render($this->pageData);
        }
    }
}