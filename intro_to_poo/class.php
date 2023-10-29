<?php

// final class Appledevice
class Appledevice {
    // properties
    public $ram="5G";
    public $inch="7_in";
    public $space="120gb";
    public $color="grey";
    public $name_device="not defined";
    private $password="epmty!";
    // methods
    public function backToline($item){
        echo '<br>'.$item;
    }
    // constants
    const owner_name=7;
    const nd="Samsung"; 
    public function setOwnerDevice(){
        if(strlen($this->name_device)<self::owner_name){
        echo "Name device: device name is too short must be ".self::owner_name." chars!";
        }else{
            // echo "Name device: not defined!";
            echo "Name device: ".$this->name_device;
        }
    }
    public function deviceInfo(){
        $this->backToline("Device details: ");
        $this->backToline("Ram: ".$this->ram);
        $this->backToline("Inch: " .$this->inch);
        $this->backToline("Space: ".$this->space);
        $this->backToline("Color: ".ucfirst($this->color));
        $this->backToline("Name device: ".$this->name_device);
    }
    public function changeProperties($ram=null,$inch,$space,$color,$nd=null){
        echo $this->backToline("Device details updates: ");
        $this->backToline("Ram :".$this->ram=$ram);
        $this->backToline("Inch :".$this->inch=$inch);
        $this->backToline("Space :".$this->space=$space);
        $this->backToline("Color :".$this->color=$color);
        
        if(str_contains($nd,self::nd)){
            $this->backToline("Name device :".$this->name_device=$nd);

        }else{
            $this->backToline("Device name invalid!");
        }
    }
    final public function sayName(){
        echo get_class($this)."<br>";
    }
    // Ebcapsulation
    public function passwordUpdate($pass){
        return $this->password=sha1($pass);
    }
    
    // Inheritance
    // class NewClass extends OldClass

} 

// Inheritance
class Sony extends Appledevice{

    // Error 
    public function changeProp($ram,$inch,$space){
        $this->backToline("Details updates: ");
        $this->backToline("Ram :".$this->ram=$ram);
        $this->backToline("Inch :".$this->inch=$inch);
        $this->backToline("Space :".$this->space=$space);

    }

    public function backToline($item){
        echo $item.'<br>';
    }
    // public function sayName(){
    //     echo $this->backToline("\"".get_class($this)."\"".' Ram properties: '.$this->ram);
    // }

    // public function sayName(){
    //     echo get_class($this)."<br>";
    // }
}
// Inheritance overriding


// $mobile1= new Appledevice();
 // $mobile1->ram ="2GB";
 // $mobile1->inch=7; 
 // $mobile1->space=64;
 // // $mobile1->color="white";
 
 // $mobile4= new Appledevice();
 // $mobile4->ram ="8GB";
 // $mobile4->inch=10;
 // $mobile4->space=152;
 // $mobile4->color="black";
 // $mobile4->product_year=2010;
 
 // echo "<pre>";
 // var_dump($mobile1);
 // print_r($mobile1);
 // print_r($mobile4);
 // print_r($mobile);
 // echo "</pre>";
 
 // $mobile=new Appledevice();
 // $mobile->phoneInfo();
 // $mobile->name_device="php_poo";
 // $mobile->setOwnerDevice();
 // we can echo const of class using SRO with c_name ot obj_name
 // $mobile->backToline("class_const: ".Appledevice::owner_name);
 // $mobile->backToline("class_const: ".$mobile::owner_name);
 
 // $mobile=new Appledevice();
 // $mobile->changeProperties("10gb","8in","120bg","bleu");
 // $mobile->backToline($mobile->passwordUpdate("abdeltest123"));
 // echo "<br>";
 // $mobile->password="testgo";

 // $mobile=new Sony();
 // $mobile1=new Appledevice();
 // $mobile->backToline($mobile->passwordUpdate('12345test'));
 // $mobile->changeProp("10gb","8in","120bg");
 
 // $mobile->sayName();
 // $mobile1->sayName();
 
 // $mobile1->deviceInfo();
 // $mobile1->product_year='2003';
 
 // echo str_repeat('<br>',2);
 // $mobile->deviceInfo();

// $mobile->sayName();

