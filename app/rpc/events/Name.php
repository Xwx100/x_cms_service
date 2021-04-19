<?php
// +----------------------------------------------------------------------
// | 所有事件
// +----------------------------------------------------------------------

namespace app\rpc\events;


/**
 * Class RpcCbName
 * @property string $masterInit
 * @property string $masterStart
 * @property string $masterShutdown
 * @property string $managerStart
 * @property string $workerStart
 * @property string $onTask
 * @property string $workerRpcConnect
 * @property string $workerRpcReceive
 * @property string $coDispatcherBefore
 * @property string $coDispatcherAfter
 * @property string $workerRpcClose
 * @package app\rpc\events
 */
class Name
{
    // master 进程开始前 回调
    protected $masterInit = 'swoole.init';
    // master 进程开始 回调
    protected $masterStart = 'swoole.start';
    // master 进程关闭 回调
    protected $masterShutdown = 'swoole.shutdown';
    // manager 进程开始 回调
    protected $managerStart = 'swoole.managerStart';
    // worker 进程开始 回调
    protected $workerStart = 'swoole.workerStart';
    protected $onTask = 'swoole.task';
    //
    protected $workerRpcConnect = 'swoole.rpc.Connect';
    protected $workerRpcReceive = 'swoole.rpc.Receive';
    protected $coDispatcherBefore = 'swoole.rpc.DispatcherBefore';
    protected $coDispatcherAfter = 'swoole.rpc.DispatcherAfter';
    protected $workerRpcClose = 'swoole.rpc.Close';

    public function __get($name)
    {
        return $this->$name;
    }
}