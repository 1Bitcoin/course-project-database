<?php

class IndexModel extends Model 
{
    public function getUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //print_r($res);
        
        return $res;
    }
}