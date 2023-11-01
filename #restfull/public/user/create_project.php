<?php

// include JWT to api
require '../../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

include_once '../../config/db.php';
include_once '../../classes/user.php';
include_once '../../classes/handling_errors.php';

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json; charset=utf-8");
header("Access-Control-Allow-Methods:POST");

$db=new Db();
$user=new User($db->connect());


if($_SERVER['REQUEST_METHOD']==='POST'){
    // body request
    $data=json_decode(file_get_contents('php://input'));

    // header request
    $headers=getallheaders();
    $data_id=$headers['Authorization'];

    if(!empty($data->name) and !empty($data->description) and !empty($data->status) and !empty($data_id)){
        try {
            $secret_key="utf127";
            $jwt_decode=JWT::decode($data_id, new Key($secret_key, 'HS256'));

            $user->project_user_id=$jwt_decode->data->id;
            $user->project_name=$data->name;
            $user->project_description=$data->description;
            $user->project_status=$data->status;

            if($user->project_status==='pending' or $user->project_status==='ongoing' or $user->project_status==='hold' or $user->project_status==='completed'){

                if($user->create_project()){
                    new HandleError(200,1,"Project created");
                }else{
                    new HandleError(404,0,"Failed to create project!");
                }
            }else{
                new HandleError(404,0,"status must be one of those values: 'pending', 'ongoing', 'hold', 'completed' !");
            }
            
    
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array(
                "status"=>0,
                "message"=> $e->getMessage()
            ));
        }

    }else{
        new HandleError(404,0,"All fields required!");
    }
}else{
    new HandleError(500,0,"Unauthorized access!");
}