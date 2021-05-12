<?php

require_once(COMPONENT_BASE . 'Model.php');
require_once(ROOT . '/service/Logger.php');

class DownloadModel extends Model 
{
    public function __construct(FileRepository $fileRepository, $roleID)
    {
        $this->repo = $fileRepository;
        $this->connection = new Connection($roleID);
        $this->logger = new Logger();
    }

    public function download($hash, $infoUser)
    {
        $answer = array();
        $file = $this->repo->getFileByHash($hash);
        $this->addLog($infoUser['user_id'], $infoUser['ip'], "download file", $file['id']);

        $answer['hash'] = $hash;
        $answer['name'] = $file['name'];

        return $answer;
    }

    public function addLog($user, $ip, $action, $object_id)
    {
        $infoLog = array();

        $infoLog['user_id'] = $user; 
        $infoLog['ip'] = $ip; 
        $infoLog['action'] = $action; 
        $infoLog['object_id'] = $object_id; 

        $this->logger->addLog($infoLog);
    }
}