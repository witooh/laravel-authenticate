<?php

namespace Witooh\Authenticate\Services;

interface IAuthenticate {
    /**
     * @param array $credential
     * @param bool $remember
     * @return bool
     */
    public function login($credential, $remember=false);

    /**
     * @return void
     */
    public function logout();
}