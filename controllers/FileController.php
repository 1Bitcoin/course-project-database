<?php

require_once(MODEL_PATH . 'FileModel.php');
require_once(VIEW_PATH . 'FileView.php');
require_once(VIEW_PATH . 'ErrorView.php');
require_once(CONTROLLER_PATH . 'Controller.php');
require_once(ROOT . '/repository/FileRepository.php');
require_once(ROOT . '/repository/UserRepository.php');
require_once(ROOT . '/repository/RoleRepository.php');
require_once(ROOT . '/repository/CommentRepository.php');
require_once(ROOT . '/repository/MySqlStorage.php');

class FileController extends Controller 
{
    public $errorView;
    public function __construct() 
    {
        $myStorage = new MySqlStorage();
        $fileRepository = new FileRepository($myStorage);
        $userRepository = new UserRepository($myStorage);
        $roleRepository = new RoleRepository($myStorage);
        $commentRepository = new CommentRepository($myStorage);

        $this->model = new FileModel($fileRepository, $userRepository, $roleRepository, $commentRepository);

        $this->view = new FileView();
        $this->errorView = new ErrorView();
    }

    public function showFiles() 
    {
        $limit = 15;
        $page = $_GET['page'];
 
        $this->pageData = $this->model->filesPagination($limit, $page);  
        $this->view->render($this->pageData);
    }

    public function getFile() 
    {
        if (isset($_GET['hash']))
        {
            $hash = $_GET['hash'];

            $this->pageData = $this->model->getFileByHash($hash);
            $this->pageData['info']['comment'] = $this->model->getCommentFile($this->pageData['info']['file']['id']);
    
            if (empty($this->pageData['error']))
            {
                if (isset($_SESSION['logged_user']))
                {
                    $this->view->filePage($this->pageData['info']);
                } 
                else
                {
                    $this->view->filePageGuest($this->pageData['info']);
                }
            }
            else
            {
                $this->errorView->render($this->pageData['error']);
            }
        }
        else if (isset($_GET['comment']))
        {
            $this->addCommentFile();
        }
        else
        {
            $this->errorView->render($this->pageData);
        }
    }

    public function addCommentFile()
    {
        $hash = $_GET['comment'];

        // Получаем данные из формы
        $infoComment['comment'] = htmlspecialchars($_POST['comment']);
        $infoComment['hash_file'] = $hash;
        $infoComment['user_email'] = $_SESSION['logged_user']['email'];

        $status = $this->model->addCommentFile($infoComment);

        // Переадресация на страницу файла
        $url = "https://iu7.ru/file?hash=" . $hash;
        header("Location: $url");
    }
}