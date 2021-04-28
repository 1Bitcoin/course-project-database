<?php

require_once(ROOT . '/repository/ConfigManager.php');

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

        $this->link = mysqli_connect($host, $user, $password, $name);

        if ($this->link == false)
        {
            print_r("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
        }
        else 
        {
            // Соединение установлено успешно
            mysqli_set_charset($this->link, "utf8");
        }
    }

    public function __destruct() 
    {
        mysqli_close($this->link);
    }

    public function getConnection()
    {
        return $this->link;
    }
}