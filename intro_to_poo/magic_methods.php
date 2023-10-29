<?php
// Marigc methods (method with special name start with double underscor [ __ ])

// __construct and __destruct
class Samsung{
    public $name;
    public $ram;

    public function getName(){
        echo get_class($this);
    }

    public function __construct($name,$ram){
        echo "obj is ready for {$name} his ram is: ".$ram." ";
    }

    public function __destruct(){
        echo "obj destroyed"." ";
    } 

}
// $mobile=new Samsung("Mbile",14);
 // $mobile->getName();
 // echo "<pre>"; 
 // print_r($mobile);
// echo "</pre>";



// __call
class Users{
    public $name;
    public $age;

    private function getUser_name($name){
        echo "Hello {$name}";
    } 

    // use to alert non exist and private functions inside the class
    public function __call($method,$args){
        echo "The method \"{$method}\" not found or not accessible!"."<br>";
        foreach($args as $arg){
            echo $arg."<br>";
        }
    }
}
// $user=new Users();
 // $user->name="Test";
// $user->getUser_name('test',12);



// __get and __set
class Products{
    private $name="null";
    private $price="null";
    private $stock="null";

    public function __get($args){
        echo "The property \"{$args}\" not found or private!"."<br>";
    }
    public function __set($args,$vals){
        echo "The property \"{$args}\" not found or private can't change it using \"{$vals}\" !"."<br>";
    }

} 
// $product=new Products();
 // $product->test='go';
 // echo "<pre>";
 // print_r($product);
// echo "</pre>";



// __clone
class Student{
    public $name='null';
    public $lastname='null';
    public $num='null';
    public $session='null';

    public function __construct($name,$lastname,$num,$session){
        $this->name=$name;
        $this->lastname=$lastname;
        $this->num=$num;
        $this->session=$session;
    }

    public function pre($str){
        echo "<pre>";
        print_r($str);
        echo "</pre>";
    }

    public function __clone(){
        $this->name=clone $this->name;
    }

}
$main=new Student('karim','kadiri','193DFE','2020-2021');
// $main->pre($main);
 // $main->pre($copy);
 
 // $copy= clone $main; // copy by reference
 // $main->name='Ahmed';
 
 // $copy->name='Hamza';
 
 // $main->pre($main->name);
    
 // $copy=$main;
 // $copy->name='Ahmed';
 
// $main->pre($copy->name);



// Static keywork
class Car{
    public static $name='null';
    public $model='null';
    public $puissance='null';
    public $color='null';  

    public static function info(){
        echo "Hello from static method".str_repeat("<br>",1);
    }

}
// $car=new Car();
 // echo Car::$name;
// echo $car->info();

 


// Method chaining 
class client{
    public $name;
    public $email;
    public $ref;
    public $order;

    public function clientReference(){
        echo "client ref: {$this->ref} ,email: {$this->email}<br>";
        return $this;
    }
    public function clientName(){
        echo "client_name: {$this->name}<br>";
        return $this;
    }
    public function clientOrder(){
        echo "c_order: {$this->order}<br>";
        return $this; 
    }

}   
// $client=new client();
 // $client->name='ahmed';
 // $client->email='ahmed@email.com';
 // $client->ref='OF364DN';
 // $client->order='labtop height perfomace from HP';
// $client->clientReference()->clientName()->clientOrder();



// ----------------
// Trait 
// ----------------
// trait is a mechanism allow us to use the code in languages that support single inheritance
// using traits we can inherit properties / methods from multiple sources
// can't extends or implements
// can't instanciate
// support class and not replace class
// can have methods
// have priority 


// traits
trait FingerPrint{
    public function fingerFeature(){
        echo "Support Finger print<br>";
        return $this;
    }
}
trait ThreeDimenssionTouch{
    public function ThreeD(){
        echo "Support 3D touch<br>";
        return $this;
    }
}
trait FaceID{
    public function FaceDetection(){
        echo "Support face id<br>";
        return $this;
    }
}

// all traits
trait AllFeatures{
    use FingerPrint,ThreeDimenssionTouch,FaceID;
}

// classes
class IPhone{
   use AllFeatures;

}
class Wiko{ 
    use ThreeDimenssionTouch;
    use FingerPrint;
   
}
class Redmi{
    use FingerPrint;
}
// $device=new IPhone();
 // $device->fingerFeature()->ThreeD()->FaceDetection();
 // echo "<br>";
 
 // $device_wiko=new Wiko();
 // $device_wiko->fingerFeature()->ThreeD();
 // echo "<br>";
 
 // $device_redmi=new Redmi();
 // $device_redmi->fingerFeature();
 
 // $apple=new AppleDevice();
// $apple->sayHi();


// ----------------
// traits and class priority 
// ----------------
trait MyFeature{
    public function sayHi(){
        echo "Hello from Myfeature";
    }
}
class AppleDevice{
    public function sayHi(){
        echo "Hello from AppleDevice";
    }
}
class ipad extends AppleDevice{
    use MyFeature;

}
// $ipad=new ipad();
// $ipad->sayHi();



// ----------------
// traits conflect
// ----------------

trait Product{
    public function prodInfo(){
        echo "hello from product info...<br>";
    }
}

trait ProductsDetails{
    public function prodInfo(){
        echo "hello from products info...<br>";
    }
}

class Production{
    static $name='no name!';
    
    use Product,ProductsDetails{
        // trait name:: method name insteadof other method name
        ProductsDetails:: prodInfo as products;
        Product:: prodInfo insteadOf ProductsDetails;
    }
    public static function inProduction(){
        echo self::$name."<br>";
    }
}
$prod=new Production();
$prod->prodInfo();
$prod->products();
