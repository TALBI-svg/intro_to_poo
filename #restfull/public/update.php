<?php
// set cros
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');


// include needed file 
include_once '../config/db.php';
include_once '../classes/student.php'; 


// create objects needed
$db=new Db();
$connection=$db->connect();
$student=new Student($connection);


// check request method
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    // get data from body request
    $data=json_decode(file_get_contents("php://input"));

    if(!empty($data->name) && !empty($data->email) && !empty($data->mobile) && !empty($data->status) && !empty($data->id)){
        $student->name=$data->name;
        $student->email=$data->email;
        $student->mobile=$data->mobile;
        $student->status=$data->status;
        $student->id=$data->id;

        if($student->update_seudent()){
            http_response_code(200);
            echo json_encode(array(
                "status"=>1,
                "message"=>"Student updated successfully"
            ));
        }else{
            http_response_code(400);
            echo json_encode(array(
                "status"=>0,
                "message"=>"Failed to update!"
            ));
        }
    }else{
        http_response_code(404);
        echo json_encode(array(
            "status"=>0,
            "message"=>"All fields required!"
        ));
    }
}else{
    http_response_code(500);
    echo json_encode(array(
        "status"=>0,
        "message"=>"Unautorized access check if changed request method!"
    ));
}