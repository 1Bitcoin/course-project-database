<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define("ROOT", '/var/www/iu7.ru');
define("CONTROLLER_PATH", ROOT . "/controllers/");
define("MODEL_PATH", ROOT . "/models/");
define("VIEW_PATH", ROOT . "/views/");

require_once("db.php");
require_once("route.php");

require_once(MODEL_PATH . 'Model.php');
require_once(CONTROLLER_PATH . 'Controller.php');
require_once(VIEW_PATH . 'View.php');

Routing::run();