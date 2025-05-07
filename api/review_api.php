<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "database.php";
include "../class/Review.php";

session_start();
$database = new Database();
$db = $database->getConnection();

$review = new Review($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        if(isset($_GET["workId"])){
            $reviews = $review->getReviewById($_GET["workId"]);
            echo json_encode(["status" => "success", "reviews" => $reviews]);
            break;
        }
    case 'POST':
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        $review->addReview($data["clientId"], $data["workId"], $data["comment"]);
        echo json_encode(["status" => "success"]);
        break;
}
?>