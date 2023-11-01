<?php

include_once '../../config/db.php';
include_once '../../classes/user.php';
include_once '../../classes/handling_errors.php';

header("Access-Control-Allow-Origin:*");
header("Content-Type:application/json; charset=utf-8");
header("Access-Control-Allow-Methods:POST");

$db=new Db();
$user=new User($db->connect());


if($_SERVER['REQUEST_METHOD']==='GET'){
    $data=$user->projects();
    while($res=$data->fetch()){
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
    new HandleError(500,0,"Unauthorized access!");
}