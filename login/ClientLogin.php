<?php
include '../api/database.php';
include '../class/Client.php';

$database = new Database();
$conn = $database->getConnection();

$client = new Client($conn);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    $client->login($Email, $Password);
    header("Location: ../client/client-explore.php");
    exit;
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
            <h2>Client Log In</h2>
            <form class="form" action="ClientLogIn.php" method="POST">
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