<?php 
session_start();
include_once('../classes/DBclass.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
$REQUEST = json_decode(file_get_contents("php://input"),true);

if(isset($REQUEST['status'])){
    // http_response_code(400);
    $book_id=$REQUEST['book_id'];
    $status=$REQUEST['status'];
    $mybookobj = new DBclass('mybooks');
    $exist= $mybookobj ->aexists(['book_id'=>$book_id,"user_id"=>$_SESSION['user']['id']]);
    
    if(!$exist){
        $mybookparam=[
            "book_id"=>$book_id,
            "status"=>$status,
            "user_id"=>$_SESSION['user']['id']
        ];
      $mybookresult = $mybookobj->create($mybookparam);
        echo json_encode($mybookresult);

    }
    else{
        $mybookparam=[
            "book_id"=>$book_id,
            "status"=>$status,
            "user_id"=>$_SESSION['user']['id']
        ];
      $mybookresult = $mybookobj->update('book_id',$book_id,$mybookparam);
      echo json_encode($mybookresult);
        
    }

}

$mybookobj=null;






?>