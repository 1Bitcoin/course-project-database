<?php

require_once(MODEL_PATH . 'Model.php');
require_once(ROOT . '/repository/connection/Connection.php');

class FileModel extends Model 
{
    protected $connection;
    protected $userRepository;
    protected $roleRepository;
    protected $scoreRepository;
    protected $commentRepository;

    public function __construct(FileRepository $fileRepository, UserRepository $userRepository, 
                                RoleRepository $roleRepository, CommentRepository $commentRepository, 
                                ScoreRepository $scoreRepository, $roleID) 
    {
        $this->connection = new Connection($roleID);
        
        $this->repo = $fileRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
        $this->commentRepository = $commentRepository;
        $this->scoreRepository = $scoreRepository;
    }

    public function filesPagination($limit, $page)
    {
        // Проверить номер страницы
        if (!isset($page)) 
            $page = 1;  

        $page_first_result = ($page - 1) * $limit; 
        $table = 'files';

        // Формируем данные для передачи в html форму
        $result['title'] = "Список файлов";
        $result['files'] = $this->repo->getRowsByLimit($page_first_result, $limit);    
        $result['limit'] = $limit; 
        $result['page'] = $page;

        // Получить число записей в таблице
        $rows = $this->repo->getCountRows(); 
        $result['count'] = $rows;
        
        return $result;
    }

    public function getFileByHash($hash)
    {
        $answer = array();
        $datePage['file'] = $this->repo->getFileByHash($hash);

        if (!empty($datePage['file']))
        {
            $datePage['user'] = $this->userRepository->getUserById($datePage['file']['user_id']);
            $datePage['role'] = $this->roleRepository->getRoleById($datePage['user']['role_id']);
            $answer['info'] = $datePage;
        }
        else
        {
            $answer['error'] = "Файла с хэшем " . $hash . " нет на сервере";
        }

        return $answer;
    } 

    public function getCommentFile($idFile)
    {
        $comment = $this->commentRepository->getCommentFile($idFile);

        return $comment;
    }

    public function addCommentFile($infoComment)
    {
        $fileInfo = $this->repo->getFileByHash($infoComment['hash_file']);
        $infoComment['user_id'] = $this->userRepository->getUserIdByEmail($infoComment['user_email'])['id'];
        $infoComment['file_id'] = $fileInfo['id'];

        $status = $this->commentRepository->addCommentFile($infoComment);

        return $status;
    }

    public function setScoreFile($infoScore)
    {
        $fileInfo = $this->repo->getFileByHash($infoScore['hash_file']);
        $infoScore['user_id'] = $this->userRepository->getUserIdByEmail($infoScore['user_email'])['id'];
        $infoScore['file_id'] = $fileInfo['id'];

        // Обновляем или добавляем запись в таблицу score_file об оценке файла пользователем.
        $this->scoreRepository->setScoreFile($infoScore);

        // Получить сумму оценок файла.
        $infoScore['sum_score'] = $this->scoreRepository->getSumScore($infoScore);

        // Обновляем общий рейтинг файла.
        $status = $this->repo->updateScoreFile($infoScore);
        
        return $status;
    }
}