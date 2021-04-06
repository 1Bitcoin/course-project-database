<?php

require_once(ROOT . '/repository/FileRepositoryInterface.php');

class Model 
{
    protected $repo;

    /**
    * В конструктор передаем класс репозитория, который реализует указанный интерфейс
    * Таким образом мы храним нужный репозиторий в свойстве $repo
    */
    public function __construct(FileRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }
}