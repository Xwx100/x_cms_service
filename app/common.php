<?php
// 应用公共文件

if (function_exists('x_rpc_manager')) {
    /**
     * @return \think\swoole\RpcManager|Object
     */
    function x_rpc_manager()
    {
        return app(\think\swoole\RpcManager::class);
    }
}
