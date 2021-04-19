<?php
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------

namespace app\rpc\providers;


use Swoole\Server;
use think\Event;
use think\swoole\RpcManager;

class MyRpcManager extends RpcManager
{

    // 新增 接收信息回调事件
    public function onReceive(Server $server, $fd, $reactorId, $data)
    {
//        $this->addEvent(...func_get_args());
        parent::onReceive($server, $fd, $reactorId, $data);
    }

    public function addEvent(Server $server, $fd, $reactorId, $data) {
        $args = func_get_args();
        $this->runInSandbox(function (Event $event) use ($args) {
            $event->trigger("swoole.rpc.Receive", $args);
        }, $fd, true);
    }
}