<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: POST');


include_once '../config/db.php';
include_once '../classes/student.php'; 

// create db obj for connection from db class 
$db=new Db();
$connection=$db->connect();

// create sudent obj from Student class
$student=new Student($connection);

if($_SERVER['REQUEST_METHOD']==='POST'){
    // get data from body of requested params
    $param=json_decode(file_get_contents('php://input'));

    if(!empty($param->id)){

        $student->id=$param->id;
        $student_data=$student->get_student();
        if($student_data->rowCount()>0){
            $response=[];
            while($res=$student_data->fetch()){
                // echo "s_id: ".$res['id']." "." s_name: ".$res['name'];
                // print_r($res);
                array_push($response,[
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
                    "message"=>$response
                ));
            }
        }else{
            http_response_code(400);
            echo json_encode([
                "status"=>0,
                "message"=>"Student not found!"
            ]);
        }
    }else{
        http_response_code(400);
        echo json_encode(array(
            "status"=>0,
            "message"=>"invalid query or not exist!"
        ));
    }
   
}else{
    http_response_code(503);
    echo json_encode(array(
        "status"=>0,
        "message"=>'access Unautorized check if changed request Method!'
    ));
}