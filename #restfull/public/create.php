<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');


include_once '../config/db.php';
include_once '../classes/student.php'; 

// create db obj for connection from db class 
$db=new Db();
// $connection=$db->connect();

// create sudent obj from Student class
$student=new Student($db->connect());

if($_SERVER['REQUEST_METHOD']==='POST'){
    // get data from body section of requested params
    $data=json_decode(file_get_contents("php://input"));
    
    if(!empty($data->name) && !empty($data->email) && !empty($data->mobile)){
        // submit data
        $student->name=$data->name;
        $student->email=$data->email;
        $student->mobile=$data->mobile;

        if($student->create_student()){
            http_response_code(200);
            echo json_encode(array(
                "status"=>1,
                "message"=> "Student created"
            ));
        }else{
            http_response_code(500);
            echo json_encode(array(
                "status"=>0,
                "message"=> "Failed to create student"
            ));
        }
    }else{
        http_response_code(400);
        echo json_encode(array(
            "status"=>0,
            "message"=> "All fields required!"
        ));
    }
}else{
    http_response_code(503);
    echo json_encode(array(
        "status"=>0,
        "message"=> "access Unautorized check if changed request Method!"
    ));
}

 