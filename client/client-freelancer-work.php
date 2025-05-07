<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Submission Form</title>
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Arial', sans-serif;
    }

    body {
        background-color: #f5f5f5;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
    }

    .form-container {
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 800px;
        position: relative;
    }

    .form-header {
        padding: 20px;
        border-bottom: 1px solid #eaeaea;
        position: relative;
    }

    .form-header h1 {
        text-align: center;
        color: #333;
        font-size: 24px;
        font-weight: 600;
    }

    .close-btn {
        position: absolute;
        top: 20px;
        left: 20px;
        background: none;
        border: none;
        font-size: 24px;
        color: #888;
        cursor: pointer;
        transition: color 0.2s;
    }

    .close-btn:hover {
        color: #333;
    }

    .form-section {
        padding: 20px;
        border-bottom: 1px solid #eaeaea;
    }

    .form-section h2 {
        margin-bottom: 20px;
        color: #444;
        font-size: 18px;
        font-weight: 500;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-row {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
    }

    .form-group.half {
        flex: 1;
    }

    label {
        display: block;
        margin-bottom: 6px;
        color: #555;
        font-size: 14px;
    }

    input[type="text"],
    input[type="number"],
    input[type="date"],
    textarea, select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.2s;
    }

    input:focus,
    textarea:focus {
        outline: none;
        border-color:rgb(226, 223, 74);
    }

    textarea {
        resize: vertical;
    }

    label::after {
        content: " *";
        color: #e74c3c;
    }

    label[for="project_title"]::after,
    label[for="start_date"]::after,
    label[for="end_date"]::after,
    label[for="budget"]::after {
        content: "";
    }

    .form-actions {
        padding: 20px;
        text-align: right;
    }

    .submit-btn {
        padding: 12px 24px;
        background-color:rgb(223, 226, 74);
        color: white;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .submit-btn:hover {
        background-color: #3a7bc8;
    }

    @media (max-width: 768px) {
        .form-row {
            flex-direction: column;
            gap: 0;
        }
        
        .form-header h1 {
            font-size: 20px;
            margin-left: 20px;
        }
    }
    </style>
</head>
<body>
    <?php
        session_start();
        if(!isset($_SESSION["userId"])){
            echo '<script>window.location.href = "../login/UserLogIn.php";</script>';
            exit();
        }

        if(isset($_GET['action']) && $_GET['action'] == 'logout') {
            session_destroy();
            echo '<script>window.location.href = "../home/Home.php";</script>';
            exit();
        }
    ?>
    <div class="form-container">
        <div class="form-header">
            <button class="close-btn" id="closeBtn">&times;</button>
            <h1>Job Submission Form</h1>
        </div>

        <form id="jobSubmissionForm">
            <!-- Job Details Section -->
            <section class="form-section">
                <h2>Job Details</h2>

                <div class="form-group">
                    <label for="project_title">Project Title</label>
                    <input type="text" id="project_title" name="project_title" maxlength="255">
                </div>

                <div class="form-group">
                    <label for="project_category">Project Category*</label>
                    <select name="project_category" id="project_category">
                        <option value="" disabled selected>Select One</option>
                        <option value="ANIMATION">ANIMATION</option>
                        <option value="GRAPHIC DESIGN">GRAPHIC DESIGN</option>
                        <option value="PRODUCT DESIGN">PRODUCT DESIGN</option>
                        <option value="WEB DESIGN">WEB DESIGN</option>
                        <option value="ILLUSTRATION">ILLUSTRATION</option>
                        <option value="MOBILE DESIGN">MOBILE DESIGN</option>
                        <option value="WRITING">WRITING</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description*</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group half">
                        <label for="start_date">Start Date</label>
                        <input type="date" id="start_date" name="start_date">
                    </div>
                    <div class="form-group half">
                        <label for="end_date">End Date</label>
                        <input type="date" id="end_date" name="end_date">
                    </div>
                </div>

                <div class="form-group">
                    <label for="budget">Budget ($)</label>
                    <input type="number" id="budget" name="budget" step="0.01">
                </div>

                <div class="form-group">
                    <label for="location">Location*</label>
                    <input type="text" id="location" name="location" maxlength="255" required>
                </div>

                <div class="form-group">
                    <label for="education">Education Requirements*</label>
                    <textarea id="education" name="education" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="experience">Experience Requirements*</label>
                    <textarea id="experience" name="experience" rows="3" required></textarea>
                </div>
            </section>

            <!-- About Job Section -->
            <section class="form-section">
                <h2>About the Job</h2>
                
                <div class="form-group">
                    <label for="about_us">About Us*</label>
                    <textarea id="about_us" name="about_us" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="role">Role Description*</label>
                    <textarea id="role" name="role" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="tasks">Key Tasks*</label>
                    <textarea id="tasks" name="tasks" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="benefits">Benefits*</label>
                    <textarea id="benefits" name="benefits" rows="4" required></textarea>
                </div>

                <div class="form-group">
                    <label for="requirements">Requirements*</label>
                    <textarea id="requirements" name="requirements" rows="4" required></textarea>
                </div>
            </section>

            <div class="form-actions">
                <button type="submit" class="submit-btn">Submit Job</button>
            </div>
        </form>
    </div>
    <script src="../js/job.js"></script>
</body>
</html>