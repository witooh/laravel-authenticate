<?php

namespace Witooh\Authenticate\Strategies;


interface IAuthStrategy {

    /**
     * @param array $credential
     * @return bool
     */
    public function login($credential);

    /**
     * @return void
     */
    public function logout();
}