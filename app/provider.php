<?php
use app\ExceptionHandle;
use app\Request;

// 容器Provider定义文件
return [
    'think\Request'          => Request::class,
    'think\exception\Handle' => ExceptionHandle::class,

    // xu. 强制 替换 容器
    \think\swoole\RpcManager::class => \app\rpc\providers\MyRpcManager::class, // 替换 Rpc 管理
    \think\swoole\rpc\server\Dispatcher::class => \app\rpc\providers\MyRpcDispatcher::class, // 替换 Rpc 调度
];
