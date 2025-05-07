<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Posted Jobs - Client Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        
        .header-banner {
            background-image: url('/api/placeholder/1500/200');
            background-size: cover;
            background-position: center;
            height: 150px;
            width: 100%;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .search-section {
            display: flex;
            margin-bottom: 30px;
            gap: 20px;
        }
        
        .search-bar {
            flex: 1;
            display: flex;
        }
        
        .search-bar input {
            flex: 1;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px 0 0 4px;
            font-size: 16px;
            outline: none;
        }
        
        .search-bar button {
            padding: 12px 25px;
            background-color: #f2e205;
            border: none;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-weight: bold;
        }
        
        .filter-section {
            width: 25%;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .filter-section h3 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #333;
        }
        
        .category-filter label {
            display: block;
            margin-bottom: 10px;
        }
        
        .jobs-section {
            display: flex;
            flex-direction: column;
            gap: 20px;
            width: 100%;
        }
        
        .job-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: relative;
        }
        
        .job-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }
        
        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 15px;
            object-fit: cover;
        }
        
        .job-title {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
        }
        
        .job-price {
            margin: 10px 0;
            font-weight: bold;
        }
        
        .job-description {
            margin-bottom: 20px;
            color: #555;
        }
        
        .job-date {
            position: absolute;
            top: 20px;
            right: 20px;
            color: #777;
            text-align: right;
        }
        
        .job-actions {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }
        
        .btn {
            padding: 8px 16px;
            border-radius: 20px;
            text-decoration: none;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
        }
        
        .btn-view {
            background-color: #f2f2f2;
            color: #333;
        }
        
        .btn-apply {
            background-color: #f2f2f2;
            color: #333;
        }
        
        .btn-add {
            background-color: #0066cc;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            margin-bottom: 20px;
            display: inline-block;
        }
        
        .content-container {
            display: flex;
            gap: 20px;
        }
        
        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .stats-container {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            flex: 1;
        }
        
        .stat-value {
            font-size: 24px;
            font-weight: bold;
            margin: 5px 0;
        }
        
        .stat-label {
            color: #777;
        }
        
        @media (max-width: 768px) {
            .content-container {
                flex-direction: column;
            }
            
            .filter-section {
                width: 100%;
                margin-bottom: 20px;
            }
            
            .search-section {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="header-banner"></div>
    
    <div class="container">
        <div class="dashboard-header">
            <h1>My Posted Jobs</h1>
        </div>
        <div class="search-section">
            <div class="search-bar">
                <input type="text" placeholder="What are you looking for?">
                <button id="searchButton">Search</button>
            </div>
        </div>
        
        <div class="content-container">
            
            <div class="jobs-section" id="jobCards">
                <!-- <div class="job-card">
                    <div class="job-header">
                        <img src="/api/placeholder/50/50" alt="Your Profile" class="profile-image">
                        <div>
                            <div class="job-title">Inventory Management System</div>
                            <div class="job-price">₱20000.00</div>
                        </div>
                    </div>
                    <div class="job-date">
                        <div>2025-05-02</div>
                        <div>23:45:06</div>
                    </div>
                    <div class="job-description">
                        A comprehensive inventory management system for tracking products, managing stock levels, and generating reports.
                    </div>
                    <div class="job-actions">
                        <a href="#" class="btn btn-view">View Job</a>
                        <a href="#" class="btn btn-apply">View Applications (3)</a>
                    </div>
                </div>
                
                <div class="job-card">
                    <div class="job-header">
                        <img src="/api/placeholder/50/50" alt="Your Profile" class="profile-image">
                        <div>
                            <div class="job-title">Payroll Management System</div>
                            <div class="job-price">₱20000.00</div>
                        </div>
                    </div>
                    <div class="job-date">
                        <div>2025-05-04</div>
                        <div>05:43:24</div>
                    </div>
                    <div class="job-description">
                        Payroll processing system with employee management, salary calculation, tax deductions, and report generation.
                    </div>
                    <div class="job-actions">
                        <a href="#" class="btn btn-view">View Job</a>
                        <a href="#" class="btn btn-apply">View Applications (5)</a>
                    </div>
                </div>
                
                <div class="job-card">
                    <div class="job-header">
                        <img src="/api/placeholder/50/50" alt="Your Profile" class="profile-image">
                        <div>
                            <div class="job-title">E-commerce Website Redesign</div>
                            <div class="job-price">₱35000.00</div>
                        </div>
                    </div>
                    <div class="job-date">
                        <div>2025-05-05</div>
                        <div>14:22:18</div>
                    </div>
                    <div class="job-description">
                        Looking for a talented designer to redesign our e-commerce platform with modern UI/UX principles.
                    </div>
                    <div class="job-actions">
                        <a href="#" class="btn btn-view">View Job</a>
                        <a href="#" class="btn btn-apply">View Applications (2)</a>
                    </div>
                </div>
                
                <div class="job-card">
                    <div class="job-header">
                        <img src="/api/placeholder/50/50" alt="Your Profile" class="profile-image">
                        <div>
                            <div class="job-title">Mobile App Development</div>
                            <div class="job-price">₱50000.00</div>
                        </div>
                    </div>
                    <div class="job-date">
                        <div>2025-05-06</div>
                        <div>09:10:33</div>
                    </div>
                    <div class="job-description">
                        Need a skilled developer to create a food delivery mobile application for iOS and Android platforms.
                    </div>
                    <div class="job-actions">
                        <a href="#" class="btn btn-view">View Job</a>
                        <a href="#" class="btn btn-apply">View Applications (0)</a>
                    </div>
                </div>
                
                <div class="job-card">
                    <div class="job-header">
                        <img src="/api/placeholder/50/50" alt="Your Profile" class="profile-image">
                        <div>
                            <div class="job-title">Content Writing for Blog</div>
                            <div class="job-price">₱15000.00</div>
                        </div>
                    </div>
                    <div class="job-date">
                        <div>2025-05-06</div>
                        <div>10:35:49</div>
                    </div>
                    <div class="job-description">
                        Seeking a content writer to create 10 SEO-optimized articles for our tech blog.
                    </div>
                    <div class="job-actions">
                        <a href="#" class="btn btn-view">View Job</a>
                        <a href="#" class="btn btn-apply">View Applications (2)</a>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <script src="../js/applicationHome.js"></script>
</body>
</html>