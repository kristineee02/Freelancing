<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "database.php";
include "../class/Buy.php";

session_start();
$database = new Database();
$db = $database->getConnection();

$buy = new Buy($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        $buys = $buy->getBuy($_GET["freelancerId"]);
        echo json_encode(["status" => "success", "buys" => $buys]);
        break;
    case 'POST':
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        $buy->addBuy($data["clientId"], $data["workId"], $data["freelancerId"],  $data["projectDetails"], $data["targetDate"], $data["projectBudget"]);
        echo json_encode(["status" => "success"]);
        break;
    case 'DELETE':
        $delData = file_get_contents("php://input");
        $data = json_decode($delData, true);

        $buy->deleteBuy($data["buyId"]);
        echo json_encode(["status" => "success"]);
        break;
}
?>