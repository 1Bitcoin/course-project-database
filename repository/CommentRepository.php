<?php

require_once(ROOT . '/repository/Connection.php');
require_once(ROOT . '/repository/CommentRepositoryInterface.php');

class CommentRepository implements CommentRepositoryInterface
{
    private $connection;
    
    public function __construct()
    {
        $this->connection = new Connection();
    }
    
    public function getCommentFile($idFile)
    {
        $sql = "SELECT comment.content, comment.date_create, comment.raiting, user.name, user.raiting, 
                role.name AS role_name FROM comment JOIN user ON comment.user_id = user.id JOIN role on role.id = user.role_id 
                WHERE file_id = '$idFile';";

        $result = mysqli_query($this->connection->getConnection(), $sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        
        return $rows;
    }

    public function addCommentFile($infoComment)
    {
        $content = $infoComment['comment'];
        $user_id = $infoComment['user_id'];
        $file_id = $infoComment['file_id'];
        
        $sql = "INSERT INTO comment (`user_id`, `file_id`, `content`) VALUES ('$user_id', '$file_id', '$content')";
        $status = mysqli_query($this->connection->getConnection(), $sql);   
        
        return $status;
    }
}