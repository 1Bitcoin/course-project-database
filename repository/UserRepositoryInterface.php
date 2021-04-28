<?php

interface UserRepositoryInterface
{
    public function findAll();

    public function getUserIdByEmail($email);

    public function getUserById($id);

    public function checkCoincidenceUser($infoUser);

    public function checkExistsUser($infoUser);

    public function addUser($infoUser);

    public function getRowsByLimit($start, $end);

    public function getCountRows();
    
}