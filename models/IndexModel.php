<?php

class IndexModel extends Model 
{
    public function getUsers()
    {
	    $sql = "SELECT * FROM users";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $res = $stmt->fetch(PDO::FETCH_ASSOC);

        //print_r($res);
        print("\n");
        echo $res["date_create"];
        /*foreach ($res as $elem)
        {
            echo $elem . "\n";
        }*/
    }


}