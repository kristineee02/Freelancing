<?php
session_start();
header('Content-Type: application/json');

// Connect to database
$db = new PDO("mysql:host=localhost;dbname=freelancer_signup", "root", "");

// Get filter parameters
$filter = $_GET['filter'] ?? '';
$category = $_GET['category'] ?? '';
$search = $_GET['search'] ?? '';

// Build the query based on filters
$sql = "
    SELECT w.*, f.firstname, f.lastname
    FROM work w
    JOIN freelancer f ON w.freelancer_id = f.account_id
    WHERE 1=1
";

$params = [];

// Add category filter if specified
if (!empty($category)) {
    $sql .= " AND w.category = :category";
    $params[':category'] = $category;
}

// Add search filter if specified
if (!empty($search)) {
    $sql .= " AND (w.title LIKE :search OR w.description LIKE :search OR 
              f.firstname LIKE :search OR f.lastname LIKE :search)";
    $params[':search'] = '%' . $search . '%';
}

// Add sorting based on filter selection
if ($filter === 'new') {
    $sql .= " ORDER BY w.work_id DESC"; // Assuming higher IDs are newer
} elseif ($filter === 'a-z') {
    $sql .= " ORDER BY w.title ASC";
} else {
    $sql .= " ORDER BY w.work_id DESC"; // Default sort by newest
}

$stmt = $db->prepare($sql);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->execute();
$works = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($works);