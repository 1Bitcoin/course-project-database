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
        $sql = 'SELECT * FROM ' . $table;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addFile($table, $infoFile)
    {
        $sql = 'INSERT INTO ' . $table . '(date_upload, name, hash, type, size)' . 'VALUES(' . "'" . $infoFile['date_upload'] . "'" . ','
             . "'" .$infoFile['name'] . "'" . ',' . "'" . $infoFile['hash'] . "'" . ',' . "'" . $infoFile['type'] . "'" . ',' 
             . $infoFile['size'] . ');';
                
        $stmt = $this->connection->prepare($sql);
        $status = $stmt->execute();
        
        return $status;
    }

    public function getCountRows($table)
    {
        $sql = 'SELECT COUNT(*) FROM ' . $table;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRowsByLimit($table, $start, $end)
    {
        $sql = 'SELECT * FROM ' . $table . ' LIMIT ' . $start . ',' . $end;
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
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