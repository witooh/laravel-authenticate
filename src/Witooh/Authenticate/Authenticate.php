<?php
namespace Witooh\Authenticate;

use Witooh\Authenticate\Validators\LoginValidator;
use ResMsg;
use Witooh\Validators\IValidator;

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
        $this->credentials['password'] = $password;
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
        $this->validator->setAttributes($this->credentials);

        if ($this->validator->fails()) {
            return ResMsg::validation($this->validator->getErrors());
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
        Auth::logout();
        Session::flush();

        return ResMsg::success();
    }

    /**
     * @return ResMsg
     */
    public function getLoginInfo()
    {
        return $this->behavior->getLoginInfo();
    }
}