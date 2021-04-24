<?php

require_once(ROOT . '/repository/CommentRepositoryInterface.php');
require_once(ROOT . '/repository/StorageInterface.php');

class CommentRepository implements CommentRepositoryInterface
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

    public function getCommentFile($idFile)
    {
        return $this->storage->getCommentFile($idFile);
    }
    
    public function addCommentFile($infoComment)
    {
        return $this->storage->addCommentFile($infoComment);
    }

    public function all()
    {
        return $this->storage->findAll('comment');
    }

    public function create($data)
    {
        return $this->storage->create('comment', $data);
    }

    public function update($id, $data)
    {
        return $this->storage->update('comment', $id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete('comment', $id);
    }

}