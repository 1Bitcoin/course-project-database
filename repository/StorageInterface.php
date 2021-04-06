<?php

interface StorageInterface
{
    public function findAll($part);

    public function create($part, $data);

    public function update($part, $id, $data);

    public function delete($part, $id);

}