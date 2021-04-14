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

    public function getFileByHash($hash)
    {
        $sql = "SELECT * FROM file WHERE hash = '$hash'";
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

    public function getRoleById($id)
    {
        $sql = "SELECT * FROM role WHERE id = '$id'";
        $result = mysqli_query($this->connection, $sql);
        $rows = mysqli_fetch_assoc($result);
        
        return $rows;
    }

    public function addFile($infoFile)
    {
        $name = $infoFile['name'];
        $hash = $infoFile['hash'];
        $type = $infoFile['type'];
        $size = $infoFile['size'];
        $user_id = $infoFile['user_id'];

        $sql = "INSERT INTO file (`name`, `hash`, `type`, `size`, `user_id`) VALUES ('$name', '$hash', '$type', '$size', '$user_id')";
        $status = mysqli_query($this->connection, $sql);   
        
        return $status;
    }
    
    public function addUser($infoUser)
    {
        $email = $infoUser['email'];
        $name = $infoUser['name'];
        $hashPassword = $infoUser['hash_password'];

        $sql = "INSERT INTO user (`email`, `name`, `hash_password`) VALUES ('$email', '$name', '$hashPassword')";
        echo $sql;
        $status = mysqli_query($this->connection, $sql);   
        
        return $status;
    }

    public function checkExistsUser($infoUser)
    {
        $email = $infoUser['email'];

        $sql = "SELECT * FROM user WHERE email = '$email'";
        $answerSql = mysqli_query($this->connection, $sql);  
        $result['nums'] = mysqli_num_rows($answerSql);   
        
        return $result;
    }

    public function checkUniquenessUser($infoUser)
    {
        $email = $infoUser['email'];

        $sql = "SELECT * FROM user WHERE email = '$email'";
        $result = mysqli_query($this->connection, $sql);   
        
        return mysqli_num_rows($result);
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