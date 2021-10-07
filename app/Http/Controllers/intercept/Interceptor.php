<?php


namespace App\Http\Controllers\intercept;
use App\Http\Controllers\intercept\invoke\Invocation;

interface Interceptor
{

    public function before() :bool;

    public function after();

    public function around(Invocation $invocation);

    public function afterReturning();

    public function afterThrowing(\Exception $ex);

    public function useAround() :bool;

}
