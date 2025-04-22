<?php
session_start();
include('../api/database.php');
include('../class/Job.php');

$database = new Database();
$db = $database->getConnection();
$job = new Job($db);

switch ($_SERVER["REQUEST_METHOD"]) {
    case "POST":
        // Ensure user is logged in
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
            exit;
        }

        $client_id = $_SESSION['user_id'];
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $project_name = $_POST['business_name'] ?? '';
        $category = $_POST['category'] ?? '';
        $description = $_POST['description'] ?? '';
        $location = $_POST['location'] ?? '';
        $budget = $_POST['budget'] ?? '';
        $start_date = $_POST['start_date'] ?? '';
        $end_date = $_POST['end_date'] ?? '';

        // Validate required fields
        if (empty($name) || empty($email) || empty($project_name) || empty($category) || empty($description)) {
            echo json_encode(['status' => 'error', 'message' => 'Missing required fields']);
            exit;
        }

        // Add job to database
        $result = $job->addJob(
            $client_id,
            $name,
            $email,
            $category,
            $description,
            $start_date,
            $end_date,
            $budget,
            $project_name,
            $location
        );

        if ($result) {
            echo '<script>
                alert("Job posted successfully!");
                window.location.href = "../client/client-profile.php";
            </script>';
        } else {
            echo '<script>
                alert("Failed to post job.");
                window.history.back();
            </script>';
        }
        exit;

    case "GET":
        // Get all jobs
        $jobs = $job->getAllJobs();

        if ($jobs) {
            // Return jobs as JSON
            header('Content-Type: application/json');
            echo json_encode(['status' => 'success', 'jobs' => $jobs]);
        } else {
            echo json_encode([]);
        }
        exit;

    default:
        echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        exit;
}
?>