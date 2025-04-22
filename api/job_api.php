<?php
session_start();
include('../api/database.php');
include('../class/Job.php');

// Create database connection and Work object
$database = new Database();
$db = $database->getConnection();
$job = new Job($db);

// Handle POST request (job submission)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ensure user is logged in
    if (!isset($_SESSION['user_id'])) {
        echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
        exit;
    }
    
    $client_id = $_SESSION['user_id'];
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? ''; // Added missing email variable
    $project_name = $_POST['business_name'] ?? '';
    $category = $_POST['category'] ?? '';
    $description = $_POST['description'] ?? '';
    $location = $_POST['location'] ?? '';
    $budget = $_POST['budget'] ?? '';
    $start_date = $_POST['start_date'] ?? ''; // Added missing start_date
    $end_date = $_POST['end_date'] ?? ''; // Added missing end_date
    
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
        exit;
    } else {
        echo '<script>
            alert("Failed to post job.");
            window.history.back(); // Or redirect to another error page
        </script>';
        exit;
    }
    
}
// Handle GET request (fetching jobs)
else if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Get all jobs, no need to restrict by user_id for public job listings
    $jobs = $job->getAllJobs(); // Changed to get all jobs
    
    if ($jobs) {
        // Return jobs as JSON
        header('Content-Type: application/json');
        echo json_encode(['status' => 'success', 'jobs' => $jobs]);
    } else {
        echo json_encode([]);
    }
    exit;
}
else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
    exit;
}

?>