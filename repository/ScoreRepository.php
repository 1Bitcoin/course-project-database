<?php

require_once(ROOT . '/repository/ScoreRepositoryInterface.php');
require_once(ROOT . '/repository/StorageInterface.php');

class ScoreRepository implements ScoreRepositoryInterface
{
    private $storage;
    
    /**
    * В конструктор передаем класс хранилища, который реализует указанный интерфейс
    * Таким образом мы храним нужное хранилище в свойстве $storage
    */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
    * Работаем с данными и хранилищем через класс репозитория
    */

    public function setScoreFile($infoScore)
    {
        return $this->storage->setScoreFile($infoScore);
    }

    public function all()
    {
        return $this->storage->findAll('file');
    }

    public function getRowsByLimit($start, $end)
    {
        return $this->storage->getRowsByLimit('file', $start, $end);
    }

    public function getCountRows()
    {
        return $this->storage->getCountRows('file');
    }

    public function create($data)
    {
        return $this->storage->create('file', $data);
    }

    public function update($id, $data)
    {
        return $this->storage->update('file', $id, $data);
    }

    public function delete($id)
    {
        return $this->storage->delete('file', $id);
    }

}