<?php

// -------------------
// Autoload classes
// -------------------


// require_once "./classes/testing1.php";
// require_once "./classes/testing2.php";
// require_once "./classes/testing3.php";

spl_autoload_register(function ($c_name){
    require './classes/'.$c_name.'.php';
});

$test=new testing1();
print_r($test);