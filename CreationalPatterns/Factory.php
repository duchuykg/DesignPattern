<?php

// Product
interface Vehicle {
    public function drive();
}

// Concrete Products
class Car implements Vehicle {
    public function drive() {
        echo "Driving a car...\n";
    }
}

class Motorcycle implements Vehicle {
    public function drive() {
        echo "Driving a motorcycle...\n";
    }
}

// Creator
class VehicleFactory {
    public function createVehicle($type): Vehicle {
        switch ($type){
            case 'CAR': 
                return new Car();
            default:
                return new Motorcycle();
        }
    }
}

// Concrete Creators
// class CarFactory extends VehicleFactory {
//     public function createVehicle(): Vehicle {
//         return new Car();
//     }
// }

// class MotorcycleFactory extends VehicleFactory {
//     public function createVehicle(): Vehicle {
//         return new Motorcycle();
//     }
// }

// Usage
$factory = new VehicleFactory();
$car = $factory->createVehicle('CAR');
$car->drive(); 

$factory = new VehicleFactory();
$motorcycle = $factory->createVehicle('MOTOR');
$motorcycle->drive(); 