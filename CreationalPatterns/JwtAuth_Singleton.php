<?php

class JwtAuth
{
    private static $instance = null;

    private function __construct() 
    { 
    }

    public static function getInstance()
    {
        if(empty(static::$instance)) static::$instance = new JwtAuth();
        return static::$instance;
    }

    public function __wakeup()
    {
    }

}

/**
 * The client code.
 */
function clientCode()
{
    $s1 = JwtAuth::getInstance();
    $s2 = JwtAuth::getInstance();
    if ($s1 === $s2) {
        echo "Works, both variables contain the same instance.";
    } else {
        echo "Failed, variables contain different instances.";
    }
}

clientCode();
