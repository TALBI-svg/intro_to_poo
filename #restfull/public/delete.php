<?php
// include class and connection files
include_once '../config/db.php';
include_once '../classes/student.php';
include_once '../classes/handling_errors.php';

// set cross origin headers
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Methods: GET");


// create needed objs
$db=new Db();
$connection=$db->connect();

$student=new Student($connection); 


// check request method type
if($_SERVER['REQUEST_METHOD']==='GET'){

    $id=isset($_GET['id']) ? $_GET['id'] : ""; 
    
    if(!empty($id)){
        // define id specefying to delete 
        $student->id=$id;
        if($student->delete_student()){
            // http_response_code(200);
            // echo json_encode(array(
            //     "status"=>1,
            //     "message"=>"Student deleted successfully"
            // ));
            new HandleError(200,1,"Student deleted successfully");
        }else{
            // http_response_code(400);
            // echo json_encode(array(
            //     "status"=>0,
            //     "message"=>"delete failed invalid query or student not found!"
            // ));
            new HandleError(400,0,"Delete failed!");
        }
    }else{
        new HandleError(400,0,"Field required!");
    }
}else{
    new HandleError(500,0,"Unautorized access check if changed rm!");
}








// ---------------------------------
// ---- delete using post ----------
// ---------------------------------
 // set cross origin headers
 // header("Access-Control-Allow-Origin:*");
 // header("Content-Type: application/json; charset=utf-8");
 // header("Access-Control-Allow-Methods: POST");
 
 // // create needed objs
 // $db=new Db();
 // $connection=$db->connect();
 // $student=new Student($connection);
 
 // // check request method type
 // if($_SERVER['REQUEST_METHOD']==='POST'){
 //     $data=json_decode(file_get_contents('php://input'));
 //     $id=$data->id;
 
 //     // $id=isset($_GET['id']) ? $_GET['id'] : ""; 
 //     if(!empty($id)){
 
 //         // define id specefying to delete 
 //         $student->id=$id;
 //         if($student->delete_student()){
 //             // http_response_code(200);
 //             // echo json_encode(array(
 //             //     "status"=>1,
 //             //     "message"=>"Student deleted successfully"
 //             // ));
 //             new HandleError(200,1,"Student deleted successfully");
 //         }else{
 //             // http_response_code(400);
 //             // echo json_encode(array(
 //             //     "status"=>0,
 //             //     "message"=>"delete failed invalid query or student not found!"
 //             // ));
 //             new HandleError(400,0,"Delete failed!");
 //         }
 //     }else{
 //         new HandleError(400,0,"Field required!");
 //     }
 // }else{
 //     new HandleError(500,0,"Unautorized access check if changed rm!");
// }