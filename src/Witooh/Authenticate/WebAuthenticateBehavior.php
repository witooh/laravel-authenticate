<?php

namespace Witooh\Authenticate;

use Auth;
use ResMsg;
use Session;
use Permission;
use Witooh\Authenticate\IAuthenticateBehavior;
use Domains\Entities\User;

class WebAuthenticateBehavior implements IAuthenticateBehavior
{

    /**
     * @param array $credentials
     * @param bool $remember
     * @return mixed
     */
    public function login($credentials, $remember)
    {
        if (!Auth::attempt($credentials, $remember)) {
            return ResMsg::error('Authenticate fail');
        }

        $user = User::where('username', $credentials['username'])->first();

        Session::set('user', $user);

        return ResMsg::success();
    }

    /**
     * Add Session or Permission
     *
     * @param array $credentials
     */
    public function afterLogin($credentials){

    }

    /**
     * @return ResMsg
     */
    public function getLoginInfo()
    {
        $data = array();
        if (Session::has('user')) {
            $data['user']       = Session::get('user');
            $data['permission'] = Session::get('permission');

            return ResMsg::success($data);
        }

        return ResMsg::auth();
    }

}