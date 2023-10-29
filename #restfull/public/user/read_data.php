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


$db=new Db();
$user=new User($db->connect());


if($_SERVER['REQUEST_METHOD']==='POST'){
    $data=json_decode(file_get_contents('php://input'));

    if(!empty($data->jwt)){
        try {
            $secret_key="utf127";
            $jwt_decode=JWT::decode($data->jwt, new Key($secret_key, 'HS256'));
    
            // $user_id=$jwt_decode->user_data->id;
            http_response_code(200);
            echo json_encode(array(
                "status"=>1,
                "message"=>"get jwt token",
                "user_data"=>$jwt_decode
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