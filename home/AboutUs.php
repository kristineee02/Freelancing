<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title> 

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Montserrat', sans-serif;
            height: 100vh; 
            overflow: hidden;
        }
        
        nav {
            background-color: white;
            padding: 15px 30px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            justify-content: space-between;
            align-items: center; 
            z-index: 2; 
        }
                    
        .TF2 {
            font-size: 26px;
            font-weight: 600;
            padding-left: 80px;
        }
                        
        .navs {
            display: flex;
            align-items: center;
            gap: 20px;
            padding-right: 80px;
        }
        
        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }
                        
        nav ul li {
            margin: 0;
        }
                        
        nav ul li a {
            text-decoration: none;
            color: black;
            font-size: 16px;
        }
                        
        nav ul li a:hover {
            text-decoration: underline;
        }
                        
        .login-btn {
            text-decoration: none;     
            padding: 10px;
            background-color: #FFE295;
            color: black;
            border: none;
            border-radius: 15px;
            font-size: 14px;
        }
        
        .hero {
            background-image: url('../image/corp.jpg');
            background-size: cover;
            height: 250px;
            display: block;
            object-fit: cover;
            border-radius: 80px;
        }
        
        .hero-container {
            width: 80%;
            margin: 0 auto; 
        }
        
        .content {
            text-align: justify;
            max-width: 1200px;
            margin: 0 auto;
        }
        .content h2 {
            text-align: center;
            margin: 50px;
        }
        .content p {
            line-height: 1.6;
            margin-bottom: 20px;
        }
        
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #FFE295;
            padding: 10px;
        }
        </style>
</head>

<body>
    <nav>
        <div class="TF2">TASKFLOW</div>
        <div class="navs">
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="AboutUs.php">About Us</a></li>
            <li><a href="Support.php">Support</a></li>
        </ul>
        <a href="../login/UserLogIn.php" class="login-btn">Log in</a>
    </div>
    </nav>
    
    <div class="hero-container">
        <div class="hero"></div>
    </div>

    <div class="content">
    <h2>ABOUT US</h2>
    <p>TaskFlow is an expression of our beliefs that we hold close to our hearts. It's one thing to simply provide a platform  where Employers and Freelancers can work together. It's another to do it in our own unique way.</p>
    <p>We strive to be the premier platform where professionals go to connect, collaborate, and get work done. We  believe that the best work is done in a flexible and secure environment. With transparency comes trust, and with a community that's built on meritocracy, people are eager to set aside differences in geography, politics and religion to share and profit from economic opportunities.</p>
    <p>Since 1998, we have been working tirelessly out of our offices in Pittsburgh, PA and Noida, India to turn these  aspirations into reality. We have developed a close bond with our users. As their needs have changed, we have evolved our platform to provide the tools and support they want. Our users teach us, we learn and we grow.  We invite you to become a part of our expanding community!</p>
    </div>

    <footer>
    </footer>

</body>

</html>
