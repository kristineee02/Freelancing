<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include "database.php";
include "../class/Client.php";

session_start();
$database = new Database();
$db = $database->getConnection();

$client = new Client($db);

$method = $_SERVER["REQUEST_METHOD"];

switch ($method) {
    case 'GET':
        if (isset($_GET["userId"])) {
            $clientData = $client->getClientById($_GET["userId"]);
            echo json_encode(["status" => "success", "clientData" => $clientData]);
        } else {
            $clients = $client->getClient();
            echo json_encode(["status" => "success", "clients" => $clients]);
        }
        break;
    case 'POST':
        if (!isset($_SESSION['userId'])) {
            echo json_encode(["status" => "error", "message" => "User not authenticated"]);
            exit;
        }

        if (isset($_POST['firstName'], $_POST['lastName'], $_POST['address'])) {
            $userId = $_SESSION['userId'];
            $firstName = $_POST['firstName'];
            $lastName = $_POST['lastName'];
            $address = $_POST['address'];
            $profilePic = null;

            if (isset($_FILES['profilePic']) && $_FILES['profilePic']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '../Uploads/';
                $fileName = uniqid() . '-' . basename($_FILES['profilePic']['name']);
                $uploadPath = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadPath)) {
                    $profilePic = $fileName;
                } else {
                    echo json_encode(["status" => "error", "message" => "Failed to upload profile picture"]);
                    exit;
                }
            }

            try {
                $client->updateClient($userId, $firstName, $lastName, $address, $profilePic);
                echo json_encode(["status" => "success", "message" => "Client updated successfully"]);
            } catch (Exception $e) {
                echo json_encode(["status" => "error", "message" => "Update failed: " . $e->getMessage()]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Missing required fields"]);
        }
        break;
}
?>