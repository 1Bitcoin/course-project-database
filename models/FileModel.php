<?php

require_once(MODEL_PATH . 'Model.php');

class FileModel extends Model 
{
    protected $userRepository;
    protected $roleRepository;

    public function __construct(FileRepository $fileRepository, UserRepository $userRepository, RoleRepository $roleRepository) 
    {
        $this->repo = $fileRepository;
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
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
        $answer;
        $error = array();
        $datePage['file'] = $this->repo->getFileByHash($hash);

        if (!empty($datePage['file']))
        {
            $datePage['user'] = $this->userRepository->getUserById($datePage['file']['user_id']);
            $datePage['role'] = $this->roleRepository->getRoleById($datePage['user']['role_id']);
            $answer['info'] = $datePage;
        }
        else
        {
            $error[] = "Файла с хэшем " . $hash . " нет на сервере";
            $answer['error'] = $error;
        }

        return $answer;
    }
}