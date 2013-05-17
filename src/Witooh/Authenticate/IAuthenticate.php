<?php
namespace Witooh\Authenticate;

use Witooh\Validators\IValidator;
use ResMsg;

interface IAuthenticate {

    /**
     * @return ResMsg
     */
    public function login();

    /**
     * @return ResMsg
     */
    public function logout();

    /**
     * @return ResMsg
     */
    public function getLoginInfo();

    /**
     * @param IAuthenticateBehavior $behavior
     * @return
     */
    public function setBehavior(IAuthenticateBehavior $behavior);

    /**
     * @param string $username
     * @param string $password
     * @return
     */
    public function setCredentials($username, $password);

    /**
     * @param bool $remember
     * @return
     */
    public function setRemember($remember);

    /**
     * @param IAuthenticateVisitor $visitor
     * @return
     */
    public function acceptVisitor(IAuthenticateVisitor $visitor);

    /**
     * @param IValidator $validator
     * @return
     */
    public function setValidator(IValidator $validator);
}