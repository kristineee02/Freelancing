<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support</title>
    <link rel ="stylesheet" href="../style/HomeStyles.css">
</head>

<body>

    <div class="overlay"></div> 

    <nav>  
        <div class="TF2">TASKFLOW</div>
        <div class="navs">
        <ul>
            <li><a href="Home.php">Home</a></li>
            <li><a href="AboutUs.php">About Us</a></li>
            <li><a href="Support.php" class="active-dash">Support</a></li>
        </ul>
        <a href="../login/UserLogIn.php" class="login-btn">Log in</a>
        </div>
    </nav>
    
    <section class="faq-section">
        <div class="container">
            <h2>FAQ</h2>
            <div class="FAQ">
                <div class="faq-container">
                    <div class="faq-item">
                        <div class="faq-question">What is this platform?</div>
                        <div class="faq-answer">
                            <p>This is a freelancing marketplace where clients can hire talented freelancers for various services like writing, design, programming, marketing, and more.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">Is it free to join?</div>
                        <div class="faq-answer">
                            <p>Yes! Signing up as a freelancer or a client is completely free. You don't need to worry about free trial or payment.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">How do I find jobs?</div>
                        <div class="faq-answer">
                            <p>You can browse open projects on the “Find Jobs page and submit proposals to jobs that match your skills.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">How do I hire a freelancer?</div>
                        <div class="faq-answer">
                            <p>You can either invite freelancers to your job post or browse profiles and send offers directly.</p>
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question">How do I post a job?</div>
                        <div class="faq-answer">
                            <p>Simply click "Post a Job" on your dashboard, provide the project details, budget, and required skills, then publish it.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        const faqItems = document.querySelectorAll(".faq-item");

        faqItems.forEach(item => {
            const question = item.querySelector(".faq-question");

            question.addEventListener("click", () => {
                faqItems.forEach(i => {
                    if (i !== item) {
                        i.classList.remove("active");
                    }
                });

                item.classList.toggle("active");
            });
        });
    });
</script>

   
</body>
</html>