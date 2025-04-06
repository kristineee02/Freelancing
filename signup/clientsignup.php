<?php
    include "../api/database.php";
    include '../class/Client.php';
    $database = new Database();
    $conn = $database->getConnection();

    $client = new Client($conn);

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])){
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $client->addClient($firstName, $lastName, $email, $password);
        header("Location: ../login/ClientLogin.php");
    }
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>

    <style>
        *{
            box-sizing: border-box;
        }
    body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
        }
    .splitscreen {
            display: flex;
            height: 100vh;
            width: 100%;
        }
    .welcome {
            color: white;
            width: 60%;
            background-image: url('../image/SignUpAs.jpg'); 
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
            text-align: center;
        }
    .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(147, 136, 136, 0.5);
            z-index: 1;
        }
    .welcome h1 {
            font-family: 'Instrument', sans-serif;
            font-style: italic;
            font-weight: lighter;
            z-index: 2;
            margin-bottom: 0;
        }
    .welcome span {
            font-weight: 500;
            font-size: 40px;
        }
    .TF {
            color: black;
            font-weight: 500;
            font-size: 50px;
            background-color: #FFE295;
            padding-left: 10px;
            padding-right: 10px;
            margin-top: 0;
            z-index: 2;
        }
    .signup {
            width: 40%;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    .signup h2 {
            font-size: 40px;
            font-weight: 500;
            text-align: center;
            width: 80%;
            padding-bottom: 50px;
            padding-left: 10px;
        }
    .form {
            width: 80%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    .name {
            display: flex;
            gap: 10px;
            width: 100%;
        }
    .name input {
            width: 50%;
        }
    .form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
    .form button {
            width: 80%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin: 10px 0;
            background-color: #FFE295;
            cursor: pointer;
    }
    .login {
            text-align: center;
            font-size: 12px;
    }
    </style>

</head>

<body>
    <div class="splitscreen">
        <div class="welcome">
            <h1><span>WELCOME</span> to</h1>
            <div class="TF">TASKFLOW</div>
            <div class="overlay"></div>
        </div>

        <div class="signup">
            <h2>Client - Sign up</h2>
            <form class="form" method="POST" action="clientsignup.php">
                <div class="name">
                    <input type="text" name="firstName" placeholder="First Name" required>
                    <input type="text" name="lastName" placeholder="Last Name" required>
                </div>
                <input type="email" name="email" placeholder="Email Address" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name = "submit">Create Account</button>
            </form>
            <div class="login">Already have an account? <a href="../login/ClientLogin.php">Log In</a></div>
        </div>
    </div>

</body>

</html>