<?php
include '../api/database.php';
include '../class/Client.php';
include '../class/Freelancer.php';

$database = new Database();
$conn = $database->getConnection();

$client = new Client($conn);
$freelancer = new Freelancer($conn);

session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Try logging in as client
    $clientUser = $client->login($email, $password);
    if ($clientUser) {
        $_SESSION['user'] = $clientUser;
        $_SESSION['type'] = 'client';
        header("Location: ../client/client-explore.php");
        exit;
    }

    // Try logging in as freelancer
    $freelancerUser = $freelancer->login($email, $password);
    if ($freelancerUser) {
        $_SESSION['user'] = $freelancerUser;
        $_SESSION['type'] = 'freelancer';
        header("Location: ../freelancer/freelancers_dashboard.html");
        exit;
    }

    // If both fail
    echo "<script>alert('Invalid credentials'); window.location.href='Home.php';</script>";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../style/login.css">
    <title>Sign Up Page</title>
</head>

<body>
    <div class="splitscreen">
        <div class="welcome">
            <h1><span>WELCOME</span> to</h1>
            <div class="TF">TASKFLOW</div>
            <div class="overlay"></div>
        </div>

        <div class="signup">
            <h2>Log In</h2>
            <form class="form" action="UserLogIn.php" method="POST">
                <input type="text" name="email" placeholder="Username or Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="forgot-password">Forgot password?</div>
                <button type="submit" name="submit">Log in</button>
            </form>
            <div class="login">New here? <a href="../signup/SignupAS.php">Sign Up</a></div>
        </div>
    </div>
</body>
</html>