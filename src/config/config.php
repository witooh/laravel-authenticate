<?php
return array(
    'user_class'=>'User',
    'user_repository'=>'UserRepositor',
    'default_login'=>'Services\Authenticate\WebAuthenticateBehavior',
    'validator'=>'Services\Authenticate\Validators\LoginValidator',
);