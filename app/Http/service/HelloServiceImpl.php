<?php


namespace App\Http\service;


use App\Http\service\InInterface\HelloService;

class HelloServiceImpl implements HelloService
{

    public function sayHello($name)
    {
        if (empty($name)){
            throw new \RuntimeException("parameter is null");
        }
        var_dump('hello:'.$name);
    }

    public function sayGoodBy($name,array $arr)
    {
        var_dump($name.':sayGoodBy:'.json_encode($arr));
        return $arr;
    }

    public static function good($name){
        var_dump($name);
        return $name;
    }
}
