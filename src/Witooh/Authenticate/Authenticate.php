<?php
namespace Witooh\Authenticate;

use Services\Authenticate\Validators\LoginValidator;
use ResMsg;
use Witooh\Validators\IValidator;
use Hash;

class Authenticate implements IAuthenticate
{

    /**
     * @var IAuthenticateBehavior
     */
    protected $behavior;
    /**
     * @var array
     */
    protected $credentials;
    /**
     * @var bool
     */
    protected $remember;
    /**
     * @var IValidator
     */
    protected $validator;

    public function __construct()
    {
        $this->remember    = false;
        $this->credentials = array();
    }

    /**
     * @param $username
     * @param $password
     */
    public function setCredentials($username, $password)
    {
        $this->credentials['username'] = $username;
        $this->credentials['password'] = Hash::make($password);
    }

    public function setValidator(IValidator $validator){
        $this->validator = $validator;
    }

    /**
     * @param bool $remember
     */
    public function setRemember($remember)
    {
        $this->remember = $remember;
    }

    /**
     * @param IAuthenticateBehavior $behavior
     */
    public function setBehavior(IAuthenticateBehavior $behavior)
    {
        $this->behavior = $behavior;
    }

    /**
     * @return ResMsg
     */
    public function login()
    {
        $validator = new LoginValidator($this->credentials);

        if ($validator->fails()) {
            return ResMsg::validation($validator->getErrors());
        }

        return $this->behavior->login($this->credentials, $this->remember);
    }

    /**
     * @param IAuthenticateVisitor $visitor
     */
    public function acceptVisitor(IAuthenticateVisitor $visitor)
    {
        $visitor->visitAuthenticate($this);
    }

    /**
     * @return ResMsg
     */
    public function logout()
    {
        return $this->behavior->logout();
    }

    /**
     * @return ResMsg
     */
    public function getLoginInfo()
    {
        return $this->behavior->getLoginInfo();
    }
}