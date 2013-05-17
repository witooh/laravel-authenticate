<?php

namespace Witooh\Authenticate;


interface IAuthenticateVisitor {
    /**
     * @param IAuthenticate $auth
     *
     */
    public function visitAuthenticate(IAuthenticate $auth);
}