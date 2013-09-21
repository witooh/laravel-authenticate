<?php

namespace Witooh\Authenticate\Test\Services;

use Witooh\Authenticate\Services\Authenticate;
use Mockery as m;

class AuthenticateTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function mockStrategy()
    {
        $dumpStrategy = m::mock('Witooh\Authenticate\Strategies\IAuthStrategy');
        return $dumpStrategy;
    }

    public function testNewInstance()
    {
        //Act
        $authenticate = new Authenticate();

        //Assert
        $this->assertInstanceOf('Witooh\Authenticate\Services\IAuthenticate', $authenticate);
    }

    public function testLoginSuccess()
    {
        //Arrange
        $dumpStrategy = $this->mockStrategy();
        $dumpStrategy->shouldReceive('login')->andReturn(true);
        $user = m::mock('Balista\Entities\User');

        //Act
        $authenticate = new Authenticate();
        $authenticate->setStrategy($dumpStrategy);
        $login = $authenticate->login($user);

        //Assert
        $this->assertTrue($login);
    }

    public function testLoginFailed()
    {
        //Arrange
        $dumpStrategy = $this->mockStrategy();
        $dumpStrategy->shouldReceive('login')->andReturn(false);
        $credential = array();

        //Act
        $authenticate = new Authenticate();
        $authenticate->setStrategy($dumpStrategy);
        $login = $authenticate->login($credential);

        //Assert
        $this->assertFalse($login);
    }

    public function testLogout()
    {
        //Arrange
        $dumpStrategy = $this->mockStrategy();
        $dumpStrategy->shouldReceive('logout')->once();

        //Act
        $authenticate = new Authenticate();
        $authenticate->setStrategy($dumpStrategy);
        $authenticate->logout();
    }

    public function testGetStrategy()
    {
        //Arrange
        $dumpStrategy = $this->mockStrategy();

        //Act
        $authenticate = new Authenticate();
        $authenticate->setStrategy($dumpStrategy);
        $strategy = $authenticate->getStrategy();

        //Assert
        $this->assertEquals($dumpStrategy, $strategy);
    }
}