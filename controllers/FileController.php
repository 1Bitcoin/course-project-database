<?php

require_once(MODEL_PATH . 'FileModel.php');
require_once(VIEW_PATH . 'FileView.php');
require_once(VIEW_PATH . 'ErrorView.php');
require_once(CONTROLLER_PATH . 'Controller.php');
require_once(ROOT . '/repository/FileRepository.php');
require_once(ROOT . '/repository/UserRepository.php');
require_once(ROOT . '/repository/RoleRepository.php');
require_once(ROOT . '/repository/CommentRepository.php');
require_once(ROOT . '/repository/ScoreRepository.php');
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
        $scoreRepository = new ScoreRepository($myStorage);

        $this->model = new FileModel($fileRepository, $userRepository, $roleRepository, $commentRepository, $scoreRepository);

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

    public function processingRequest() 
    {
        if (isset($_POST['comment']) && isset($_GET['hash']))
        {
            $this->addCommentFile();
        }
        else if (isset($_POST['score']) && isset($_GET['hash']))
        {
            $this->setScoreFile();
        }
        else if (isset($_GET['hash']))
        {
            $this->getFile();
        }
        else
        {
            $this->errorView->render($this->pageData);
        }
    }

    public function getFile()
    {
        if (isset($_GET['hash']))
        {
            $hash = $_GET['hash'];

            // Получаем информацию о файле.
            $this->pageData = $this->model->getFileByHash($hash);
    
            if (empty($this->pageData['error']))
            {
                // Если файл получили - получаем комментарии к нему.
                $this->pageData['info']['comment'] = $this->model->getCommentFile($this->pageData['info']['file']['id']);

                // Если пользователь авторизирован - добавить форму для написания комментария
                // иначе - не добавлять.
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
        else
        {
            $this->errorView->render($this->pageData);
        }
    }

    public function addCommentFile()
    {
        $hash = $_GET['hash'];

        // Получаем данные из формы
        $infoComment['comment'] = htmlspecialchars($_POST['comment']);
        $infoComment['hash_file'] = $hash;
        $infoComment['user_email'] = $_SESSION['logged_user']['email'];

        $status = $this->model->addCommentFile($infoComment);

        // Переадресация на страницу файла
        $this->view->redirectionToFile($hash);
    }

    public function setScoreFile()
    {
        $hash = $_GET['hash'];

        $infoScore['hash_file'] = $hash;
        $infoScore['value'] = $_POST['score'];
        $infoScore['user_email'] = $_SESSION['logged_user']['email'];

        $this->model->setScoreFile($infoScore);

        // Переадресация на страницу файла
        $this->view->redirectionToFile($hash);
    }
}