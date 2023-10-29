<?php

// class absract can't instantiated
// make for other classes to inherit Porps and Methods
// can have props and methods
// can have abstract mthods and non abstract methods 
// abstract methods contain no body

// Rules to go on
// Force developper to follow your mrthods 

abstract class MakeDevice{
    // public $ram='empty';
    // public function sayName(){
    //     echo get_class($this);
    // }
    // abstract public function sayBey();
    // abstract public function getDate();

    abstract protected function testPerformaces();
    abstract public function verifyOwner();
    abstract public function validMsg($dn);
    public function Separator(){
        echo "<br>";
    }
}

class Samsung extends MakeDevice{
    public function testPerformaces(){
        echo get_class($this)." Performaces is good"."<br>";
    }
    public function verifyOwner(){
        echo get_class($this)." Owner is verified for, "."<br>";
    }

    public function validMsg($dn){
        // echo "Product is ready, ".get_class($this)."<br>";
        echo "Product is ready, ".get_class($this)." ".$dn."<br>";
    }
}

class Redmi extends Samsung{
    // public function testPerformaces(){
     //     echo get_class($this)." Performaces is good"."<br>";
     // }
     // public function verifyOwner(){
     //     echo " Owner is verified for, ".get_class($this)."<br>";
     // }
     // public function validMsg(){
     //     echo "Product is ready, ".get_class($this)."<br>";
    // }
}

class Appledevice extends Samsung{
    // public function sayBey(){
     //     echo "<br>"."Bey from ".get_class($this);
     // }
     // public function getDate(){
     //     echo "<br>".date('y-m-d');
    // }

    // public function testPerformaces(){
     //     echo get_class($this)." Performaces is good"."<br>";
     // }
     // public function verifyOwner(){
     //     echo " Owner is verified for, ".get_class($this)."<br>";
     // }
     // public function validMsg(){
     //     echo "Product is ready, ".get_class($this)."<br>";
    // }
} 


// $abs=new Appledevice();
// echo $abs->ram='test'.'<br>';
// $abs->sayName();
// $abs->sayBey();
// $abs->getDate();


$mobile=new Samsung();
$mobile1=new Redmi();
$mobile2=new Appledevice();

$devices=array($mobile,$mobile1,$mobile2);

echo "Test performances for devices: ".str_repeat("<br>",1);
foreach($devices as $device){
    echo "<pre>";
    $device->testPerformaces();
    echo "</pre>";
}
$mobile->Separator();

echo "Verify owner for devices: ".str_repeat("<br>",1);
foreach($devices as $device){
    echo "<pre>";
    $device->verifyOwner();
    echo "</pre>";
}
$mobile->Separator();

echo "Valid message: ".str_repeat("<br>",1);
foreach($devices as $device){
    echo "<pre>";
    $device->validMsg(' testing');
    echo "</pre>";
}




while($devices<=3){
    echo $devices->testPerformaces();
}