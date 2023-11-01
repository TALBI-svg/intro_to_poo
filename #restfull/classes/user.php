<?php
// include_once '../config/db.php';

class User{
    public $id;
    public $name;
    public $email;
    public $password;

    public $project_user_id;
    public $project_name;
    public $project_description; 
    public $project_status;

    private $conn;
    private $table_user;
    private $table_project;

    public function __construct($db){
        $this->conn=$db;
        $this->table_user='users';
        $this->table_project='projects';
    }

    public function create_user(){
        $table=$this->table_user;
        $connection=$this->conn;

        $name=htmlspecialchars(strip_tags(trim($this->name)));
        $email=htmlspecialchars(strip_tags(trim($this->email)));
        $password=htmlspecialchars(strip_tags(trim($this->password)));

        $sql="INSERT INTO $table (name, email, password, create_at) 
        VALUES (:name, :email, :password, now() )";
        $statement=$connection->prepare($sql);
        $statement->execute(array(':name'=>$name, ':email'=>$email, ':password'=>$password));
        if($statement->rowCount()==1){
            return true;
        }else{
            return false;
        }
    }

    public function duplicateEmail(){
        $table=$this->table_user;
        $connection=$this->conn;

        $email=htmlspecialchars(strip_tags($this->email));

        $sql="SELECT  COUNT(email) as isEmail FROM $table WHERE email='$email'";
        $statement=$connection->query($sql);
        if($statement){
            while($res=$statement->fetch()){
                $isEmail=$res['isEmail'];
                if($isEmail>0){
                    return false;
                }else{
                    return true;
                }
            }
        }else{
            return false;
        }
    }

    public function user_log(){
        $table=$this->table_user;
        $connection=$this->conn;
        
        $email=htmlspecialchars(strip_tags($this->email));
        $password=htmlspecialchars(strip_tags($this->password));

        $sql="SELECT * FROM $table WHERE email='$email'";
        $statement=$connection->query($sql);
        if($statement){
            if($statement->rowCount()>0){
                return $statement;
            }
        }else{
            return false;
        }
    }

    public function create_project(){
        $table=$this->table_project;
        $connection=$this->conn;

        $project_user_id=htmlspecialchars(($this->project_user_id));
        $project_name=htmlspecialchars(($this->project_name));
        $project_description=htmlspecialchars(($this->project_description)); 
        $project_status=htmlspecialchars(($this->project_status));

        $sql="INSERT INTO $table (user_id, name, description, status, create_at) 
        VALUES (:user_id, :name, :description, :status, now() )";
        $statement=$connection->prepare($sql);
        $statement->execute(array(":user_id"=>$project_user_id, ":name"=>$project_name, ":description"=>$project_description, ":status"=>$project_status));
        if($statement->rowCount()==1){
            return true;
        }else{
            return false;
        }
    }

    public function projects(){
        $table=$this->table_project;
        $connection=$this->conn;

        $sql="SELECT * FROM $table";
        $statement=$connection->query($sql);
        if($statement->rowCount()>0){
            return $statement;
        }else{
            return false;
        }
    }

    public function get_users_projects(){
        $table=$this->table_project;
        $connection=$this->conn;

        $id=htmlspecialchars(strip_tags($this->id));
        $sql="SELECT * FROM $table WHERE user_id=$id";
        $statement=$connection->query($sql);
        if($statement->rowCount()>0){
            return $statement;
        }else{
            return false;
        }
    }
}

// $db=new Db();
// $user=new User($db->connect());

// $user->name='kamal';
// $user->email='kamal@email.com';
// $user->password='12345';

// $user->email='teste@gmail.et';
// $user->create_user();
// $user->duplicateEmail();

// $user->email='kamal@gmail.ma';
// $user->password='$2y$10$0rcNCuFf9s8iWo0Rg8o6COV9YMCI4XZOAeiYjB2M4YIOqBTuHnCH6';
// $user->user_log();


