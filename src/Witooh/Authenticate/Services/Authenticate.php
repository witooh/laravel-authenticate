<?php

namespace Witooh\Authenticate\Services;

use Witooh\Authenticate\Strategies\IAuthStrategy;
use Witooh\Visitor\IVisitable;
use Witooh\Visitor\IVisitor;

class Authenticate implements IAuthenticate, IVisitable {
    /**
     * @var \Balista\Authenticate\Strategies\IAuthStrategy
     */
    protected $strategy;

    /**
     * @param array $credential
     * @param bool $remember
     * @return bool
     */
    public function login($credential, $remember=false)
    {
        return $this->strategy->login($credential);
    }

    /**
     * @return void
     */
    public function logout()
    {
        $this->strategy->logout();
    }

    /**
     * @param \Witooh\Authenticate\Strategies\IAuthStrategy $strategy
     */
    public function setStrategy(IAuthStrategy $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @return \Witooh\Authenticate\Strategies\IAuthStrategy
     */
    public function getStrategy()
    {
        return $this->strategy;
    }

    /**
     * @param \Witooh\Visitor\IVisitor $visitor
     */
    public function accept(IVisitor $visitor)
    {
        $visitor->visit($this);
    }
}