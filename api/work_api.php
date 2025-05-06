<?php

    session_start();
    header("Content-Type: application/json");
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");

    include "database.php";
    include "../class/Work.php";

    $database = new Database();
    $db = $database->getConnection();

    $work = new Work($db);

    $method = $_SERVER["REQUEST_METHOD"];

    switch ($method){
        case 'GET':
            if(isset($_GET["freelancerId"]) && isset($_GET["workId"])){
                $workId = (int) $_GET["workId"];
                $freelancerId = (int) $_GET["freelancerId"];
                $workData = $work->getWorkbyIdWork($workId, $freelancerId);
                echo json_encode(["status" => "success", "workData" => $workData]);
                break;
            }else if(isset($_GET["freelancerId"])){
                $freelancerId = (int) $_GET["freelancerId"];
                $workData = $work->getWorkbyId($freelancerId);
                echo json_encode(["status" => "success", "workData" => $workData]);
                break;
            }
            else{
                $works = $work->getAllWork();
                echo json_encode(["status" => "success", "works" => $works]);
                break;
            }
        case 'POST':
            if (!isset($_SESSION['userId'])) {
                echo json_encode(["status" => "error", "message" => "User not authenticated"]);
                exit;
            }
    
            if (isset($_POST['freelancerId'], $_POST['title'], $_POST['category'], $_POST['description'])) {
                $freelancerId = $_POST['freelancerId'];
                $title = $_POST['title'];
                $category = $_POST['category'];
                $description = $_POST['description'];
                $picture = null;
    
                if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
                    $uploadDir = '../Uploads/';
                    $fileName = uniqid() . '-' . basename($_FILES['picture']['name']);
                    $uploadPath = $uploadDir . $fileName;
    
                    if (move_uploaded_file($_FILES['picture']['tmp_name'], $uploadPath)) {
                        $picture = $fileName;
                    } else {
                        echo json_encode(["status" => "error", "message" => "Failed to upload profile picture"]);
                        exit;
                    }
                }
            }

            $work->addWork($freelancerId, $picture,  $title, $description, $category);
            echo json_encode(["status" => "success"]);
            break;
    }
?>