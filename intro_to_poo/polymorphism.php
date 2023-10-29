<?php
// Polymorphism
// Have abstract methods 
 
interface Mobile{
    public function pressHome();
}
class Samsung implements Mobile{
    public $name;
    public function pressHome(){
        echo "You will see opned applications"."<br>";
    }
}
  
class Redmi implements Mobile{
    public $name;
    public function pressHome(){
        echo "You will see closed applications"."<br>";
    }
}

// $obj=new Samsung();
 // $obj1=new Redmi();
 
 // $obj->pressHome();
 // $obj1->pressHome();
 
 // echo "<pre>";print_r($obj);echo "</pre>";
// echo "<pre>";print_r($obj1);echo "</pre>";



interface DBconn{
    public function getUser();
    public function getLatestPosts();
    public function getPosts();
}

class Mysql implements DBconn{
    public function getUser(){
        echo "SELECT * FROM users"."<br>";
    }
    public function getLatestPosts(){
        echo "SELECT * FROM latestposts"."<br>";
    }
    public function getPosts(){
        echo "SELECT * FROM posts"."<br>";
    }
}

class OracleDB implements DBconn{
    public function getUser(){
        echo "Oracle_SELECT * FROM users"."<br>";
    }
    public function getLatestPosts(){
        echo "Oracle_SELECT * FROM latestposts"."<br>";
    }
    public function getPosts(){
        echo "Oracle_SELECT * FROM posts"."<br>";
    }
}

// $query=new OracleDB();
 // $query->getUser();
 // $query->getLatestPosts();
 // $query->getPosts();
 
 // echo "<pre>";
 // print_r(get_class_methods($query));
// echo "</pre>";

