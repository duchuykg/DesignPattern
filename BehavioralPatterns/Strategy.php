<?php

interface Strategy {
    public function excute($a, $b);
}

class AddStrategy implements Strategy {
    public function excute($a, $b)
    {
        return $a + $b;
    }
}

class SubStrategy implements Strategy {
    public function excute($a, $b)
    {
        return $a - $b;
    }
}

class Mul implements Strategy {
    public function excute($a, $b)
    {
        return $a * $b;
    }
}

class Divide implements Strategy {
    public function excute($a, $b)
    {
        return $a / $b;
    }
}

class Context 
{
    private $strategy;

    public function setStrategy(Strategy $strategy)
    {
        $this->strategy = $strategy;
    }

    public function exc($a, $b){
        return $this->strategy->excute($a, $b);
    }

}

$context = new Context();
$context->setStrategy(new AddStrategy());

echo $context->exc(4,5);