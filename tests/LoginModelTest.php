<?php

use PHPUnit\Framework\TestCase;

define("ROOT", '/var/www/course-project-database');
define("COMPONENT_BASE", ROOT . "/components/base/");
define("COMPONENT_ERROR", ROOT . "/components/error/");
define("COMPONENT_FILE", ROOT . "/components/file/");
define("COMPONENT_INDEX", ROOT . "/components/index/");
define("COMPONENT_UPLOAD", ROOT . "/components/upload/");
define("COMPONENT_LOGIN", ROOT . "/components/login/");
define("COMPONENT_LOGOUT", ROOT . "/components/logout/");
define("COMPONENT_REGISTER", ROOT . "/components/register/");
define("COMPONENT_DOWNLOAD", ROOT . "/components/download/");
define("COMPONENT_MAIN", ROOT . "/components/");

define("REPOSITORY", ROOT . "/repository/");
define("CONNECTION", ROOT . "/repository/connection/");

define("UPLOAD_PATH", ROOT . "/uploaded_files/");
define("CONFIG_DATABASE", ROOT . "/repository/config/DataBase.txt");

require_once(COMPONENT_LOGIN . 'LoginModel.php');
require_once(CONNECTION . 'Connection.php');
require_once(ROOT . '/service/Logger.php');

class LoginModelTest extends TestCase
{ 
    protected $result;

    public function testAddLogNoLogger()
    {
        $logger = $this->getMockBuilder(Logger::class)
        ->disableOriginalConstructor() 
        ->getMock();

        $userRepository = $this->getMockBuilder(UserRepository::class)
        ->disableOriginalConstructor()
        ->getMock();

        $loginModel = $this->getMockBuilder(LoginModel::class)
        ->disableOriginalConstructor()
        ->setMethods(['addLog'])
        ->getMock();

        $loginModel->expects($this->once())
        ->method('addLog')
        ->will($this->returnValue(true));

        $loginModel->repo = $userRepository;
        $loginModel->logger = $logger;

        $infoUser['email'] = "";
        $infoUser['hash_password'] = "dhg56";
        $infoUser['ip'] = "45.45.45.45";
        $this->assertEquals(true, $loginModel->addLog(1, "4.4.4.4", "login", NULL));
    }

    public function testLoginUserNoEmail()
    {
        $logger = $this->getMockBuilder(Logger::class)
        ->disableOriginalConstructor()
        ->getMock();

        $userRepository = $this->getMockBuilder(UserRepository::class)
        ->disableOriginalConstructor()
        ->getMock();

        $loginModel = new LoginModel($userRepository, 1);
        
        $infoUser['email'] = "";
        $infoUser['hash_password'] = "dhg56";
        $infoUser['ip'] = "45.45.45.45";
        $this->assertEquals("Введите email!", $loginModel->loginUser($infoUser)['errors']);
    }

    public function testLoginUserNoPassword()
    {
        $userRepository = $this->getMockBuilder(UserRepository::class)
        ->disableOriginalConstructor()
        ->getMock();

        $loginModel = new LoginModel($userRepository, 1);

        $infoUser['email'] = "567";
        $infoUser['hash_password'] = "";
        $infoUser['ip'] = "45.45.45.45";
        $this->assertEquals("Введите пароль!", $loginModel->loginUser($infoUser)['errors']);
    }

    public function testLoginUserNoRegister()
    {
        $logger = $this->getMockBuilder(Logger::class)
        ->disableOriginalConstructor() 
        ->getMock();

        $connection = $this->getMockBuilder(Connection::class)
        ->disableOriginalConstructor() 
        ->getMock();

        $userRepository = $this->getMockBuilder(UserRepository::class)
        ->setMethods(['checkExistsUser'])
        ->getMock();

        $result['nums'] = 0;
        $userRepository->expects($this->once())
        ->method('checkExistsUser')
        ->will($this->returnValue($result));

        $loginModel = new LoginModel($userRepository, 1);
        $loginModel->logger = $logger;
        $loginModel->connection = $connection;

        $infoUser['email'] = "567";
        $infoUser['hash_password'] = "hj";
        $infoUser['ip'] = "45.45.45.45";
        $this->assertEquals("Пользователь не зарегестрирован!", $loginModel->loginUser($infoUser)['errors']);
    }

    public function testLoginUserInvalidPassword()
    {
        $logger = $this->getMockBuilder(Logger::class)
        ->disableOriginalConstructor()
        ->getMock();

        $connection = $this->getMockBuilder(Connection::class)
        ->disableOriginalConstructor() 
        ->getMock();

        $userRepository = $this->getMockBuilder(UserRepository::class)
        ->setMethods(['checkExistsUser'])
        ->setMethods(['checkCoincidenceUser'])
        ->getMock();

        $result['nums'] = 1;
        $userRepository->expects($this->once())
        ->method('checkExistsUser')
        ->will($this->returnValue($result));

        $userRepository->expects($this->once())
        ->method('checkCoincidenceUser')
        ->will($this->returnValue($result));

        $loginModel = new LoginModel($userRepository, 1);
        $loginModel->logger = $logger;
        $loginModel->connection = $connection;

        $infoUser['email'] = "567";
        $infoUser['hash_password'] = "hj";
        $infoUser['ip'] = "45.45.45.45";
        $this->assertEquals("Неверный пароль!", $loginModel->loginUser($infoUser)['errors']);
    }
}