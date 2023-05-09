<?php
include_once('../models/models.php');

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token , Authorization');


$request_method = $_SERVER["REQUEST_METHOD"];
if ($request_method == 'POST') {
    $user = new User();
    $inputdata = json_decode(file_get_contents("php://input"), true);

    if (
        !isset($inputdata['username']) && !isset($inputdata['password']) && !isset($inputdata['email']) && !isset($inputdata['first_name'])
        && !isset($inputdata['last_name'])
    ) {
        $data = [
            "error" => 'All fields is required',
        ];
        http_response_code(400);

        echo json_encode($data);

    } elseif (empty($inputdata['first_name'])) {
        $data = [
            "error" => 'first name is blank',
        ];
        http_response_code(400);

        echo json_encode($data);
    } elseif (empty($inputdata['last_name'])) {
        $data = [
            "error" => 'last name is blank',
        ];
        http_response_code(400);

        echo json_encode($data);
    } elseif (empty($inputdata['username'])) {
        $data = [
            "error" => 'Username is blank',
        ];
        http_response_code(400);

        echo json_encode($data);
    } elseif (empty($inputdata['email'])) {
        $data = [
            "error" => 'email is blank',
        ];
        http_response_code(400);

        echo json_encode($data);
    } elseif (empty($inputdata['password'])) {
        $data = [
            "error" => ' Password is blank',
        ];
        http_response_code(400);

        echo json_encode($data);
    } else {
        $username = $inputdata['username'];
        $password = $inputdata['password'];
        $email = $inputdata['email'];
        $firstname = $inputdata['first_name'];
        $lastname = $inputdata['last_name'];
        $user->first_name = $firstname;
        $user->last_name = $lastname;
        $user->email = $email;
        $user->username = $username;
        $user->password = $password;
        $result = $user->create();

        if ($result["error"]) {
            http_response_code(400);
            echo json_encode($result);

        } else {
            echo json_encode($result);

        }
    }

}


?>