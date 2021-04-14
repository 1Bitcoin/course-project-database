<?php

require_once(ROOT . '/repository/Connection.php');
require_once(ROOT . '/repository/StorageInterface.php');

class MySqlStorage implements StorageInterface
{
    public $connection;
    
    public function __construct()
    {
        $this->connection = Connection::getInstance();
    }

    public function findAll($table)
    {
        $sql = "SELECT * FROM $table";
        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $rows;
    }

    public function addFile($infoFile)
    {
        $name = $infoFile['name'];
        $hash = $infoFile['hash'];
        $type = $infoFile['type'];
        $size = $infoFile['size'];

        $sql = "INSERT INTO files (`name`, `hash`, `type`, `size`) VALUES ('$name', '$hash', '$type', '$size')";
        $status = mysqli_query($this->connection, $sql);   
        
        return $status;
    }
    
    public function addUser($infoUser)
    {
        $email = $infoUser['email'];
        $hashPassword = $infoUser['hash_password'];

        $sql = "INSERT INTO users (`email`, `hashPassword`) VALUES ('$email', '$hashPassword')";
        $status = mysqli_query($this->connection, $sql);   
        
        return $status;
    }

    public function checkExistsUser($infoUser)
    {
        $email = $infoUser['email'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $answerSql = mysqli_query($this->connection, $sql);  
        $result['nums'] = mysqli_num_rows($answerSql);   
        
        return $result;
    }

    public function checkCoincidenceUser($infoUser)
    {
        $email = $infoUser['email'];
        $hashPassword = $infoUser['hash_password'];

        $sql = "SELECT * FROM users WHERE email = '$email' AND hashPassword = '$hashPassword'";
        $answerSql = mysqli_query($this->connection, $sql);  
        $result['response'] = mysqli_fetch_assoc($answerSql);
        $result['nums'] = mysqli_num_rows($answerSql);   
        
        return $result;
    }

    public function checkUniquenessUser($infoUser)
    {
        $email = $infoUser['email'];

        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = mysqli_query($this->connection, $sql);   
        
        return mysqli_num_rows($result);
    }

    public function getCountRows($table)
    {
        $result = mysqli_query($this->connection, "SELECT * FROM $table");

        return mysqli_num_rows($result);
    }

    public function getRowsByLimit($table, $start, $end)
    {
        $sql = "SELECT * FROM $table LIMIT $start, $end";
        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $rows;
    }

    public function create($part, $data)
    {
         //Обработка создания записи в базе данных
    }

    public function update($part, $id, $data)
    {
        //Обработка обновления записи в базе данных
    }

    public function delete($part, $id)
    {
        //Обработка удаления записи в базе данных
    }

}