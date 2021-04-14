<?php

require_once(ROOT . '/repository/RoleRepositoryInterface.php');
require_once(ROOT . '/repository/StorageInterface.php');

class RoleRepository implements RoleRepositoryInterface
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
        return $this->storage->findAll('role');
    }
    
    public function getRoleById($id)
    {
        return $this->storage->getRoleById($id);
    }

    public function create($data)
    {
        return $this->storage->create('role', $data);
    }

    public function update($id, $data)
    {
        return $this->storage->update('role', $id, $data);
    }

    public function delete($id)
    {
        return $this->repo->delete('role', $id);
    }

}