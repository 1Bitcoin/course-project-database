<?php

interface CommentRepositoryInterface
{
    public function all();

    public function create($data);

    public function update($id, $data);

    public function delete($id);

}