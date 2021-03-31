<?php
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------

namespace app\rpc\services;


class Pay implements \app\rpc\interfaces\Pay
{
    public function run($money)
    {
        return ['money' => $money];
    }
}