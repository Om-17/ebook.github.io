<?php

include_once('../models/models.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');


$request_method =$_SERVER["REQUEST_METHOD"];
if($request_method == 'POST'){
    $user = new User();
   $inputdata = json_decode(file_get_contents("php://input"),true);
   
    if(!isset($inputdata['username'])||!isset($inputdata['password'])){
        $data=[
            "error"=>'Username and Password is required',
        ];
        http_response_code(400);
      
        echo json_encode($data);

    }
    elseif(empty($inputdata['username'])||empty($inputdata['password'])){
        $data=[
            "error"=>'Username and Password is blank',
        ];
        http_response_code(400);
      
        echo json_encode($data);

    }
    else{

        $username= $inputdata['username'];
        $password= $inputdata['password'];
        $result = $user->get("username", $username);
        if($result!=null){
            
            if (password_verify($password, $result['password'])) {
                session_start();
                $_SESSION["user"]=$result;
                
                $data["results"]=$result;
                http_response_code(200);

                echo json_encode($data);
             
            } else {
                http_response_code(400);
                $data=[
                    "error"=>'Invalid password.',
                ];
                echo json_encode($data);
            }
        }
        else{
            $data=[
                "error"=>'Login failed !!',
            ];
            http_response_code(400);
          
            echo json_encode($data);
        }
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