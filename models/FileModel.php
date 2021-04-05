<?php

require_once(MODEL_PATH . 'Model.php');

class FileModel extends Model 
{
    public function getUsers($limit)
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $res['users'] = $stmt->fetchAll(PDO::FETCH_ASSOC);   
        $res['count'] = count($res['users']); 
        $res['limit'] = $limit; 
        $res['title'] = "Список файлов";

        return $res;
    }
}