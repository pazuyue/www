<?php


namespace App\Http\Controllers\intercept\invoke;


class Invocation
{
    private $init;
    private $className;
    private $name;
    private $methodargs;
    public function __construct(string $className,array $args = [],$name,$methodargs = [])
    {
        $ref = new \ReflectionClass($className);
        $this->init = $ref->newInstanceArgs($args);
        $this->className = $className;
        $this->name = $name;
        $this->methodargs = $methodargs;
    }

    public function proceed()
    {
        var_dump('proceed...<br>');
        $reflectionMethod = new \ReflectionMethod($this->className, $this->name);
        try {
        if ($reflectionMethod->isPublic()){
            return $reflectionMethod->invokeArgs($this->init, $this->methodargs);
        }
        }catch (\ArgumentCountError $exception){
            throw new \ArgumentCountError($exception->getMessage());
        }

    }

}
