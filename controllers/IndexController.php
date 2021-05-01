<?php

require_once(VIEW_PATH . 'IndexView.php');
require_once(CONTROLLER_PATH . 'Controller.php');

require_once(ROOT . '/vendor/autoload.php');

use \RedBeanPHP\R as R;

class IndexController extends Controller 
{
    public function __construct() 
    {
        $this->view = new IndexView();
    }

    public function indexPage() 
    {
        $this->pageData['title'] = "Главная страница";

        R::setup('mysql:host=localhost;dbname=file_hosting','root', '1234');
 
        // Проверка подключения к БД
        if(!R::testConnection()) 
            print_r('No DB connection!');
        else
            print_r("work!");

        /*if (isset($_SESSION['logged_user']))
        {
            $this->view->render($this->pageData);
        }
        else
        {
            $this->view->renderGuestPage($this->pageData);
        }*/
    }
}