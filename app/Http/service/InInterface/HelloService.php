<?php


namespace App\Http\service\InInterface;


interface HelloService
{
    public function sayHello($name);

    public function sayGoodBy($name,array $arr);
}


