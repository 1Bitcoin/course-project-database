<?php

require_once(ROOT . '/repository/Connection.php');
require_once(ROOT . '/repository/UserRepositoryInterface.php');

class UserRepository implements UserRepositoryInterface
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

    public function findAll()
    {
        $sql = "SELECT * FROM user";
        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $rows;
    }
    
    public function getUserIdByEmail($email)
    {
        $sql = "SELECT id FROM user WHERE email = '$email'";
        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_assoc($result);
        
        return $rows;
    }

    public function getUserById($id)
    {
        $sql = "SELECT * FROM user WHERE id = '$id'";
        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_assoc($result);
        
        return $rows;
    }

    public function checkCoincidenceUser($infoUser)
    {
        $email = $infoUser['email'];
        $hashPassword = $infoUser['hash_password'];

        $sql = "SELECT * FROM user WHERE email = '$email' AND hash_password = '$hashPassword'";
        $answerSql = mysqli_query($this->connection, $sql);  
        $result['response'] = mysqli_fetch_assoc($answerSql);
        $result['nums'] = mysqli_num_rows($answerSql);   
        
        return $result;
    }

    public function checkExistsUser($infoUser)
    {
        $email = $infoUser['email'];

        $sql = "SELECT * FROM user WHERE email = '$email'";
        $answerSql = mysqli_query($this->connection, $sql);  
        $result['nums'] = mysqli_num_rows($answerSql);   
        
        return $result;
    }

    public function addUser($infoUser)
    {
        $email = $infoUser['email'];
        $name = $infoUser['name'];
        $hashPassword = $infoUser['hash_password'];

        $sql = "INSERT INTO user (`email`, `name`, `hash_password`) VALUES ('$email', '$name', '$hashPassword')";
        $status = mysqli_query($this->connection, $sql);   
        
        return $status;
    }

    public function getRowsByLimit($start, $end)
    {
        $sql = "SELECT * FROM user LIMIT $start, $end";
        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $rows;
    }

    public function getCountRows()
    {
        $result = mysqli_query($this->connection, "SELECT * FROM user");

        return mysqli_num_rows($result);
    }
}