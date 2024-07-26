<?php

interface ICountryFactory {
    public function createTechnologyDepartment($type): ITechnologyDepartment;
    public function createConstructionDepartment($type): IConstructionDepartment;
}

//abstractfactory + singleton
class CountryFactory implements ICountryFactory 
{
    private static $instance = null;
    private array $technologyClasses = [
        'VN' => VietNamTechnology::class,
        'JP' => JapanTechnology::class,
    ];      
    private array $constructionClasses = [
        'VN' => VietNamConstruction::class,
        'JP' => JapanConstruction::class,
    ];
    
    private function __construct() 
    {

    } 
  
    public static function getInstance(): ICountryFactory {
        return empty(static::$instance) ? new CountryFactory() : static::$instance;
    }
  
    public function createTechnologyDepartment($type): ITechnologyDepartment {
        $class = $this->technologyClasses[$type] ?? VietNamTechnology::class;
        return new $class;
    }
  
    public function createConstructionDepartment($type): IConstructionDepartment {
        $class = $this->constructionClasses[$type] ?? VietNamConstruction::class;
        return new $class;
    }
}
  
// //abstractfactory + switchcase
// class CountryFactory implements ICountryFactory {
//     public function createTechnologyDepartment($type): ITechnologyDepartment {
//         switch ($type){
//             case 'VN': 
//                 return new VietNamTechology();
//             default:
//                 return new JapanTechnology();
//         }
//     }
//     public function createConstructionDepartment($type): IConstructionDepartment {
//         switch ($type){
//             case 'VN': 
//                 return new VietNamConstruction();
//             default:
//                 return new JapanConstruction();
//         }
//     }
// }

// //abstractfactory
// class VietNamCountryFactory implements ICountryFactory {
//     public function createTechnologyDepartment(): ITechnologyDepartment {
//         return new VietNamTechology();
//     }

//     public function createConstructionDepartment(): IConstructionDepartment {
//         return new VietNamConstruction();
//     }
// }

// class JapanCountryFactory implements ICountryFactory {
//     public function createTechnologyDepartment(): ITechnologyDepartment {
//         return new JapanTechnology();
//     }

//     public function createConstructionDepartment(): IConstructionDepartment {
//         return new JapanConstruction();
//     }
// }

interface ITechnologyDepartment {
    public function getAllEmployee();
}

interface IConstructionDepartment {
    public function getAllEmployee();
}

class VietNamTechnology implements ITechnologyDepartment {
    public function getAllEmployee(){
        echo "10 VN it workers\n";
    }
}

class VietNamConstruction implements IConstructionDepartment {
    public function getAllEmployee(){
        echo "30 VN construction workers\n";
    }
}

class JapanTechnology implements ITechnologyDepartment {
    public function getAllEmployee(){
        echo "5 Japan it workers\n";
    }
}

class JapanConstruction implements IConstructionDepartment {
    public function getAllEmployee(){
        echo "60 Japan construction workers\n";
    }
}

// $countryVietNamFactory = new VietNamCountryFactory();
// $techVietNam = $countryVietNamFactory->createTechnologyDepartment();
// $consVietNam = $countryVietNamFactory->createConstructionDepartment();

// $countryJapanFactory = new JapanCountryFactory();
// $techJapan = $countryJapanFactory->createTechnologyDepartment();
// $consJapan = $countryJapanFactory->createConstructionDepartment();

$countryVietNamFactory = CountryFactory::getInstance();
$techVietNam = $countryVietNamFactory->createTechnologyDepartment('VN');
$consVietNam = $countryVietNamFactory->createConstructionDepartment('VN');

$countryJapanFactory = CountryFactory::getInstance();
$techJapan = $countryJapanFactory->createTechnologyDepartment('VN');
$consJapan = $countryJapanFactory->createConstructionDepartment('JP');


$techVietNam->getAllEmployee(); 
$consVietNam->getAllEmployee(); 
$techJapan->getAllEmployee();   
$consJapan->getAllEmployee();    