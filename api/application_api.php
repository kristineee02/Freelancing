<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "database.php";
include "../class/Application.php";

session_start();
$database = new Database();
$db = $database->getConnection();

$application = new Application($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        if(isset($_GET["jobId"])){
            $applicationData = $application->getApplicationById($_GET["jobId"]);
            echo json_encode(["status" => "success", "applicationData" => $applicationData]);
            break;
        }
    case 'POST':
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        $application->addApplication($data["jobId"], $data["name"], $data["email"], $data["contact"], $data["address"]);
        echo json_encode(["status" => "success"]);
        break;
    case 'DELETE':
        $delData = file_get_contents("php://input");
        $data = json_decode($delData, true);

        $application->deleteApplication($data["applicationId"]);
        echo json_encode(["status" => "success"]);
        break;
}
?>