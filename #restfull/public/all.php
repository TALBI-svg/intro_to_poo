<?php
header('Access-Control-Allow-Origin: *');
// header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET');


include_once '../config/db.php';
include_once '../classes/student.php'; 

// create db obj for connection from db class 
$db=new Db();
$connection=$db->connect();

// create sudent obj from Student class
$student=new Student($connection);
if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $data=$student->get_students();
    if($data->rowCount()>0){
        // echo "ok";
        $student_arr=[];
        while($res=$data->fetch()){
            array_push($student_arr,[
                "id"=>$res["id"],
                "name"=>$res["name"],
                "email"=>$res["email"],
                "mobile"=>$res["mobile"],
                "status"=>$res["status"],
                "create_at"=>date("Y-m-d", strtotime($res["create_at"])),
            ]);
            http_response_code(200);
            echo json_encode(array(
                "status"=>1,
                "data"=>$student_arr
            ));
        }
    }else{
        // echo "err";
        http_response_code(400);
        echo json_encode(array(

            "status"=>0,
            "message"=> "invalid query or data not found!"
        ));
    }
}else{
    http_response_code(503);
    echo json_encode(array(
        "status"=>0,
        "message"=>"access Unautorized check if changed request Method!"
    ));
}