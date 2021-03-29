<?php

/**
** Класс конфигурации базы данных
*/
class DB
{

	const USER = "root";
	const PASS = 1234;
	const HOST = "localhost";
	const DB   = "file_hosting";

	public static function connToDB() 
    {
		$user = self::USER;
		$pass = self::PASS;
		$host = self::HOST;
		$db   = self::DB;

		$conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
		return $conn;

	}
}