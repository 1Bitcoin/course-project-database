<?php

class ConfigManager
{
    private $host;
    private $user;
    private $password;
    private $name;
    
    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->password = "1234";
        $this->name = "file_hosting";
    }

    public function getHost()
    {
        return $this->host;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getName()
    {
        return $this->name;
    }
}