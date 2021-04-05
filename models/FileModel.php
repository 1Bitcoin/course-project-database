<?php

require_once(MODEL_PATH . 'Model.php');

class FileModel extends Model 
{
    public function getUsers($limit, $page)
    {   
        /*$sql = "INSERT INTO users (id, email, password, date_create, uploaded_files, raiting, privilege_level) 
                VALUES (228, 'fury@mail.ru', '12345', '2011-04-15 00:02:00', 0, 0, 0)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();*/

        $page_first_result = ($page - 1) * $limit; 
        $sql = "SELECT * FROM users LIMIT " . $page_first_result . ',' . $limit;
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $res['users'] = $stmt->fetchAll(PDO::FETCH_ASSOC);    
        $res['limit'] = $limit; 
        $res['title'] = "Список файлов";
        $res['page'] = $page;

        $sql = "SELECT COUNT(*) FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);    
        $total_records = $row['COUNT(*)'];  
        
        $res['count'] = $total_records;

        return $res;
    }
}