<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define("ROOT", '/var/www/course-project-database');
define("CONTROLLER_PATH", ROOT . "/controllers/");
define("MODEL_PATH", ROOT . "/models/");
define("VIEW_PATH", ROOT . "/views/");

require_once("db.php");
require_once("Router.php");

Routing::run();