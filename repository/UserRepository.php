<?php

require_once(ROOT . '/repository/UserRepositoryInterface.php');
require_once(ROOT . '/repository/StorageInterface.php');

class UserRepository implements UserRepositoryInterface
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
        return $this->storage->findAll('users');
    }

    public function checkExistsUser($infoUser)
    {
        return $this->storage->checkExistsUser($infoUser);
    }

    public function checkUniquenessUser($infoUser)
    {
        return $this->storage->checkUniquenessUser($infoUser);
    }

    public function addUser($infoUser)
    {
        return $this->storage->addUser($infoUser);
    }

    public function getRowsByLimit($start, $end)
    {
        return $this->storage->getRowsByLimit('users', $start, $end);
    }

    public function getCountRows()
    {
        return $this->storage->getCountRows('users');
    }

    public function create($data)
    {
        return $this->storage->create('users', $data);
    }

    public function update($id, $data)
    {
        return $this->storage->update('users', $id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete('users', $id);
    }

}