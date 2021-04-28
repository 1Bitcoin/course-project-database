<?php

require_once(ROOT . '/repository/Connection.php');
require_once(ROOT . '/repository/ScoreRepositoryInterface.php');

class ScoreRepository implements ScoreRepositoryInterface
{
    private $connection;
    
    public function __construct()
    {
        $this->connection = new Connection();
    }

    public function getSumScore($infoScore)
    {
        // Получаем сумму оценок всех пользователей.

        $file_id = $infoScore['file_id'];
        
        $sqlPrepare = "SELECT SUM(type_score) as total FROM score_file WHERE file_id = '$file_id'";
        $result = mysqli_query($this->connection->getConnection(), $sqlPrepare);
        $rows = mysqli_fetch_assoc($result);

        return $rows['total'];
    }

    public function setScoreFile($infoScore)
    {
        $value = $infoScore['value'];
        $user_id = $infoScore['user_id'];
        $file_id = $infoScore['file_id'];

        // Получаем id записи с оценкой к файлу от пользователя, если она есть
        $sqlPrepare = "SELECT id FROM score_file WHERE user_id = '$user_id' AND file_id = '$file_id'";
        $result = mysqli_query($this->connection->getConnection(), $sqlPrepare);
        $rows = mysqli_fetch_assoc($result);

        // Если запись уже существует - обновляем поле type_score
        // иначе - добавляем новую запись.
        if (isset($rows['id']))
        {
            $idRow = $rows['id'];
            $sql = "UPDATE score_file SET type_score = '$value' WHERE id = '$idRow'";
        }
        else
        {
            $sql = "INSERT INTO score_file (`user_id`, `file_id`, `type_score`) VALUES ('$user_id', '$file_id', '$value')";
        }

        $status = mysqli_query($this->connection->getConnection(), $sql); 
        
        return $status;
    }
}