<?php
session_start();
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type");

include 'database.php';
include '../class/Work.php';

$database = new Database();
$db = $database->getConnection();

if (!$db) {
    error_log("Database connection failed");
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database connection failed"]);
    exit;
}

$work = new Work($db);
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        $userId = $_SESSION['user_id'] ?? null;
        // Check if we're looking for a specific work or all works
        if (isset($_GET['id'])) {
            $work_data = $work->getWorkById($_GET['id']);
            if ($work_data) {
                echo json_encode(["status" => "success", "works" => [$work_data]]);
            } else {
                echo json_encode(["status" => "error", "message" => "Work not found"]);
            }
        } else {
                $works = $work->getAllWork($userId);
            }
            echo json_encode(["status" => "success", "works" => $works]);
        break;

    case "POST":
        $userId = $_SESSION['user_id'] ?? null;
        try {
            // Check if uploads directory exists, create if not
            $target_dir = "Uploads/";
            $full_target_dir = __DIR__ . "/" . $target_dir;
            
            if (!file_exists($full_target_dir)) {
                if (!mkdir($full_target_dir, 0777, true)) {
                    throw new Exception("Failed to create Uploads directory");
                }
            }

            $pictures = [];
            $errors = [];

            // Process uploaded files
            if (isset($_FILES['picture'])) {
                $file_count = count($_FILES['picture']['name']);
                
                for ($i = 0; $i < $file_count; $i++) {
                    // Check for errors in upload
                    if ($_FILES['picture']['error'][$i] !== UPLOAD_ERR_OK) {
                        $errors[] = "Error uploading file " . $_FILES['picture']['name'][$i];
                        continue;
                    }

                    // Validate file type
                    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
                    $max_size = 5 * 1024 * 1024; // 5MB
                    
                    $file_info = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($file_info, $_FILES['picture']['tmp_name'][$i]);
                    finfo_close($file_info);

                    if (!in_array($mime_type, $allowed_types)) {
                        $errors[] = "Invalid file type for " . $_FILES['picture']['name'][$i];
                        continue;
                    }

                    // Check file size
                    if ($_FILES['picture']['size'][$i] > $max_size) {
                        $errors[] = "File too large: " . $_FILES['picture']['name'][$i];
                        continue;
                    }

                    // Create unique filename
                    $extension = pathinfo($_FILES['picture']['name'][$i], PATHINFO_EXTENSION);
                    $filename = uniqid() . '.' . $extension;
                    $target_file = $full_target_dir . $filename;

                    // Move the uploaded file
                    if (!move_uploaded_file($_FILES['picture']['tmp_name'][$i], $target_file)) {
                        $errors[] = "Failed to move uploaded file " . $_FILES['picture']['name'][$i];
                        continue;
                    }

                    $pictures[] = $target_dir . $filename;
                }
            }

            // Check if we have at least one valid picture
            if (empty($pictures)) {
                error_log("No valid pictures uploaded");
                throw new Exception("At least one image is required");
            }

            // Get form data
            $title = $_POST['title'] ?? '';
            $description = $_POST['description'] ?? '';
            $category = $_POST['category'] ?? '';
            $freelancer_id = $_POST['freelancer_id'] ?? '';

            // Validate form data
            if (empty($title) || empty($category) || empty($freelancer_id)) {
                error_log("Missing required fields: title=$title, category=$category, freelancer_id=$freelancer_id");
                throw new Exception("Title, category, and freelancer ID are required");
            }

            // Join all picture paths with comma
            $picturePaths = implode(",", $pictures);
            
            // Add work to database
            $addWork = $work->addWork($freelancer_id, $picturePaths, $title, $description, $category);

            echo json_encode([
                "status" => "success",
                "message" => "Work added successfully",
                "pictures" => $pictures
            ]);

        } catch (Exception $e) {
            error_log("POST error: " . $e->getMessage());
            http_response_code(400);
            echo json_encode([
                "status" => "error",
                "message" => $e->getMessage()
            ]);
        }
        break;

    default:
        error_log("Invalid method: $method");
        http_response_code(405);
        echo json_encode(["status" => "error", "message" => "Method not allowed"]);
        break;
}
?>