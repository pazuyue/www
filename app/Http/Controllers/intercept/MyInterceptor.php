<?php


namespace App\Http\Controllers\intercept;

use App\Http\Controllers\intercept\invoke\Invocation;

class MyInterceptor implements Interceptor
{

    public function before(): bool
    {
        var_dump('before......<br>');
        return true;
    }

    public function after()
    {
        // TODO: Implement after() method.
    }

    public function afterReturning()
    {
        var_dump('afterReturning...<br>');
    }

    public function afterThrowing(\Exception $ex)
    {

        var_dump('afterThrowing...'.$ex->getMessage());
    }

    public function useAround(): bool
    {
        return true;
    }


    public function around(Invocation $invocation)
    {
        var_dump('around before...<br>');
        $obj = $invocation->proceed();
        var_dump($obj);
        var_dump('<br>around after...<br>');
        return $obj;
    }
}
