<?php

interface TargetInterface
{
    public function request();
}

class Adaptee
{
    public function specificRequest()
    {
        echo "Yêu cầu cụ thể của Adaptee\n";
    }
}

class Adapter implements TargetInterface
{
    private $adaptee;

    public function __construct(Adaptee $adaptee)
    {
        $this->adaptee = $adaptee;
    }

    public function request()
    {
        $this->adaptee->specificRequest();
    }
}

$adaptee = new Adaptee();
$adapter = new Adapter($adaptee);
$adapter->request(); 