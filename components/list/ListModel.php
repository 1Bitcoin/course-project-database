<?php

require_once(COMPONENT_BASE . 'Model.php');
require_once(CONNECTION . 'Connection.php');

class ListModel extends Model 
{
    protected $connection;

    public function __construct(FileRepository $fileRepository, $roleID) 
    {
        $this->connection = new Connection($roleID);
        $this->repo = $fileRepository;
    }

    public function filesPagination($limit, $page, $searchString)
    {
        // Проверить номер страницы
        if (!isset($page)) 
            $page = 1;  

        $page_first_result = ($page - 1) * $limit; 
        $table = 'files';

        // Формируем данные для передачи в html форму
        $result['title'] = "Список файлов";
        $result['files'] = $this->repo->getRowsByLimit($page_first_result, $limit, $searchString);    
        $result['limit'] = $limit; 
        $result['page'] = $page;

        // Получить число записей в таблице
        $rows = $this->repo->getCountRows($searchString); 
        $result['count'] = $rows;
        
        return $result;
    }

    public function addLog($user, $ip, $action, $object_id)
    {
        $infoLog = array();

        $infoLog['user_id'] = $user; 
        $infoLog['ip'] = $ip; 
        $infoLog['action'] = $action; 
        $infoLog['object_id'] = $object_id; 
        $infoLog['call_from'] = "FileModel Class"; 

        $this->logger->addLog($infoLog);
    }
}