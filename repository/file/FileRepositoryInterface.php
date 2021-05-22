<?php

interface FileRepositoryInterface
{
    public function updateScoreFile($infoScore);

    public function getFileByHash($hash);

    public function addFile($infoFile);

    public function getCountRows($searchString);

    public function getRowsByLimit($start, $end, $searchString);

}