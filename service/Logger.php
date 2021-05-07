<?php

require_once(ROOT . '/service/LoggerInterface.php');
require_once(REPOSITORY . 'logger/LoggerRepository.php');

class Logger implements LoggerInterface
{
    protected $loggerRepository;

    public function __construct()
    {
        $this->loggerRepository = new LoggerRepository();
    }

    public function addLog($infoLog)
    {
        $this->loggerRepository->addLog($infoLog);
    }

}








