<?php

namespace Witooh\Authenticate\Facades;

use Illuminate\Support\Facades\Facade;
use ResMsg;

class Authenticate extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'Authenticate';
    }

    /**
     * @param string $username
     * @param string $password
     * @param bool $remember
     * @return ResMsg
     */
    public static function login($username, $password, $remember = false) {
        static::$app['Authenticate']->setCredentials($username, $password);
        static::$app['Authenticate']->setRemember($remember);

        return static::$app['Authenticate']->login();
    }
}