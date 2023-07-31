<?php 
session_start();
include_once('../classes/DBclass.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');
$REQUEST = json_decode(file_get_contents("php://input"),true);

if(isset($REQUEST['book_id'])){
    // http_response_code(400);
    $book_id=$REQUEST['book_id'];
    
    if ($_SESSION['user']['id']){
        $user_id=$_SESSION['user']['id'];
        $mybookObj = new DBclass('mybooks');
        $delete_remove=$mybookObj->adelete(["book_id"=>$book_id,"user_id"=>$user_id]);
   

        if($delete_remove['status']){
            $removeresult=$delete_remove;
            http_response_code(200);
        

        }
        else{
            http_response_code(400);

            $removeresult=["message"=>"something went wrong please try again"];

        }
    }
    else{
            http_response_code(400);
            $removeresult=["message"=>"something went wrong please try again"];
        }

    echo json_encode($removeresult);
        
   
}
$mybookObj=null;








?>