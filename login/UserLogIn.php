<?php
include '../api/database.php';
include '../class/Freelancer.php';

$database = new Database();
$conn = $database->getConnection();

$freelancer = new Freelancer($conn);

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['submit'])) {
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    $freelancer->login($email, $password);
    header("Location: ../freelancer/freelancers_dashboard.html");

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
            <h2>Freelancer Log In</h2>
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