<?php

require_once(ROOT . '/repository/Connection.php');
require_once(ROOT . '/repository/FileRepositoryInterface.php');

class FileRepository implements FileRepositoryInterface
{
    private $connection;
    
    public function __construct()
    {
        $this->connection = new Connection();
    }

    public function updateScoreFile($infoScore)
    {
        $file_id = $infoScore['file_id'];
        $sumScore = $infoScore['sum_score'];

        // Устанавливаем полученную сумму как значение рейтинга файла
        $sql = "UPDATE file SET date_upload = date_upload, raiting = '$sumScore' WHERE id = '$file_id'";
        $status = mysqli_query($this->connection->getConnection(), $sql);
        
        return $status;
    }

    public function findAll()
    {
        $sql = "SELECT * FROM file";
        $result = mysqli_query($this->connection->getConnection(), $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $rows;
    }

    public function getFileByHash($hash)
    {
        $sql = "SELECT * FROM file WHERE hash = '$hash'";
        $result = mysqli_query($this->connection->getConnection(), $sql);
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
        $status = mysqli_query($this->connection->getConnection(), $sql);   
        
        return $status;
    }
    
    public function getCountRows()
    {
        $result = mysqli_query($this->connection->getConnection(), "SELECT * FROM file");

        return mysqli_num_rows($result);
    }

    public function getRowsByLimit($start, $end)
    {
        $sql = "SELECT * FROM file LIMIT $start, $end";
        $result = mysqli_query($this->connection->getConnection(), $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

        return $rows;
    }
}