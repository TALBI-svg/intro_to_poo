<?php

// include JWT to api
require '../../vendor/autoload.php';
use \Firebase\JWT\JWT;

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

    if(!empty($data->email) and !empty($data->password)){
        $user->email=$data->email;
        $user->password=$data->password;
        
        $statement=$user->user_log();
        if($statement){
            while($res=$statement->fetch()){
                $email=$res['email'];
                $password=$res['password'];

                if(password_verify($user->password, $password)){

                    // create jwt token to pass user inside
                    $issued="localhost";
                    $issued_at=time();
                    $not_before=$issued_at+10;
                    $expiration=$issued_at+60;
                    $audiance="my_users";
                    $user_data_arr=array(
                        "id"=>$res['id'],
                        "name"=>$res['name'],
                        "email"=>$res['email'],
                    );

                    $secret_key="utf127";
                    
                    $payload_info=array(
                        "issued"=>$issued,
                        "issued_at"=>$issued_at,
                        "not_before"=>$not_before,
                        "expiration"=>$expiration,
                        "audiance"=>$audiance,
                        "user_data"=>$user_data_arr,
                    );
                    $jwt=JWT::encode($payload_info, $secret_key, 'HS256');

                    http_response_code(200);
                    echo json_encode(array(
                        "status"=>1,
                        "jwt"=>$jwt,
                        "message"=>"User logged in..."
                    ));
                    // new HandleError(200,1,"User logged in...");


                }else{
                    new HandleError(400,0,"Invalid password!");
                }
            }
        }else{
            new HandleError(404,0,"Invalid email address!");
        }

    }else{
        new HandleError(400,0,"All fileds are required!");
    }
}else{
    new HandleError(500,0,"UNautorized access!");
}