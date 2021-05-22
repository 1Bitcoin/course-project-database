<?php

require_once(COMPONENT_LIST . 'ListModel.php');
require_once(COMPONENT_LIST . 'ListView.php');
require_once(COMPONENT_ERROR . 'ErrorView.php');
require_once(COMPONENT_BASE . 'Controller.php');
require_once(REPOSITORY . 'file/FileRepository.php');

class ListController extends Controller 
{
    public $errorView;
    public function __construct() 
    {
        // Необходимо для авторизации на уровне БД
        $roleID = $this->getRole();

        $fileRepository = new FileRepository();

        $this->model = new ListModel($fileRepository, $roleID);

        $this->view = new ListView();
        $this->errorView = new ErrorView();
    }

    public function showFiles() 
    {
        $limit = 15;
        $page = $_GET['page'];
        $searchString = "";

        if (isset($_COOKIE['find_file_name']))
        {
            $searchString = json_decode($_COOKIE['find_file_name'], true);
        }

        $this->pageData = $this->model->filesPagination($limit, $page, $searchString); 
        $this->pageData['find_value'] = $searchString;
        $this->view->render($this->pageData);
    }

    public function processingRequest() 
    {
        if (isset($_POST['find_file']) && isset($_GET['page']))
        {
            $this->findFile();
        }
        else if (isset($_GET['page']))
        {
            $this->showFiles();
        }
        else
        {
            $this->errorView->render($this->pageData);
        }
    }

    public function findFile()
    {
        // Получаем данные из формы
        $infoRequest['file_name'] = htmlspecialchars($_POST['find_file']);
        $searchString = $infoRequest['file_name'];

        // Чтобы поисковое значение не слетало при пагинации(переходы по страницам результата)
        setcookie('find_file_name', json_encode($searchString), time()+3600, "/");

        $limit = 15;
        $page = $_GET['page'];
 
        $this->pageData = $this->model->filesPagination($limit, $page, $searchString);  
        $this->pageData['find_value'] = $searchString;

        // Переадресация на страницу файла
        $this->view->render($this->pageData);
    }
}