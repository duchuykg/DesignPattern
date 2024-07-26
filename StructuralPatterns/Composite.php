<?php

abstract class Employee {
    protected Employee $employee;
    protected $name;
    protected $salary;

    public function __construct($name, $salary) {
        $this->name = $name;
        $this->salary = $salary;
    }

    public function setParent(?Employee $employee)
    {
        $this->employee = $employee;
    }

    public abstract function add(Employee $employee);
    public abstract function remove(Employee $employee);
    public abstract function getPayment();
}

class FullTimeEmployee extends Employee {
    public function add(Employee $employee) {}
    public function remove(Employee $employee) {}
    public function getPayment() 
    {
        return $this->salary * 2;
    }
}

// Lớp PartTimeEmployee kế thừa từ Employee
class PartTimeEmployee extends Employee {
    public function add(Employee $employee) {}
    public function remove(Employee $employee) {}
    public function getPayment() 
    {
        return $this->salary;
    }
}

class Group extends Employee {
    protected $employees = [];

    public function add(Employee $employee) {
        $this->employees[] = $employee;
    }

    public function remove(Employee $employee) {
        $key = array_search($employee, $this->employees, true);
        if ($key !== false) {
            unset($this->employees[$key]);
        }
    }

    public function getPayment() {
        $totalPayment = $this->salary;
        foreach ($this->employees as $employee) {
            $totalPayment += $employee->getPayment();
        }
        return $totalPayment;
    }
}

function clientCode() {
    $fullTimeEmployee = new FullTimeEmployee("John", 5000.0);
    $partTimeEmployee = new PartTimeEmployee("Jane", 2000.0);

    $department = new Group("Department", 0.0);
    $department->add($fullTimeEmployee);
    $department->add($partTimeEmployee);

    echo "Total payment for the department: " . $department->getPayment() . "\n";
}

// Hàm clientCode2
function clientCode2() {
    $fullTimeEmployee = new FullTimeEmployee("John", 5000.0);
    $fullTimeEmployee1 = new FullTimeEmployee("Victor", 5000.0);
    $fullTimeEmployee2 = new FullTimeEmployee("Daniel", 6000.0);
    $fullTimeEmployee3 = new FullTimeEmployee("Justin", 7000.0);

    $partTime = new PartTimeEmployee("John", 5000.0);
    $partTime1 = new PartTimeEmployee("Victor", 5000.0);
    $partTime2 = new PartTimeEmployee("Daniel", 6000.0);

    $company = new Group("Company1", 10000);
    $company->add($fullTimeEmployee);
    $company->add($fullTimeEmployee1);
    $company->add($fullTimeEmployee2);
    $company->add($fullTimeEmployee3);

    $company2 = new Group("Company2", 10000);
    $company2->add($partTime);
    $company2->add($partTime1);
    $company2->add($partTime2);

    $corporation = new Group("Corporation", 100000);
    $corporation->add($company);
    $corporation->add($company2);



    echo "Payment for John: " . $fullTimeEmployee->getPayment() . "\n";
    echo "Total payment for the company: " . $company->getPayment() . "\n";
    echo "Total payment for the corporation: " . $corporation->getPayment() . "\n";

}

// clientCode();
clientCode2();
