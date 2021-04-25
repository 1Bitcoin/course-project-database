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
    
    public function __destruct ()
    {
        Connection::closeConnection();
    }

    public function updateScoreFile($infoScore)
    {
        $file_id = $infoScore['file_id'];

        // Получаем сумму оценок всех пользователей.
        $sqlPrepare = "SELECT SUM(type_score) as total FROM score_file WHERE file_id = '$file_id'";
        $result = mysqli_query($this->connection, $sqlPrepare);
        $rows = mysqli_fetch_assoc($result);

        $value = $rows['total'];

        // Устанавливаем полученную сумму как значение рейтинга файла
        $sql = "UPDATE file SET date_upload = date_upload, raiting = '$value' WHERE id = '$file_id'";
        $status = mysqli_query($this->connection, $sql);
        
        return $status;
    }

    public function setScoreFile($infoScore)
    {
        $value = $infoScore['value'];
        $user_id = $infoScore['user_id'];
        $file_id = $infoScore['file_id'];

        // Получаем id записи с оценкой к файлу от пользователя, если она есть
        $sqlPrepare = "SELECT id FROM score_file WHERE user_id = '$user_id' AND file_id = '$file_id'";
        $result = mysqli_query($this->connection, $sqlPrepare);
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

        $status = mysqli_query($this->connection, $sql); 
        
        return $status;
    }

    public function getCommentFile($idFile)
    {
        $sql = "SELECT comment.content, comment.date_create, comment.raiting, user.name, user.raiting, 
                role.name AS role_name FROM comment JOIN user ON comment.user_id=user.id JOIN role on role.id = user.role_id 
                WHERE file_id = '$idFile';";

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

    public function addCommentFile($infoComment)
    {
        $content = $infoComment['comment'];
        $user_id = $infoComment['user_id'];
        $file_id = $infoComment['file_id'];
        
        $sql = "INSERT INTO comment (`user_id`, `file_id`, `content`) VALUES ('$user_id', '$file_id', '$content')";
        $status = mysqli_query($this->connection, $sql);   
        
        return $status;
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