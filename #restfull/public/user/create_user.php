<?php

include_once '../../config/db.php';
include_once '../../classes/user.php';
include_once '../../classes/handling_errors.php';

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json; charset=utf-8");
header("Access-Control-Allow-Methods:POST");

$db=new Db();
$user=new User($db->connect());

if($_SERVER['REQUEST_METHOD']==='POST'){
    $data=json_decode(file_get_contents('php://input'));

    if(!empty($data->name) and !empty($data->email) and !empty($data->password)){
        // verify email form
        if (filter_var($data->email, FILTER_VALIDATE_EMAIL)){
            // verify password length
            if(strlen($data->password)>=8){
                $user->name=$data->name;
                $user->email=$data->email;
                $user->password=password_hash($data->password, PASSWORD_DEFAULT);
                // calling data->email comig from body request should be befor 
                // the function duplicateEmail to check the email 
                if($user->duplicateEmail()){
                    if($user->create_user()){
                        http_response_code(200);
                        echo json_encode(array(
                            "status"=>1,
                            "message"=>"User created successfully"
                        ));
                    }else{
                        new HandleError(400,0,"Failed to create user!");
                    }
                }else{
                    new HandleError(400,0,"Email already taken try a new one!");
                }
            }else{
                new HandleError(400,0,"Password must have 8 chars at least!");
            }
        }
        else{
           new HandleError(403,0,"Invalid email form!");
        }
    }else{
        new HandleError(400,0,"All fields required!");
    }
}else{
    http_response_code(500);
    echo json_encode(array(
        "status"=>0,
        "message"=>"Unautorized access!"
    ));
}
