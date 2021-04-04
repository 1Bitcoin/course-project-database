<?php

require_once(MODEL_PATH . 'Model.php');

class FileModel extends Model 
{
    public function getUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        return $res;
    }
}