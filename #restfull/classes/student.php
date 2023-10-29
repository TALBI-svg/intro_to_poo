<?php
include_once '../config/db.php';

class Student{
    public $name;
    public $email;
    public $mobile;
    public $status;
    public $id;

    private $conn;
    private $table_name;
     
    public function __construct($db){
        $this->conn=$db;
        $this->table_name='student';
    }

    public function create_student(){
        $table=$this->table_name;
        $connection=$this->conn;

        $name=htmlspecialchars(strip_tags($this->name));
        $email=htmlspecialchars(strip_tags($this->email));
        $mobile=htmlspecialchars(strip_tags($this->mobile));

        $sql="INSERT INTO $table (name, email, mobile, create_at) 
        VALUES(:name, :email, :mobile, now() )";
        $statment=$connection->prepare($sql);
        $statment->execute(array(':name'=>$name, ':email'=>$email,':mobile'=>$mobile));
        if($statment->rowCount()==1){
            return true;
        }else{
            return false;
        }
    }

    public function get_students(){
        $table=$this->table_name;
        $connection=$this->conn;

        $sql="SELECT * FROM $table";
        $statment=$connection->query($sql);
        if(!$statment){
            return "invalid query!".$connection->getMessage();
        }else{
            return $statment;
        }

    } 

    public function get_student(){
        $table=$this->table_name;
        $connection=$this->conn;

        $id=$this->id;
        $sql="SELECT * FROM $table WHERE id='$id'";
        $statment=$connection->query($sql);
        if(!$statment){
            die('invalid query!').$connection->getMessage();
        }else{
            return $statment;
        }
    }

    public function update_seudent(){
        $table=$this->table_name;
        $connection=$this->conn;

        $name=htmlspecialchars(strip_tags($this->name));
        $email=htmlspecialchars(strip_tags($this->email));
        $mobile=htmlspecialchars(strip_tags($this->mobile));
        $status=htmlspecialchars(strip_tags($this->status));
        $id=htmlspecialchars(strip_tags($this->id));

        $sql="UPDATE $table SET name=:name, email=:email, mobile=:mobile, status=:status, create_at=now() WHERE id=:id";
        $statment=$connection->prepare($sql);
        $statment->execute(array(':name'=>$name,':email'=>$email,':mobile'=>$mobile,':status'=>$status,':id'=>$id));
        if($statment->rowCount()==1){
            return true;
        }else{
            return false;
        }
    }

    public function delete_student(){
        $table=$this->table_name;
        $connection=$this->conn;

        // sanitize tags
        $id=htmlspecialchars(strip_tags($this->id));

        $sql="DELETE FROM $table WHERE id='$id'";
        $statment=$connection->query($sql);
        if($statment){
            return true;
        }else{
            return false;
        }
    }
}

// $connection=new db();
// $conn=$connection->connect();
// $stu=new Student($conn);
// $stu->name='kamal';
// $stu->email='kamal@gmail.com';
// $stu->mobile='+2120693755374';
// $stu->create_student();
// echo $stu->update_seudent();


