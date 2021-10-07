<?php


namespace App\Http\Controllers\Test;
use App\Http\Controllers\Controller;
use App\Http\Controllers\intercept\MyInterceptor;
use App\Http\Controllers\intercept\proxy\ProxyBean;


class TestController extends Controller
{
    /**
     * 显示指定用户的简介
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show()
    {
        $proxy = ProxyBean::getProxyBean('App\Http\service\HelloServiceImpl',[],new MyInterceptor());
        //$proxy->sayHello();
        echo '<br>';
        $result = $proxy->sayGoodBy('小狗',['one','two']);
        var_dump($result);
        //return view('testDemo');
    }
}
