<?php

require_once(COMPONENT_INDEX . 'IndexView.php');
require_once(COMPONENT_BASE . 'Controller.php');

class IndexController extends Controller 
{
    public function __construct() 
    {
        $this->view = new IndexView();
    }

    public function indexPage() 
    {
        if (isset($_COOKIE['logged_user']))
        {
            $this->view->render($this->pageData);
        }
        else
        {
            $this->view->renderGuestPage($this->pageData);
        }
    }
}