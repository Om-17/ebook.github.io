<?php 

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');


$request_method =$_SERVER["REQUEST_METHOD"];
if($request_method == 'POST'){
    $inputdata = json_decode(file_get_contents("php://input"),true);
    session_start();
    $_SESSION["user"]= $inputdata;
    echo json_encode($inputdata);
    
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