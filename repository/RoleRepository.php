<?php

require_once(ROOT . '/repository/Connection.php');
require_once(ROOT . '/repository/RoleRepositoryInterface.php');

class RoleRepository implements RoleRepositoryInterface
{
    private $connection;
    
    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }
    
    /*public function __destruct ()
    {
        Connection::closeConnection();
    }*/

    public function getRoleById($id)
    {
        $sql = "SELECT * FROM role WHERE id = '$id'";
        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_assoc($result);
        
        return $rows;
    }
}