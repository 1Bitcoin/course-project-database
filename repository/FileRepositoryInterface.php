<?php

interface FileRepositoryInterface
{
    public function updateScoreFile($infoScore);

    public function findAll();

    public function getFileByHash($hash);

    public function addFile($infoFile);

    public function getCountRows();

    public function getRowsByLimit($start, $end);

}