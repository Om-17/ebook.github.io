<?php 
session_start();
include_once('../classes/masterclass.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
$REQUEST = json_decode(file_get_contents("php://input"),true);

if(isset($REQUEST['status'])){
    // http_response_code(400);
    $book_id=$REQUEST['book_id'];
    $status=$REQUEST['status'];
    $mybookobj = new MasterClass('mybooks');
    $exist= $mybookobj ->exists('book_id',$book_id);
    if($exist!=1){
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








?>