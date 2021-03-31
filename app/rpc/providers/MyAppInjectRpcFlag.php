<?php
// +----------------------------------------------------------------------
// |
// +----------------------------------------------------------------------

namespace app\rpc\providers;


use think\App;

class MyAppInjectRpcFlag
{
    /**
     * @var App|null
     */
    protected $app = null;
    protected $varName = 'x_env';
    protected $varValue = 'rpc';
    protected $tryOther = false;

    public function __construct(App $app)
    {
        $this->app = $app;
    }

    public function injectFlag() {
        $this->app->{$this->varName} = $this->varValue;
    }

    public function injectTryOther($tryOther = false) {
        $this->tryOther = $tryOther;
    }


    /**
     * 判断是否处于rpc环境下 1.判断容器app是否带有rpc标识 2.若无，求次，使用是否处在协程环境下
     * @return bool
     */
    public function isRpc() {
        $isRpc = property_exists($this->app, $this->varName) && $this->app->{$this->varName} === $this->varValue;
        if (empty($isRpc) && $this->tryOther) {
            $isRpc = method_exists($this->app, 'runningInConsole') && $this->app->runningInConsole();
            if ($isRpc) {
                $this->injectFlag();
            }
        }

        return $isRpc;
    }
}