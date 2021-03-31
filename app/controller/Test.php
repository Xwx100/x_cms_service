<?php
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------

namespace app\controller;


use rpc\contract\user\Pay;
use rpc\contract\user\User;

class Test implements User, Pay
{

    public function get($name)
    {
        // TODO: Implement get() method.
    }

    public function run($money)
    {
        // TODO: Implement run() method.
    }
}