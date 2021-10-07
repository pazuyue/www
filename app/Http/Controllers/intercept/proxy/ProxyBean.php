<?php


namespace App\Http\Controllers\intercept\proxy;


use App\Http\Controllers\intercept\Interceptor;
use App\Http\Controllers\intercept\invoke\Invocation;

/**
 * 约定代理 实现类
 * Class ProxyBean
 * @package App\Http\Controllers\intercept\proxy
 */
class ProxyBean
{
    private  $target = null; //被代理类
    private  $args = null;// 被代理的构造参数
    private  $interceptor = null; //代理类
    private $ex;


    /**
     * @param $target //被代理类
     * @param $args //被代理的构造参数
     * @param Interceptor $interceptor //代理类
     * @return ProxyBean
     */
    public static function getProxyBean($target,$args,Interceptor $interceptor){
        $proxyBean = new ProxyBean();
        //被代理的类
        $proxyBean->target = $target; //被代理类
        $proxyBean->args = $args; //被代理的构造参数
        $proxyBean->interceptor = $interceptor; //代理类
        return $proxyBean;
    }

    /**
     * 魔术方法 - 调用不存在的方法是，触发代理实现
     * @param $name
     * @param $arguments
     */
    public function __call($name,$arguments) {
        return $this->invoke($this->target,$this->args,$name,$arguments);
    }


    /**
     *代理执行
     * @param $target //被代理类
     * @param $args //被代理类构造参数
     * @param $name //被代理类执行方法
     * @param $arguments //被代理类执行方法-参数
     * @return void|null
     */
    public function invoke($target,$args,$name,$arguments){

        $exceptionFlag = false;
        $retObj = null;

        $invocation = new Invocation($target,$args,$name,$arguments);

        try {
            if ($this->interceptor->before() && $this->interceptor->useAround()){
                $retObj = $this->interceptor->around($invocation);
            }else{
                $retObj = $invocation->proceed();
            }
        }catch (\Exception $ex){
            $exceptionFlag = true;
            $this->ex =$ex;
        }
        $this->interceptor->after();
        if ($exceptionFlag){
            $this->interceptor->afterThrowing($ex);
        }else{
            $this->interceptor->afterReturning();
            return $retObj;
        }
        return null;
    }

}
