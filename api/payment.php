<?php 
session_start();
include_once('../classes/DBclass.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');


$request_method =$_SERVER["REQUEST_METHOD"];
if($request_method == 'POST'){
   $inputdata = json_decode(file_get_contents("php://input"),true);
    $payment_id=$inputdata['payment_id'];
    $price=base64_decode($inputdata['price']);
    $duration=base64_decode($inputdata['duration']);
    $user_id=base64_decode($inputdata['user_id']);
   
     // Assuming the provided $duration is in months, calculate the expiry date.
     $startDate = date('Y-m-d'); // Today's date in the format 'YYYY-MM-DD'
     $expiryDate = date('Y-m-d', strtotime("+$duration months", strtotime($startDate)));
 
     // Now, you have $startDate and $expiryDate which you can use as needed.
    //  echo " Start Date: $startDate, Expiry Date: $expiryDate";
 
     if ($duration == "6"||$duration=="1") {
        
         $params = [
             'start_date' => $startDate,
             'expiry_date' => $expiryDate,
             'payment_id' => $payment_id,
             'price'=>$price,
             'month_duration' => $duration,
             'user_id' => $user_id,
             'status' => 'Active',
         ];
         $memberobj=new DBClass('member');
         $mresult=$memberobj->create($params);
         if ($mresult['status']==1){
             $userobj=new DBClass('users');
             $update_result=$userobj->update('id',$user_id,["is_member"=>true]);
             $_SESSION['user']['is_member']=true; 
               
         }
    http_response_code(200);
         
         echo json_encode($mresult);


     }
     else{
    http_response_code(400);
       
     }
}

else{
    $data=[
        "status"=>405,
        "message"=>$request_method. ' Method Not Allowed',
    ];
    http_response_code(405);

    echo json_encode($data);
}

?>