<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "database.php";
include "../class/Job.php";

session_start();
$database = new Database();
$db = $database->getConnection();

$job = new Job($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        if (isset($_GET["clientId"]) && isset($_GET["jobId"])){
            $jobData = $job->getJobByClientandJob($_GET['clientId'], $_GET["jobId"]);
            echo json_encode(["status" => "success", "jobData" => $jobData]);
            break;
        }else if(isset($_GET["clientId"])){
            $jobData = $job->getJobByClient($_GET['clientId']);
            echo json_encode(["status" => "success", "jobData" => $jobData]);
            break;
        }else if(isset($_GET["jobId"])){
            $jobData = $job->getJobById($_GET['jobId']);
            echo json_encode(["status" => "success", "jobData" => $jobData]);
            break;
        }else {
            $jobs = $job->getAllJob();
            echo json_encode(["status" => "success", "jobs" => $jobs]);
            break;
        }
        break;
    case 'POST':
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        $job->addJob($data["clientId"], $data["projectTitle"], $data["projectCategory"], $data["description"], $data["startDate"], $data["endDate"], $data["budget"], $data["location"], $data["education"], $data["experience"], $data["aboutUs"], $data["role"], $data["tasks"], $data["benefits"], $data["requirements"]);
        echo json_encode(["status" => "success"]);
        break;
}
?>