<?php

interface WorkerInterface
{
    public function getSalary(): float;
    public function getWorkHours(): int;
}

// Concrete Bridge Implementations
class FullTimeWorker implements WorkerInterface
{
    private $salary;
    private $workHours;
    public function __construct(float $salary, int $workHours)
    {
        $this->salary = $salary;
        $this->workHours = $workHours;
    }

    
    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getWorkHours(): int
    {
        return $this->workHours;
    }
}

class PartTimeWorker implements WorkerInterface
{
    private $salary;
    private $workHours;

    public function __construct(float $salary, int $workHours)
    {
        $this->salary = $salary;
        $this->workHours = $workHours;
    }

    public function getSalary(): float
    {
        return $this->salary;
    }

    public function getWorkHours(): int
    {
        return $this->workHours;
    }

}

// Abstraction (Lớp trừu tượng Nhân viên)
abstract class Worker
{
    protected WorkerInterface $worker;

    public function __construct(WorkerInterface $worker)
    {
        $this->worker = $worker;
    }

    abstract public function getSumSalary(): array;
}

// Refined Abstraction (Các loại Nhân viên cụ thể)
class SeniorWorker extends Worker
{
    public function getSumSalary(): array
    {
        return [
            'Salary' => $this->worker->getSalary(),
            'Work Hours' => $this->worker->getWorkHours(),
            'Sum Salary' => $this->worker->getSalary() * $this->worker->getWorkHours() * $this->getCoefficient(),
        ];
    }

    public function getCoefficient()
    {
        return 2;
    }
}

class JuniorWorker extends Worker
{
    public function getSumSalary(): array
    {
        return [
            'Salary' => $this->worker->getSalary(),
            'Work Hours' => $this->worker->getWorkHours(),
            'Sum Salary' => $this->worker->getSalary() * $this->worker->getWorkHours(),
        ];
    }
}

// Usage
$fullTimeWorker = new FullTimeWorker(5000.0, 40);
$seniorFullTimeWorker = new SeniorWorker($fullTimeWorker);
print_r($seniorFullTimeWorker->getSumSalary());
echo 'He so luong: ' . $seniorFullTimeWorker->getCoefficient();

echo "\n";

$partTimeWorker = new PartTimeWorker(2000.0, 20);
$juniorPartTimeWorker = new JuniorWorker($partTimeWorker);
print_r($juniorPartTimeWorker->getSumSalary());