<?php
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------

namespace app\rpc\events;


use app\rpc\providers\MyAppInjectRpcFlag;

class RpcFlag
{
    protected $rpcFlag = null;

    public function __construct(MyAppInjectRpcFlag $rpcFlag)
    {
        $this->rpcFlag = $rpcFlag;
    }

    public function onMasterInit() {
        $this->rpcFlag->injectFlag();
    }
}