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
            $this->reconnection();
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
        if ($this->link != false)
            return $this->link;
    }

    public function reconnection()
    {
        $countTry = 5;
        $connected = FALSE;

        while ($countTry && !$connected)
        {
            // ожидание 3 секунды
            sleep(3); 

            if ($this->link->ping()) 
            {
                print_r("Соединение восстановлено!\n");
                $connected = TRUE;
            } 
            else 
            {
                print_r("Ошибка: %s\n", $this->link->error);
            }

            $countTry--;
        }
    }
}