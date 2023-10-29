<?php

namespace Apple\hardware;
class CreatePhone{
    public $name="Apple";

    public function sayHi(){
        echo "hello from: {$this->name}<br>";
    }
}

namespace Apple\software;
class CreateApps{
    public $apps_series="TEG26DB";

    public function getApps(){
        echo "This apple apps series: {$this->apps_series}<br>";
    }
}