<?php

namespace Witooh\Authenticate\Test\Strategies;

use Mockery as m;
use Witooh\Authenticate\Strategies\BasicHttpStrategy;

class BasicHttpStrategyTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function mockEloquentDriver()
    {
        $eloquentDriver = m::mock('\Illuminate\Auth\Guard');

        return $eloquentDriver;
    }

    public function mockLaravelAuth($eloquentDriver)
    {
        $laravelAuth = m::mock('Illuminate\Auth\AuthManager');
        $laravelAuth->shouldReceive('createEloquentDriver')->andReturn($eloquentDriver);

        return $laravelAuth;
    }

    public function testNewInstance()
    {
        //Arrange
        $eloquentDriver = $this->mockEloquentDriver();

        $laravelAuth = $this->mockLaravelAuth($eloquentDriver);

        $field    = "username";

        //Act
        $basicAuth = new BasicHttpStrategy($laravelAuth, $field);

        //Assert
        $this->assertInstanceOf('Witooh\Authenticate\Strategies\BasicHttpStrategy', $basicAuth);
    }

    public function testLoginSuccess()
    {
        //Arrange
        $eloquentDriver = $this->mockEloquentDriver();
        $eloquentDriver->shouldReceive('onceBasic')->andReturn(true);

        $laravelAuth = $this->mockLaravelAuth($eloquentDriver);


        $field      = "username";
        $credendial = array();

        //Act
        $basicAuth = new BasicHttpStrategy($laravelAuth, $field);
        $login     = $basicAuth->login($credendial);

        //Assert
        $this->assertTrue($login);
    }

    public function testLoginFailed()
    {
        $eloquentDriver = $this->mockEloquentDriver();
        $eloquentDriver->shouldReceive('onceBasic')->andReturn(false);

        $laravelAuth = $this->mockLaravelAuth($eloquentDriver);

        $field      = "username";
        $credendial = array();

        //Act
        $basicAuth = new BasicHttpStrategy($laravelAuth, $field);
        $login     = $basicAuth->login($credendial);

        //Assert
        $this->assertFalse($login);
    }

    public function testLogout()
    {
        //Arrange
        $eloquentDriver = $this->mockEloquentDriver();
        $eloquentDriver->shouldReceive('logout')->once();

        $laravelAuth = $this->mockLaravelAuth($eloquentDriver);

        $field    = "username";

        //Act
        $basicAuth = new BasicHttpStrategy($laravelAuth, $field);
        $basicAuth->logout();
    }
}