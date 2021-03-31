<?php
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------

namespace app\rpc\providers;


use think\App;
use think\swoole\rpc\Error;
use think\swoole\rpc\File;
use think\swoole\rpc\Packer;
use think\swoole\rpc\Protocol;
use think\swoole\rpc\server\Dispatcher;
use Throwable;

class MyRpcDispatcher extends Dispatcher
{
    public function dispatch(App $app, int $fd, $data)
    {
        // xu.增加调度后事件
        $args = func_get_args();
        $this->addEventBefore(...$args);

        try {
            switch (true) {
                case $data instanceof File:
                    $this->files[$fd][] = $data;
                    return;
                case $data instanceof Error:
                    $result = $data;
                    break;
                case $data === Protocol::ACTION_INTERFACE:
                    $result = $this->getInterfaces();
                    break;
                default:
                    $protocol = $this->parser->decode($data);
                    $result   = $this->dispatchWithMiddleware($app, $protocol, $fd);
            }
        } catch (Throwable $e) {
            $result = Error::make($e->getCode(), $e->getMessage());
        }

        $data = $this->parser->encodeResponse($result);

        $this->server->send($fd, Packer::pack($data));
        //清空文件缓存
        unset($this->files[$fd]);

        // xu.增加调度后事件
        array_push($args, $result ?? []);
        $this->addEventAfter(...$args);
    }

    public function addEventBefore(App $app, int $fd, $data) {
        $app->event->trigger('swoole.rpc.DispatcherBefore', func_get_args());
    }

    public function addEventAfter(App $app, int $fd, $data, $result) {
        $app->event->trigger('swoole.rpc.DispatcherAfter', func_get_args());
    }
}