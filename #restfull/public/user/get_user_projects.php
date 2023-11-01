<?php

// error_reporting(E_ALL);
// include JWT to api
require '../../vendor/autoload.php';
use \Firebase\JWT\JWT;
// use \Firebase\JWT\Key;

include_once '../../config/db.php';
include_once '../../classes/user.php';
include_once '../../classes/handling_errors.php';

header("Access-Control-Allow-Origin: *");
// header("Content-Type: application/json; charset=utf-8");
header("Access-Control-Allow-Methods: GET");


$db=new Db();
$user=new User($db->connect());

if($_SERVER['REQUEST_METHOD']==='GET'){
    // $data=json_decode(file_get_contents('php://input'));
    // $data=getallheaders();
    // $data_id=$data['Authorization'];
    $user_id=$_GET['id'] ? $_GET['id'] : '';
    if(!empty($user_id)){

        // try {
        //     $secret_key="utf127";
        //     $jwt_decode=JWT::decode($data_id,new key($secret_key, 'HS256'));
        // } catch (Exception $ex) {
        //     new HandleError(404,0,$ex->getMessage());
        // }

        $user->id=$user_id;
        $statement=$user->get_users_projects();
        if($statement){
            while($res=$statement->fetch()){
                $id=$res['id'];
                $name=$res['name'];
                $project_owner_id=$res['user_id'];
                $description=$res['description'];
                $status=$res['status'];
                $create_at=date('Y-m-d', strtotime($res['create_at']));

                $projects['projects']=array();
                array_push($projects,[
                    "id"=>$id,
                    "name"=>$name,
                    "project_owner_id"=>$project_owner_id,
                    "description"=>$description,
                    "status"=>$status,
                    "create_at"=>$create_at
                ]);

                new HandleError(200,1,$projects);
            }
        }else{
            new HandleError(404,0,"Failed to get projects for this user!");
        }
        
    }else{
        new HandleError(404,0,"All fields required!");
    }

}else{
    new HandleError(500,0,"UNauthorized access!");
}