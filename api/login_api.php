<?php

    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Freelancer.php";
    include "../class/Client.php";
    $database = new Database();
    $db = $database->getConnection();

    $freelancer = new Freelancer($db);
    $client = new Client($db);
    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case "GET":
            $freelancers = $freelancer->getFreelancer();
            echo json_encode(["status" => "success", "freelancers" => $freelancers]);
            break;
        case "POST":
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);
        
            $email = $data["email"] ?? null;
            $password = $data["password"] ?? null;
        
            if ($email && $password) {
                if($freelancers = $freelancer->freelancerLogin($email, $password)){
                    echo json_encode(["status" => "success", "accountType" => "freelancer", "freelancers" => $freelancers]);
                }else if($clients = $client->clientLogin($email, $password)){
                    echo json_encode(["status" => "success", "accountType" => "client", "clients" => $clients]);
                }else{
                    echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
                }
            } else {
                echo json_encode(["status" => "error", "message" => "Missing email or password"]);
            }
            break;
            
            
            
    }
?>