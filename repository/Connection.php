<?php

class Connection
{
    protected static $link;

    public static function getInstance() 
    {

        $db_info = array(
            "db_host" => "localhost",
            "db_port" => "3306",
            "db_user" => "root",
            "db_pass" => "1234",
            "db_name" => "file_hosting");

        self::$link = mysqli_connect($db_info['db_host'], $db_info['db_user'], $db_info['db_pass'], $db_info['db_name']);

        if (self::$link == false)
        {
            //print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
        }
        else 
        {
            //print("Соединение установлено успешно");
            mysqli_set_charset(self::$link, "utf8");
        }
        
        return self::$link;
    }
}