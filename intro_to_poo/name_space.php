<?php

// --------------------
// namespace
// --------------------


// require_once "./testing.php";
 // class Testing{
 //     public $name;
 // }
 // $test=new testing();
// print_r($test);


include_once "./phones/apple.php";
include_once "./phones/samsung.php";

$iphone=new Apple\hardware\CreatePhone();
$iphone_apps=new Apple\software\CreateApps();
// print_r($iphone);
$iphone->sayHi();
$iphone_apps->getApps();


$samsung=new Samsung\CreatePhone();
$samsung->sayHi();