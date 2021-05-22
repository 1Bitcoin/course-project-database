<?php

require_once(ROOT . '/repository/logger/LoggerRepositoryInterface.php');

use \RedBeanPHP\R as R;

class LoggerRepository implements LoggerRepositoryInterface
{
    public function __construct()
    {

    }

    public function addLog($infoLog)
    {
        $user_id = $infoLog['user_id'];
        $ip = $infoLog['ip'];
        $action = $infoLog['action'];
        $object_id = $infoLog['object_id'];
        $call_from = $infoLog['call_from'];

        $log = R::dispense('logging');

        $log->ip = $ip;
        $log->call_from = $call_from;
        $log->user_id = $user_id;
        $log->action = $action;
        $log->object_id = $object_id;

        R::store($log);
        
        return 0;
    }

    public function getLogs()
    {
        $logs = R::getAll('SELECT * FROM `logging` ORDER BY id DESC LIMIT ?', [1000]);

        return $logs;
    }
}