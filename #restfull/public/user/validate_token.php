<?php

// include JWT to api
require '../../vendor/autoload.php';
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

include_once '../../config/db.php';
include_once '../../classes/user.php';
include_once '../../classes/handling_errors.php';

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: POST");
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization');


$db=new Db();
$user=new User($db->connect());


if($_SERVER['REQUEST_METHOD']==='POST'){
    // $data=json_decode(file_get_contents('php://input'));

    // get token data using headers
    $all_headers=getallheaders();
    $data=$all_headers['Authorization'];

    if(!empty($data)){
        try {
            $secret_key="utf127";
            $jwt_decode=JWT::decode($data, new Key($secret_key, 'HS256'));
            $user_data=$jwt_decode->data;

            http_response_code(200);
            echo json_encode(array(
                "status"=>1,
                "message"=>"jwt token gated",
                "user_data"=>$user_data->id
            ));

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(array(
                "status"=>0,
                "message"=> $e->getMessage()
            ));
        }
    }else{
        new HandleError(404,0,"All fields required");
    }
}else{
    new HandleError(500,0,"Unautorized access!");
}