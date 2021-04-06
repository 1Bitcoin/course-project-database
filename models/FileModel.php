<?php

require_once(MODEL_PATH . 'Model.php');

class FileModel extends Model 
{
    public function filesPagination($limit, $page)
    {
        // Проверить номер страницы
        if (!isset($page)) 
        {  
            $page = 1;  
        } 

        $page_first_result = ($page - 1) * $limit; 
        $table = 'files';

        // Формируем данные для передачи в html форму
        $res['title'] = "Список файлов";
        $res['files'] = $this->repo->getRowsByLimit($page_first_result, $limit);    
        $res['limit'] = $limit; 
        $res['page'] = $page;

        // Получить число записей в таблице
        $rows = $this->repo->getCountRows(); 
        $res['count'] = $rows[0]['COUNT(*)'];
        
        return $res;
    }
}