<?php
namespace Witooh\Authenticate;

use ResMsg;

interface IAuthenticateBehavior {

    /**
     * @param array $credentials
     * @param bool $remember
     * @return ResMsg
     */
    public function login($credentials, $remember);

    /**
     * @return ResMsg
     */
    public function getLoginInfo();

    public function afterLogin($credentials);
}