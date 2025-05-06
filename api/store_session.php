<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET");
header("Access-Control-Allow-Headers: Content-Type");

session_start();

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        if (isset($_SESSION["userId"])) {
            echo json_encode([
                "status" => "success", 
                "message" => "Session data stored", 
                "userId" => $_SESSION["userId"]
            ]);
        } else {
            echo json_encode([
                "status" => "error", 
                "message" => "No active session"
            ]);
        }
        break;
        
    case 'POST':
        try {
            $postData = file_get_contents("php://input");
            $data = json_decode($postData, true);
        
            if (!isset($data["email"]) || !isset($data["password"])) {
                echo json_encode(["status" => "error", "message" => "Missing email or password"]);
                exit;
            }
        
            $_SESSION["userEmail"] = $data["email"];
            $_SESSION["userId"] = isset($data["freelancer_id"]) ? $data["freelancer_id"] : $data["client_id"];
            
            echo json_encode([
                "status" => "success", 
                "message" => "Session created successfully"
            ]);
        } catch (Exception $e) {
            echo json_encode([
                "status" => "error", 
                "message" => "Server error: " . $e->getMessage()
            ]);
        }
        break;
        
    default:
        echo json_encode([
            "status" => "error", 
            "message" => "Method not allowed"
        ]);
        break;
}
?>