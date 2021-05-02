<?php

require_once(ROOT . '/repository/config/ConfigManager.php');
require_once(ROOT . '/vendor/autoload.php');

use \RedBeanPHP\R as R;

class Connection
{
    private $link;
    
    public function __construct()
    {
        $configManager = new ConfigManager();

        $host = $configManager->getHost();
        $user = $configManager->getUser();
        $password = $configManager->getPassword();
        $name = $configManager->getName();

        R::setup('mysql:host=localhost;dbname=file_hosting', 'root', '1234');
 
        // Проверка подключения к БД
        if (!R::testConnection()) 
        {
            print_r('No DB connection!');
        }
    }

    public function __destruct() 
    {
        R::close();
    }

    public function getConnection()
    {

    }

    public function reconnection()
    {
        $countTry = 5;
        $connected = FALSE;

    }
}