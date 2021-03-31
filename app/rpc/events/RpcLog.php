<?php
// +----------------------------------------------------------------------
// | 增加 日志
// +----------------------------------------------------------------------

namespace app\rpc\events;


use Swoole\Server;
use think\App;
use think\swoole\PidManager;
use think\swoole\RpcManager;
use think\swoole\Sandbox;

class RpcLog
{
    /**
     * @var PidManager|null
     */
    protected $pidManager = null;
    /**
     * @var RpcManager|null
     */
    protected $rpcManager = null;
    protected $sandbox = null;

    public function __construct(RpcManager $rpcManager, Sandbox $sandbox)
    {
        $this->rpcManager = $rpcManager;
        $this->sandbox = $sandbox;
//        $this->xu = $xu;
    }

    public function getServer(): Server
    {
        return $this->rpcManager->getServer();
    }

    public function onMasterStart() {
        app()->log->debug('主进程{masterPid} {managerPid} 开始 ');
    }

    public function onMasterShutdown() {
        app()->log->debug('主进程 关闭');
    }

    public function onManagerStart() {
        app()->log->debug('管理进程={pid} 开始', ['pid' => $this->getServer()->getManagerPid()]);
    }

    public function onWorkerStart() {
        app()->log->debug('工作进程={pid} 开始', ['pid' => $this->getServer()->worker_pid]);
    }

    public function onWorkerRpcConnect(Server $server, int $fd, int $reactorId)
    {
        app()->log->debug('工作进程 开始连接' . json_encode([$fd, $reactorId]));
    }

    public function onWorkerRpcReceive(Server $server, $fd, $reactorId, $data)
    {
        app()->log->debug('工作进程 开始接收');
    }

    // 已经替换成协程环境的app
    public function onCoDispatcherBefore(App $app, int $fd, $data)
    {
        app()->log->debug('工作进程 开始协程调度'. $fd);
        app()->log->debug($data);
        app()->log->debug($_SERVER);
    }

    // 已经替换成协程环境的app
    public function onCoDispatcherAfter(int $fd, $data, $result)
    {
        app()->log->debug('工作进程 结束协程调度');
        app()->log->debug($result);
    }

    public function onWorkerRpcClose(Server $server, int $fd, int $reactorId)
    {
        app()->log->debug('工作进程 关闭');
    }
}