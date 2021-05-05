<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

define("ROOT", '/var/www/course-project-database');
define("COMPONENT_BASE", ROOT . "/components/base/");
define("COMPONENT_ERROR", ROOT . "/components/error/");
define("COMPONENT_FILE", ROOT . "/components/file/");
define("COMPONENT_INDEX", ROOT . "/components/index/");
define("COMPONENT_LOAD", ROOT . "/components/load/");
define("COMPONENT_LOGIN", ROOT . "/components/login/");
define("COMPONENT_LOGOUT", ROOT . "/components/logout/");
define("COMPONENT_REGISTER", ROOT . "/components/register/");
define("COMPONENT_MAIN", ROOT . "/components/");

define("UPLOAD_PATH", ROOT . "/uploaded_files/");
define("CONFIG_DATABASE", ROOT . "/repository/config/DataBase.txt");

require_once("Router.php");

Routing::run();