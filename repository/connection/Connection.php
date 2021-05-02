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

        R::setup('mysql:host=' . $host . ';dbname=' . $name, $user, $password);
 
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