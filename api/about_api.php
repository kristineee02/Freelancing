<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "database.php";
include "../class/About.php";

session_start();
$database = new Database();
$db = $database->getConnection();

$about = new About($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        if(isset($_GET["userId"])){
            $aboutData = $about->getAboutById($_GET["userId"]);
            echo json_encode(["status" => "success", "aboutData" => $aboutData]);
            break;
        }else{
            $abouts = $about->getAllAbout();
            echo json_encode(["status" => "success", "abouts" => $abouts]);
            break;
        }
        break;

    case 'POST':
        $postData = file_get_contents("php://input");
        $data = json_decode($postData, true);

        $about->updateAbout($data["id"], $data["contact"], $data["profession"], $data["skills"], $data["history"], $data["socials"]);
        echo json_encode(["status" => "success"]);
        break;

    default:
        echo json_encode(["status" => "error", "message" => "Invalid request method"]);
        break;
}
?>