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
        .navs a.active-dash {
        border-bottom: 2px solid #333;
        font-weight: bold;
        color: #333;
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
            width: 90%;
            max-width: 1200px;
            margin: 40px auto 20px auto;
        }

        .content {
            max-width: 900px;
            margin: 0 auto 100px auto;
            padding: 0 20px;
            font-family: 'Montserrat', sans-serif;
            color: #333;
            line-height: 1.8;
            
        }

        .content h2 {
            text-align: center;
            font-size: 2rem;
            margin: 40px 0 25px;
            color: #222;
        }

        .content p {
            font-size: 1.05rem;
            margin-bottom: 20px;
            text-align: justify;
        }
        
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #FFE295;
            padding: 10px;
        }

    @media (max-width: 768px) {
      nav {
        flex-direction: column;
        align-items: flex-start;
        padding: 10px 20px;
      }

      .TF2 {
        padding-left: 0;
        margin-bottom: 10px;
      }

      .navs {
        padding-right: 0;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
      }

      nav ul {
        flex-direction: column;
        gap: 10px;
      }
    }
        </style>
</head>

<body>
    <nav>
        <div class="TF2">TASKFLOW</div>
        <div class="navs">
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="AboutUs.php" class="active-dash">About Us</a></li>
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
    <p>Welcome to TaskFlow, your gateway to flexible, reliable, and meaningful freelance work.</p>
    <p>At TaskFlow, we believe that talent knows no boundaries. We’re a dynamic freelancing platform built to connect skilled freelancers with clients who need results—fast, efficiently, and with quality at the core. Whether you're a creative, developer, writer, marketer, or business professional, TaskFlow provides the space and tools to turn your skills into thriving, independent careers.</p>
    </div>

    <footer>
    </footer>

</body>

</html>
