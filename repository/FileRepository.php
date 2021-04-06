<?php

require_once(ROOT . '/repository/FileRepositoryInterface.php');
require_once(ROOT . '/repository/StorageInterface.php');

class FileRepository implements FileRepositoryInterface
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
    public function all()
    {
        return $this->storage->findAll('files');
    }

    public function addFile($infoFile)
    {
        return $this->storage->addFile('files', $infoFile);
    }

    public function getRowsByLimit($start, $end)
    {
        return $this->storage->getRowsByLimit('files', $start, $end);
    }

    public function getCountRows()
    {
        return $this->storage->getCountRows('files');
    }

    public function create($data)
    {
        return $this->storage->create('files', $data);
    }

    public function update($id, $data)
    {
        return $this->storage->update('files', $id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete('files', $id);
    }

}