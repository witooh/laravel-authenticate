<?php
namespace Witooh\Authenticate\Strategies;

use Illuminate\Auth\AuthManager;

class BasicHttpStrategy implements IAuthStrategy {

    /**
     * @var \Illuminate\Auth\Guard
     */
    protected $laravelAuth;
    /**
     * @var string
     */
    protected $field;

    /**
     * @param \Illuminate\Auth\AuthManager $laravelAuth
     * @param $field
     */
    public function __construct(AuthManager $laravelAuth, $field='email')
    {
        $this->laravelAuth = $laravelAuth->createEloquentDriver();
        $this->field = $field;
    }

    /**
     * @param array $credential
     * @return bool|void
     */
    public function login($credential)
    {
        return $this->laravelAuth->onceBasic($this->field);
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->laravelAuth->logout();
    }
}